<?php

namespace App\Http\Controllers\Library;

use App\Models\Bookshelf;
use Illuminate\Http\Request;
use App\Enums\BookCondition;
use App\Enums\BookStatus;
use BenSampo\Enum\Rules\EnumValue;

class BookshelfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'book_id' => 'required',
            'condition' => ['required', new EnumValue(BookCondition::class)],
            'status' => ['required', new EnumValue(BookStatus::class)]
        ]);

        try {
            Bookshelf::create($request->all());
    
            return response()->json([ "success" => true]);
        } catch (\Throwable $th) {
            return response()->json([ "success" => false, "message" => $th]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bookshelf  $userLibrary
     * @return \Illuminate\Http\Response
     */
    public function show(Bookshelf $userLibrary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bookshelf  $userLibrary
     * @return \Illuminate\Http\Response
     */
    public function edit(Bookshelf $userLibrary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bookshelf  $userLibrary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bookshelf $userLibrary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bookshelf  $userLibrary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookshelf $userLibrary)
    {
        //
    }
}
