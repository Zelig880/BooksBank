<?php

namespace App\Http\Controllers\Bookshelf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Enums\BookSearchType;
use App\Enums\BookCondition;
use App\Enums\BookStatus;
use BenSampo\Enum\Rules\EnumValue;

use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Bookshelf_item;


class ManagementController extends Controller
{

    private $userId;
    private $bookshelf;

    public function __construct()
    {
        $this->userId = Auth::id();
        $this->bookshelf = Bookshelf::where('user_id', '=', $this->userId)->first();
    }

    public function getAll(){
        
        return $this->bookshelf->bookshelf_items()->with('book')->get();
    }

    public function getByBookshelfItemId($id){
        try {
            $book = Bookshelf_Item::with('book', 'book.authors', 'book.categories', 'bookshelf')
                ->where('bookshelf_items.id', $id)
                ->first();

            return response()->json([ "success" => true, "result" => $book]);
        } catch (\Throwable $th) {
            return response()->json([ "success" => false, "message" => $th]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'ISBN' => 'required',
            'condition' => ['required', new EnumValue(BookCondition::class)],
            'status' => ['required', new EnumValue(BookStatus::class)]
        ]);

        try {
            Book::Add($request, $this->bookshelf->id);

            return response()->json([ "success" => true]);
        } catch (\Throwable $th) {
            return response()->json([ "success" => false, "message" => $th]);
        }
        
    }
}
