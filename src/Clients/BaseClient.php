<?php
namespace DevelopingSonder\PropublicaCongress\Clients;

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

        return ($this->onlyResults()) ? $response->results : $response;
    }

    public function nextPage($onlyResults = false)
    {
        $this->offset += 20;
        $response = $this->makeCall($this->lastEndpoint, $this->lastOptions);

        return ($onlyResults) ? $response->results : $response;
    }

    public function previousPage($onlyResults = false)
    {
        $this->offset -= 20;
        $response = $this->makeCall($this->lastEndpoint, $this->lastOptions);

        return ($onlyResults) ? $response->results : $response;
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

    public function onlyResults()
    {
        $this->onlyResults = true;
    }
}