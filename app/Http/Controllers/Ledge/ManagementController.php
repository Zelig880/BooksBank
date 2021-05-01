<?php

namespace App\Http\Controllers\Ledge;

use App\Http\Controllers\BaseController;
use App\Mail\BookRequestMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ledge;
use App\Models\Bookshelf_item;
use App\Enums\LedgeStatus;
use Illuminate\Support\Facades\Mail;
use App\Enums\BookCondition;

class ManagementController extends BaseController
{

    /**
     * Get a list of all borrowed or lend book for current user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(){
        $userId = Auth::id();

        $result = Ledge::with(['book', 'lender', 'borrower', 'book.bookshelf_item'])
            ->where('lender_id', $userId)
            ->orWhere('borrower_id', $userId)
            ->get();

        return $this->responseJson(true, 200, '', $result);
    }

    /**
     * Issue a request to lend a book
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function request(Request $request){

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
     * @param Ledge $ledge
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function respond(Request $request, Ledge $ledge)
    {
        $this->validate($request, [
            'response' => 'required'
        ]);

        $userId = Auth::id();

        //check if the user is the owner of the ledge
        if ($userId === $ledge->lender_id) return response()->json(['error' => 'Not authorized.'], 403);


        //Ledge not in waiting status
        if ($ledge->status !== LedgeStatus::WaitingApproval)
        {
            return response()->json(['error' => 'Ledge is not awaiting approval.'], 404);
        }

        try {
            $ledgeStatus = $request->input('response') === 'accept' ? LedgeStatus::WaitingPickup : LedgeStatus::Rejected;
            $ledge->update([
                'status' => $ledgeStatus
            ]);

            return response()->json(['success' => $ledge]);
        }
        catch (Exception $e) {
            return response()->json(['error' => 'An error has occurred'], 500);
        }
    }

}
