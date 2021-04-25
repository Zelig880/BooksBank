<?php

namespace App\Http\Controllers\Ledge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Ledge;
use App\Models\Bookshelf_item;
use App\Enums\LedgeStatus;
use App\Enums\BookCondition;

class ManagementController extends Controller
{
    
    /**
     * Get a list of all borrowed or lend book for current user
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(){
        $userId = Auth::id();

        $result = Ledge::with(['book', 'lender', 'borrower', 'book.bookshelf_item'])
            ->where('lender_id', $userId)
            ->orWhere('borrower_id', $userId)
            ->get();

        return $result;
    }
    
    /**
     * Issue a request to lend a book
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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
        
        return response()->json($result);
    }

    
    /**
     * Responde to a book request
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function respond(Request $request){

        $this->validate($request, [
            'ledgeId' => 'required',
            'response' => 'required'
        ]);

        $userId = Auth::id();

        $ledge = Ledge::find($request->input('ledgeId'));

        //check if the user is the owner of the ledge
        if($userId === $ledge->lender_id) return response()->json(['error' => 'Not authorized.'], 403);

        
        //Ledge not in waiting status
        if($ledge->status !== LedgeStatus::WaitingApproval) return response()->json(['error' => 'Not authorized.'], 403);

        try {
            $ledgeStatus = $request->input('response') === 'accept' ? LedgeStatus::WaitingPickup : LedgeStatus::Rejected;
            $ledge->status = $ledgeStatus;
            $ledge->save();

            return response()->json(['success' => $ledge]);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error has occured'], 500);
        }
    }
    
}
