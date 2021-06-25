<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Bookshelf_item;
use Illuminate\Support\Facades\Auth;

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

        $query = Bookshelf_item::with([
                'bookshelf' => function ($query) use ($latitude, $longitude) {
                    $query->distance($latitude, $longitude)->orderBy('distance', 'ASC');
                }, 'book'
            ])
            ->whereHas('bookshelf', function ($query) use ($latitude, $longitude, $radius, $userId) {
                return $query->distance($latitude, $longitude)
                             ->having('distance', '<', $radius)
                             ->where('user_id', '<>', $userId);
            })
            ->get();

        return $query;
    }

}
