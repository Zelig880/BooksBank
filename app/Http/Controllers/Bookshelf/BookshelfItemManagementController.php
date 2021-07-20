<?php

namespace App\Http\Controllers\Bookshelf;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bookshelf\CreateBookRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\BookStatus;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Bookshelf_item;

class BookshelfItemManagementController extends Controller
{

    private $userId, $bookshelf;

    public function __construct()
    {
        $this->userId = Auth::id();
        $this->bookshelf = Bookshelf::query()->where('user_id', '=', $this->userId)->first();
    }

    public function index()
    {
        return $this->getCurrentUserBookshelfItems();
    }

    public function getByBookshelfItemId($id)
    {
        try {
            $book = Bookshelf_Item::with('book', 'book.authors', 'book.categories', 'bookshelf', 'bookshelf.user')
                                    ->where('bookshelf_items.id', $id)
                                    ->first();

            return response()->json(["success" => true, "result" => $book]);
        }
        catch (\Throwable $th) {
            return response()->json(["success" => false, "message" => $th]);
        }
    }

    public function store(CreateBookRequest $request)
    {
        try {
            Book::Add($request->validated(), $this->bookshelf->id);
            $bookshelfItems = $this->getCurrentUserBookshelfItems();
            return response()->json(["success" => true, "result" => $bookshelfItems]);
        }
        catch (\Throwable $th) {
            return response()->json(["success" => false, "message" => $th]);
        }
    }

    private function getCurrentUserBookshelfItems() {
        $bookshelf = $this->bookshelf;

        if(!$bookshelf) return;

        return $bookshelf
                ->bookshelf_items()
                ->with('book', 'ledge')
                ->where('bookshelf_items.status', BookStatus::Available)
                ->get();
    }

   public function removeBookShelfItem($id)
   {
       try {
            $bookshelf_item = $this->bookshelf->bookshelf_items()->findOrFail($id);
            $bookshelf_item->update([
                'status' => BookStatus::Deleted
            ]);
           return response()->json(["success" => true, 'message' => 'Bookshelf item deleted!']);
       }
       catch (\Throwable $th) {
           return response()->json(["success" => false, "message" => $th]);
       }
   }

}
