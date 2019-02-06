<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 7/25/18
 * Time: 8:54 AM
 */
namespace DevelopingSonder\PropublicaCongress\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Request;

class Connection
{
    private static $instance;
    public $guzzleClient;
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
        $this->guzzleClient = new GuzzleClient([
            "base_uri" => "https://api.propublica.org/congress/{$api_version}/",
            "headers" => [
                "X-API-Key" => env("PROPUBLICA_API_KEY")
            ]
        ]);
    }

    public function get($endpoint, $options = null)
    {
        return $this->guzzleClient->request("GET", $endpoint, $options);
    }

}