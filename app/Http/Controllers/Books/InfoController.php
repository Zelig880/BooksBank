<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\OpenLibrary\OpenLibraryClient;

class InfoController extends Controller
{

    private $OpenLibraryApi;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->OpenLibraryApi = new OpenLibraryClient();
    }

    /**
     * Get Book by ISBN code.
     *
     * @param  String $isbn
     * @return \Illuminate\Http\JsonResponse
     */
    public function byIsbn($isbn)
    {
        $result = $this->OpenLibraryApi->queryEditionsByISBN($isbn);
        return response()->json($result);
    }

}
