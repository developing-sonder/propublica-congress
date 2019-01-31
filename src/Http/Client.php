<?php
namespace DevelopingSonder\PropublicaCongress\Http;

use DevelopingSonder\PropublicaCongress\Http\Connection;
use DevelopingSonder\PropublicaCongress\Http\Response;

abstract class Client
{
    protected $offset = 0;
    protected $chamber;
    protected $congress;
    public $lastResponse;


     /**
     * @param $endpoint
     * @throws \Exception
     * @return array
     *
     */
    protected function makeCall($endpoint)
    {
        $connection = Connection::instance();

        try {
            $response = new Response($connection->get($endpoint));
            $this->lastResponse = $response;
        }catch(\Exception $e)
        {
            //-- Logging??
            throw $e;
        }

        return $response->results();
    }

    public function nextPage()
    {
        $this->offset += 20;
        return $this;
    }

    public function previousPage()
    {
        $this->offset -= 20;
        return $this;
    }

    public function offset($offset) {
        $this->offset = $offset;
        return $this;
    }
}