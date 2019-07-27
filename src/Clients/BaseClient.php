<?php
namespace DevelopingSonder\PropublicaCongress\Clients;

use DevelopingSonder\PropublicaCongress\Http\Connection;
use DevelopingSonder\PropublicaCongress\Http\Response;

abstract class BaseClient
{
    protected $offset = 0;
    protected $only = true;
    protected $chamber;
    protected $congress;
    protected $lastResponse;
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

        return $response;
    }

    public function nextPage($onlyItems = true)
    {
        $this->offset += 20;
        $response = $this->makeCall($this->lastEndpoint, $this->lastOptions);

        return ($onlyItems) ? $response->items() : $response;
    }

    public function previousPage($onlyItems = true)
    {
        $this->offset -= 20;
        $response = $this->makeCall($this->lastEndpoint, $this->lastOptions);

        return ($onlyItems) ? $response->results : $response;
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

    public function response()
    {
        return $this->lastResponse;
    }

    public function fullResponse()
    {
        $this->onlyResults = false;
    }
}