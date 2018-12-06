<?php
namespace DevelopingSonder\PropublicaCongress;

use DevelopingSonder\PropublicaCongress\Http\Connection;
use DevelopingSonder\PropublicaCongress\Http\Response;

abstract class Client
{

     /**
     * @param $endpoint
     * @throws \Exception
     * @return array
     *
     */
    protected static function makeCall($endpoint)
    {
        $connection = Connection::instance();

        try {
            $response = new Response($connection->get($endpoint));
        }catch(\Exception $e)
        {
            //-- Logging??
            throw $e;
        }

        return $response->results();
    }
}