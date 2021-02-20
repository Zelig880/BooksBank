<?php

namespace App\Http\Controllers\Ledge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Ledge;
use App\Models\Bookshelf_item;

class ManagementController extends Controller
{
    
    /**
     * Get a list of all borrowed or lend book for current user
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(){
        $userId = Auth::id();

        $result = Ledge::with(['book'])
            ->where('lender_id', $userId)
            ->whereOr('borrower_id', $userId)
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
            'bookshelfItemId' => 'required'
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
        ]);
        
        return response()->json($result);
    }
}
