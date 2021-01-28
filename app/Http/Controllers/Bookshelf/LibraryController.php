<?php

namespace App\Http\Controllers\Bookshelf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Enums\BookSearchType;
use App\Enums\BookCondition;
use App\Enums\BookStatus;
use BenSampo\Enum\Rules\EnumValue;

use App\Models\Book;
use App\Models\UserLibrary;


class LibraryController extends Controller
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
            Book::create([
                'title' => $request->title, 
                'description' => $request->description, 
                'ISBN' => $request->ISBN, 
                'thumbnail' => $request->thumbnail,  
            ]);
            UserLibrary::create($request->all());
    
            $user = User::create($user_inputs);

$xyz = $user->xyz()->create($xyz_inputs);
            return response()->json([ "success" => true]);
        } catch (\Throwable $th) {
            return response()->json([ "success" => false, "message" => $th]);
        }
        
    }
}
