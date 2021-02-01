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
use App\Models\Bookshelf_item;


class ManagementController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'ISBN' => 'required',
            'condition' => ['required', new EnumValue(BookCondition::class)],
            'status' => ['required', new EnumValue(BookStatus::class)]
        ]);

        try {
            $book = Book::firstOrCreate([
                'title' => $request->title, 
                'ISBN' => $request->ISBN, 
            ],
            [
                'description' => $request->description, 
                'thumbnail' => $request->thumbnail,  
            ]);

            if(is_array($request->categories) && count($request->categories) > 0){
                foreach ($request->categories as $key => $value) {
                    $book->categories()->firstOrCreate([
                        'name' => $value
                    ]);
                }
            }

            if(is_array($request->authors) && count($request->authors) > 0){
                foreach ($request->authors as $key => $value) {
                    $book->authors()->firstOrCreate([
                        'name' => $value
                    ]);
                }
            }

            $book->bookshelves()->create([
                'condition' => $request->condition, 
                'status' => $request->status, 
                'user_id' => Auth::id(),
            ]);

            return response()->json([ "success" => true]);
        } catch (\Throwable $th) {
            return response()->json([ "success" => false, "message" => $th]);
        }
        
    }
}
