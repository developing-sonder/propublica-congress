<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 7/25/18
 * Time: 10:10 AM
 */

namespace DevelopingSonder\PropublicaCongress;

use GuzzleHttp\Psr7\Response as GuzzleResponse;

class Response
{
    public $attributes;
    protected $response;

    public function __construct(GuzzleResponse $response)
    {
        $this->response = $response;
        $this->attributes = collect($response->getBody()->getContents());
    }

    public function __get($name)
    {
        return $this->attributes->get($name);
    }

    public function __set($name, $value)
    {
        $this->attributes->put($name, $value);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->attributes->all();
    }
}