<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Bookshelf_item;
use App\Models\Bookshelf;
use App\Enums\LedgeStatus;
use App\Enums\BookStatus;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Display a listing of books within a radius
     *
     * @param $latitude
     * @param $longitude
     * @param $radius
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
                }, 'book', 'book.categories'
            ])
            ->where('bookshelf_items.status', BookStatus::Available)
            ->whereDoesntHave('ledge', function ($query) {
                return $query->whereIn('status', [LedgeStatus::WaitingPickup, LedgeStatus::InProgress, LedgeStatus::ReturnRequested, LedgeStatus::AwaitingReturn]);
            })
            ->whereHas('bookshelf', function ($query) use ($latitude, $longitude, $radius, $userId) {
                return $query->distance($latitude, $longitude)
                             ->having('distance', '<', intval($radius))
                             ->where('user_id', '<>', $userId)
                             ->groupBy( 'id' );
            })
            ->get();

        return $query;
    }

}
