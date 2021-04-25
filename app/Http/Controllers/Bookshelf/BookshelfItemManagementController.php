<?php

namespace App\Http\Controllers\Bookshelf;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bookshelf\CreateBookRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Bookshelf_item;

class BookshelfItemManagementController extends Controller
{

    private $userId, $bookshelf;

    public function __construct()
    {
        $this->userId = Auth::id();
        $this->bookshelf = Bookshelf::where('user_id', '=', $this->userId)->first();
    }

    public function index()
    {
        return $this->bookshelf->bookshelf_items()->with('book')->get();
    }

    public function getByBookshelfItemId($id)
    {
        try {
            $book = Bookshelf_Item::with('book', 'book.authors', 'book.categories', 'bookshelf')
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
            return response()->json(["success" => true]);
        }
        catch (\Throwable $th) {
            return response()->json(["success" => false, "message" => $th]);
        }
    }

}
