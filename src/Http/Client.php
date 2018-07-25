<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 7/25/18
 * Time: 8:54 AM
 */
namespace DevelopingSonder\PropublicaCongress;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Request;

class Client
{
    private static $instance;
    public $client;

    public static function instance()
    {
        if(static::$instance === null)
        {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __construct()
    {
        $api_version = env("PROPUBLICA_API_VERSION") ?? "v1";

        $this->client = new GuzzleClient([
            "headers" => [
                'base_uri' => "https://api.propublica.org/congress/{$api_version}/",
                "X-API-Key" => env("PROPUBLICA_API_KEY")
            ]
        ]);
    }

    public function get($endpoint, Array $query = [])
    {
        return $this->sendRequest("GET", $endpoint, ["query" => $query]);
    }

    protected function sendRequest($method, $endpoint, $options)
    {
        return $this->client->request($method, $endpoint, $options);
    }

}