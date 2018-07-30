<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 7/26/18
 * Time: 8:33 AM
 */
use DevelopingSonder\PropublicaCongress\Http\Connection;

class Client
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Connection::instance();
    }

    /**
     * @param $congress
     * @param $chamber
     * @return mixed
     */
    public function getMembers($congress, $chamber)
    {
        $endpoint = "{$congress}/{$chamber}.members.json";
        $response = $this->client->get($endpoint);
        
        return $response->results[0]->members;
    }    
}