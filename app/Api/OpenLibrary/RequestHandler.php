<?php
use GuzzleHttp\Client;
namespace App\Api\OpenLibrary;

/**
 * A request handler for Open Library API requests
 */
class RequestHandler
{

    private $base_url;
    private $version;

    /**
     * Instantiate a new RequestHandler
     */
    public function __construct()
    {

        $this->client = new \GuzzleHttp\Client(
            [
                'base_uri' => 'http://openlibrary.org',
                'allow_redirects' => false
            ]);
    }

    /**
     * Make a request with this request handler
     *
     * @param string $method one of GET, POST
     * @param string $path the path to hit
     * @param array $options the array of params
     *
     * @return \stdClass response object
     */
    public function request($method, $path, $options)
    {
        // Ensure there are options
        $options = $options ?: array();

        $url = $this->base_url . $path;

        $request = $this->client->get($url);
        $request->getQuery()->merge($options);

        $request->setHeader('User-Agent', 'openlibrary.php/'.$this->version);
 
        // Collapse Guzzle's errors to deal with at the Client level
        try {
            $response = $request->send();
        } catch (\Guzzle\Http\Exception\BadResponseException $e) {
            $response = $request->getResponse();
        }

        // Construct the object that the Client expects to see, and return it
        $obj = new \stdClass;
        $obj->status = $response->getStatusCode();
        $obj->body = $response->getBody();
        $obj->headers = $response->getHeaders()->toArray();
 
        return $obj;
    }

}