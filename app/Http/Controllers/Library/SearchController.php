<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Bookshelf;
use App\Models\Bookshelf_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Geographical;

class SearchController extends Controller
{
    /**
     * Display a listing of books within a radius
     *
     * @return \Illuminate\Http\Response
     */
    public function index($latitude, $longitude, $radius)
    {
        // This endpoint is available also to unauthenticated user. 
        // But if we are authenticated, we do not return that user books
        $userId = Auth::id();

        $query = Bookshelf_item::with(
            [
                'bookshelf' => function ($query) use ($latitude, $longitude) {
                    $query
                        ->distance($latitude, $longitude)
                        ->orderBy('distance', 'ASC');
                },
                'book'
            ])
            ->whereHas('bookshelf', function ($query) use ($latitude, $longitude, $radius, $userId) {
                return $query
                        ->distance($latitude, $longitude)
                        ->having('distance', '<', $radius)
                        ->where('user_id', '<>', $userId);
            })
            ->get();

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
