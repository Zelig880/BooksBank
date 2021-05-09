<?php

namespace App\Http\Controllers\Ledge;

use App\Http\Controllers\BaseController;
use App\Mail\BookRequestStatusMail;
use App\Mail\BookRequestMail;
use App\Mail\BookReturnStatusMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ledge;
use App\Models\Bookshelf_item;
use App\Enums\LedgeStatus;
use Illuminate\Support\Facades\Mail;

class ManagementController extends BaseController
{

    /**
     * Get a list of all borrowed or lend book for current user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $userId = Auth::id();

        $result = Ledge::with(['book', 'lender', 'borrower', 'book.bookshelf_item'])
                        ->where('lender_id', $userId)
                        ->orWhere('borrower_id', $userId)
                        ->get();

        return $this->responseJson(true, 200, 'Ledges fetched!', $result);
    }

    public function return($id)
    {
        $ledge = Ledge::find($id);

        // check if the user is the owner of the ledge
        $userId = Auth::id();

        // check if the user is the borrower of the ledge
        if (($userId === $ledge->borrower_id) === 1) {
            return response()->json(['error' => 'Not authorized.'], 403);
        }

        // ledge not awaiting approval
        if ($ledge->status !== LedgeStatus::InProgress) {
            return response()->json(['error' => 'Ledge is not due for return.'], 409);
        }

        try {
            $ledge->update([
                'status' => LedgeStatus::AwaitingReturn
            ]);

            Mail::to($ledge->lender->email)->send(new BookReturnStatusMail($ledge));
            return response()->json(['success' => $ledge]);
        }
        catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Issue a request to lend a book
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function request(Request $request)
    {

        $this->validate($request, [
            'bookshelfItemId' => 'required',
            'pickup_date' => 'required',
            'return_date' => 'required'
        ]);

        $userId = Auth::id();
        $bookshelf_item = Bookshelf_item::with(['bookshelf'])
                                        ->where('id', $request->input('bookshelfItemId'))
                                        ->first();

        $result = Ledge::create([
            'lender_id' => $bookshelf_item->bookshelf->user_id,
            'borrower_id' => $userId,
            'book_id' => $bookshelf_item->book_id,
            'bookshelf_item_id' => $request->input('bookshelfItemId'),
            'pickup_date' => $request->input('pickup_date'),
            'return_date' => $request->input('return_date')
        ]);

        Mail::to($result->lender->email)->send(new BookRequestMail($result));

        return $this->responseJson(true, 200, 'Book request made', $result);
    }

    /**
     * Responde to a book request
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function respond(Request $request, $id)
    {
        $this->validate($request, [
            'response' => 'required'
        ]);

        $ledge = Ledge::find($id);

        // check if the user is the owner of the ledge
        $userId = Auth::id();
        if (($userId === $ledge->lender_id) === 1)
        {
            return response()->json(['error' => 'Not authorized.'], 403);
        }

        // ledge not awaiting approval

        if ($ledge->status !== LedgeStatus::WaitingApproval)
        {
            return response()->json(['error' => 'Ledge is not awaiting approval.'], 409);
        }

        try {
            $ledge->update([
                'status' => $request->input('response') === 'accept' ? LedgeStatus::WaitingPickup : LedgeStatus::Rejected
            ]);

            Mail::to($ledge->borrower->email)->send(new BookRequestStatusMail($ledge));

            return response()->json(['success' => $ledge]);
        }
        catch (Exception $e) {
            throw $e;
        }
    }
}
