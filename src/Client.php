<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 7/26/18
 * Time: 8:33 AM
 */
use DevelopingSonder\PropublicaCongress\Http\Connection;
use DevelopingSonder\PropublicaCongress\Http\Response;

class Client
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Connection::instance();
    }

    /**********************************************************
     *  MEMBERS
     **********************************************************/

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/
     * @endpoint https://api.propublica.org/congress/v1/{congress}/{chamber}/members.json
     *
     * @description Get the members of a specific congress in a specific chamber.
     * @param $congress
     * @param $chamber - Accepted values are "senate" and "house"
     * @return mixed
     * @throws Exception
     */
    public function getMembers($congress, $chamber)
    {
        $endpoint = "{$congress}/{$chamber}.members.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/#get-a-specific-member
     * @endpoint https://api.propublica.org/congress/v1/members/{member-id}.json
     *
     * @description
     * @param $memberId
     * @throws Exception
     * @return mixed - Expected
     */
    public function getMember($memberId)
    {
        $endpoint = "member/{$memberId}.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @param $endpoint
     * @throws Exception
     * @return array
     *
     */
    protected function makeCall($endpoint)
    {
        try {
            $response = new Response($this->client->get($endpoint));
        }catch(\Exception $e)
        {
            throw $e;
        }
        return $response->results();
    }
}