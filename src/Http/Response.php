<?php
namespace DevelopingSonder\PropublicaCongress\Http;

use GuzzleHttp\Psr7\Response as GuzzleResponse;

class Response
{
    public $contents;
    protected $response;

    public function __construct(GuzzleResponse $response)
    {
        $this->response = $response;
        $this->contents = collect(json_decode($response->getBody()->getContents()));
    }

    public function __get($name)
    {
        return $this->contents->get($name);
    }

    public function __set($name, $value)
    {
        $this->contents->put($name, $value);
    }

    /**
     * @description The results key holds the expected data from the client GET.
     *              While the json response holds other data pertaining to the
     *              method call, the results key hold our expected data.
     * @return array
     */
    public function results()
    {
        return $this->contents->get('results');
    }
}