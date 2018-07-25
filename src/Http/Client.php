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
    protected $options;

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
        $this->options = [];
        $this->client = new GuzzleClient([
            "base_uri" => "https://api.propublica.org/congress/{$api_version}/",
            "headers" => [
                "X-API-Key" => env("PROPUBLICA_API_KEY")
            ]
        ]);
    }

    public function get($endpoint)
    {
        return $this->client->request("GET", $endpoint);
    }

}