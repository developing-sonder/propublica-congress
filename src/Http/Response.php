<?php
namespace DevelopingSonder\PropublicaCongress\Http;

use GuzzleHttp\Psr7\Response as GuzzleResponse;

class Response
{
    public $contents;
    public $status;
    protected $response;

    public function __construct(GuzzleResponse $response)
    {
        $this->response = $response;
        $this->contents = collect(json_decode($response->getBody()->getContents()));
        $this->status = $this->contents->get('status');
    }

    public function __get($name)
    {
        return $this->contents->get($name);
    }

    public function __set($name, $value)
    {
        $this->contents->put($name, $value);
    }

    public function results()
    {
        return $this->results;
    }

    protected function validateResponse()
    {

    }

    public function item()
    {
        return $this->results[0];
    }

    public function items()
    {
        if(is_array($this->results)) {

            if(array_key_exists('bills', $this->results[0])) {
                return $this->results[0]->bills;
            }

            if(array_key_exists('members', $this->results[0])) {
                return $this->results[0]->members;
            }

            if(array_key_exists('votes', $this->results[0])) {
                return $this->results[0]->votes;
            }

            if(array_key_exists('amendments', $this->results[0])) {
                return $this->results[0]->amendments;
            }
        }

        return $this->results;
    }
}