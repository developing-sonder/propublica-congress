<?php
namespace DevelopingSonder\PropublicaCongress;

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
     * @return array
     */
    public function results()
    {
        return $this->contents->get('results');
    }
}