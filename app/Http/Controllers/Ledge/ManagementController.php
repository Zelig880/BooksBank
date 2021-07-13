<?php

namespace App\Http\Controllers\Ledge;

use App\Http\Controllers\BaseController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ledge;
use App\Models\Bookshelf_item;
use App\Enums\LedgeStatus;
use App\Jobs\SendEmail;

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

            SendEmail::dispatch('App\Mail\BookReturnStatusMail', $ledge, $ledge->lender->email);

            return $this->responseJson(true, 200, 'Book return process initiated', $ledge);
        } catch (Exception $e) {
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

        SendEmail::dispatch('App\Mail\BookRequestMail', $result, $result->lender->email);

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
        if ($userId != $ledge->lender_id) {
            return response()->json(['error' => 'Not authorized.'], 403);
        }

        // ledge not awaiting approval

        if ($ledge->status !== LedgeStatus::WaitingApproval) {
            return response()->json(['error' => 'Ledge is not awaiting approval.'], 409);
        }

        try {
            $ledge->update([
                'status' => $request->input('response') === 'accept' ? LedgeStatus::WaitingPickup : LedgeStatus::Rejected
            ]);

            SendEmail::dispatch('App\Mail\BookRequestStatusMail', $ledge, $ledge->borrower->email);

            return response()->json(['success' => $ledge]);
        } catch (Exception $e) {
            throw $e;
        }
    }
    /**
     * Issue a returnRequest to retured a borrowed a book
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function returnRequest(Request $request)
    {

        $this->validate($request, [
            'ledgeId' => 'required',
            'return_date' => 'required'
        ]);

        $ledge = Ledge::find($request->input('ledgeId'));

        // check if the user is the owner of the ledge
        $userId = Auth::id();
        if ($userId != $ledge->borrower_id) {
            return response()->json(['error' => 'Not authorized.'], 403);
        }

        // ledge not awaiting approval

        if ($ledge->status !== LedgeStatus::InProgress) {
            return response()->json(['error' => 'Ledge is not in progress.'], 409);
        }

        $ledge->update([
            'status' => LedgeStatus::ReturnRequested,
            'return_date' => $request->input('return_date')
        ]);

        SendEmail::dispatch('App\Mailable\BookReturnRequestMail', $ledge, $ledge->lender->email);

        return $this->responseJson(true, 200, 'Book return request made', $ledge);
    }


    /**
     * Responde to a book return request
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function returnRespond(Request $request, $id)
    {
        $this->validate($request, [
            'response' => 'required'
        ]);

        $ledge = Ledge::find($id);

        // check if the user is the owner of the ledge
        $userId = Auth::id();
        if ($userId != $ledge->lender_id) {
            return response()->json(['error' => 'Not authorized.'], 403);
        }

        // ledge not awaiting approval

        if ($ledge->status !== LedgeStatus::ReturnRequested) {
            return response()->json(['error' => 'Ledge is not in a ReturnRequested status.'], 409);
        }

        try {
            $ledge->update([
                'status' => $request->input('response') === 'accept' ? LedgeStatus::AwaitingReturn : LedgeStatus::InProgress
            ]);

            SendEmail::dispatch('App\Mailable\BookReturnRequestStatusMail', $ledge, $ledge->borrower->email);

            return response()->json(['success' => $ledge]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Collect a book
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function collect(Request $request, $id)
    {
        $ledge = Ledge::find($id);

        // check if the user is the owner of the ledge
        $userId = Auth::id();
        if ($userId != $ledge->lender_id) {
            return response()->json(['error' => 'Not authorized.'], 403);
        }

        if ($ledge->status !== LedgeStatus::WaitingPickup) {
            return response()->json(['error' => 'Ledge is not awaiting pickup.'], 409);
        }

        try {
            $ledge->update([
                'status' => LedgeStatus::InProgress
            ]);

            return response()->json(['success' => $ledge]);
        } catch (Exception $e) {
            throw $e;
        }
    }
    /**
     * Complete book return
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function returned(Request $request, $id)
    {
        $ledge = Ledge::find($id);

        // check if the user is the owner of the ledge
        $userId = Auth::id();
        if ($userId != $ledge->lender_id) {
            return response()->json(['error' => 'Not authorized.'], 403);
        }

        if ($ledge->status !== LedgeStatus::AwaitingReturn) {
            return response()->json(['error' => 'Ledge is not awaiting return.'], 409);
        }

        try {
            $ledge->update([
                'status' => LedgeStatus::Completed
            ]);

            return response()->json(['success' => $ledge]);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
