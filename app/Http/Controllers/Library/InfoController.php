<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\OpenLibrary\OpenLibraryClient;

class InfoController extends Controller
{

    private $API;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->API = new OpenLibraryClient();
    }

    /**
     * Get Book by ISBN code.
     *
     * @param  String $isbn
     * @return \Illuminate\Http\JsonResponse
     */
    public function byIsbn($isbn)
    {
        // $result = $this->API->queryEditionsByISBN($isbn);
        // return response()->json($result);

        $client = new Google\Client();
        $client->setApplicationName("BookSwap");
        $client->setDeveloperKey("AIzaSyBEFgiN5vKr8_qKDZTJjWs9EQwlEgUDGhk");

        $service = new Google_Service_Books($client);
        $optParams = array(
        'filter' => 'free-ebooks',
        'q' => 'Henry David Thoreau'
        );
        $results = $service->volumes->listVolumes($optParams);

        return response()->json($results->getItems());
    }

}
