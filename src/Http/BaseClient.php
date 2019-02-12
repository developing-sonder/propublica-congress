<?php
namespace DevelopingSonder\PropublicaCongress\Http;

use DevelopingSonder\PropublicaCongress\Http\Connection;
use DevelopingSonder\PropublicaCongress\Http\Response;

abstract class BaseClient
{
    protected $offset = 0;
    protected $chamber;
    protected $congress;
    public $lastResponse;
    protected $lastEndpoint;
    protected $lastOptions;


     /**
     * @param $endpoint
     * @param array @options
     * @throws \Exception
     * @return array
     *
     */
    protected function makeCall($endpoint, $options = [])
    {
        $connection = Connection::instance();
        $options = array_merge($options, ['query' =>
            [
                'offset' => $this->offset
            ]
        ]);

        try {
            $response = new Response($connection->get($endpoint, $options));
            $this->lastResponse = $response;
            $this->lastEndpoint = $endpoint;
            $this->lastOptions = $options;
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
    }

    public function previousPage()
    {
        $this->offset -= 20;
        return $this;
    }

    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function page($pageNumber)
    {
        $this->offset = (20 * $pageNumber) - 20;
    }
}