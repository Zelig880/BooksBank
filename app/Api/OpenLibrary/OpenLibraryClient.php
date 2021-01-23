<?php


namespace App\Api\OpenLibrary;

use Illuminate\Support\Facades\Http;

/**
 * A client to access the Open Library API
 */
class OpenLibraryClient
{
    /**
     * Create a new Client
     */
    public function __construct()
    {
    }

    /**
     * Get a book by its Open Library ID
     *
     * @param string $olid the OLID
     * @return array the response array
     */
    public function getBookByOLID($olid)
    {
        return $this->getRequest(
            sprintf('/books/%s.json', $olid)
        );
    }

    /**
     * Find editions by International Standard Book Number
     *
     * @param string $isbn the ISBN
     * @return array the response array
     */
    public function queryEditionsByISBN($isbn)
    {
        switch (strlen($isbn)) {
            case 10:
                $isbn_type = 'isbn_10';
                break;
            
            case 13:
                $isbn_type = 'isbn_13';
                break;

            default:
                throw new \InvalidArgumentException('ISBN must be 10 or 13 characters.');
        }

        return $this->getRequest(
            '/query.json',
            array(
                'type' => '/type/edition',
                $isbn_type => $isbn,
                '*' => ''
            )
        );
    }

    /**
     * Find editions by Library of Congress Control Number
     *
     * @param string $lccn the LCNN
     * @return array the response array
     */
    public function queryEditionsByLCCN($lccn)
    {
        return $this->getRequest(
            '/query.json',
            array(
                'type' => '/type/edition',
                'lccn' => $lccn,
                '*' => ''
            )
        );
    }

    /**
     * Find editions by Online Computer Library Center number
     *
     * @param string $oclc the OCLC number
     * @return array the response array
     */
    public function queryEditionsByOCLC($oclc)
    {
        return $this->getRequest(
            '/query.json',
            array(
                'type' => '/type/edition',
                'oclc_numbers' => $oclc,
                '*' => ''
            )
        );
    }

    /**
     * Find an author in Open Library by his or her key
     *
     * @param string $key the Open Library author key
     * @return array the response array
     */
    public function getAuthorByKey($key)
    {
        return $this->getRequest(
            sprintf('/authors/%s.json', $key)
        );
    }

    /**
     * Get the editions of a work
     *
     * @param string $work the Open Library work key
     * @param int $limit number of results to limit by
     * @param int $offset number of results to offset by
     * @return array the response array
     */
    public function getEditionsOfWork($work, $limt=20, $offset=0)
    {
        return $this->getRequest(
            sprintf('/works/%s/editions.json', $work),
            array(
                'limit' => (int)$limit,
                'offset' => (int)$offset,
                '*' => ''
            )
        );
    }

    /**
     * Make a GET request to the given endpoint and return the response
     *
     * @param string $path the path to call on
     * @param array  $options the options to call with
     *
     * @return array the response object (parsed)
     */
    private function getRequest($path, $options=array())
    {
        $response = $this->makeRequest('GET', $path, $options);

        return $this->parseResponse($response);
    }
 
    /**
     * Parse a response and return an appropriate result
     *
     * @param \stdClass $response the response from the server
     *
     * @throws RequestException
     * @return array the response data
     */
    private function parseResponse($response)
    {
        dd($response->json());
        return $response;
        // $response->json = json_decode($response->body);
        $response->json = $response;

        if ($response->status < 400) {
            return $response->json;
        } else {
            throw new RequestException($response);
        }
    }

    /**
     * Make a request to the given endpoint and return the response
     *
     * @param string $method the method to call: GET, POST
     * @param string $path the path to call on
     * @param array  $options the options to call with
     *
     * @return \stdClass the response object (not parsed)
     */
    private function makeRequest($method, $path, $options)
    {
        return Http::get("http://openlibrary.org" . $path, $options );
    }

}