<?php

namespace App\Http\Controllers\Bookshelf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\OpenLibrary\OpenLibraryClient;
use google\apiclient;
use App\Enums\BookSearchType;
use BenSampo\Enum\Rules\EnumValue;

use Google_Client;
use Google_Service_Books;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{

    private $CLIENT;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $client = new Google_Client();
        $apiKey = config('services.google.api');
        $client->setDeveloperKey($apiKey);
        $this->API = new Google_Service_Books($client);
    }

    public function index($type, $text, request $request)
    {
        Validator::make($request->all(), [
            'text' => 'required',
            'type' => ['required', new EnumValue(BookSearchType::class)]
        ]);

        switch ($request['type']) {
            case BookSearchType::ISBN:
                $result = $this->findByISBN($request['text']);
                break;
            default:
                $result = $this->findByTitle($request['text']);
                break;
        }

        return response()->json($result->getItems());
    }

    private function findByISBN($isbn)
    {
        $optParams = [
            'q' => "isbn:{$isbn}",
            'maxResults'=> 2
        ];

        return $this->API->volumes->listVolumes($optParams);
    }

    private function findByTitle($title)
    {
        $optParams = [
            'maxResults'=> 40
        ];

        return $this->API->volumes->listVolumes($title, $optParams);
    }

}
