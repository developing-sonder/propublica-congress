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
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/#get-members-leaving-office
     * @endpoint https://api.propublica.org/congress/v1/{congress}/{chamber}/members/leaving.json
     *
     * @description Get all members of a specific congress and chamber that are leaving office.
     * @param $congress
     * @param $chamber - Accepted values are "senate" and "house"
     * @return mixed
     * @throws Exception
     * @todo Write test
     */
    public function getLeavingMembers($congress, $chamber)
    {
        $endpoint = "{$congress}/{$chamber}/members/leaving.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/#get-members-leaving-office
     * @endpoint https://api.propublica.org/congress/v1/{congress}/{chamber}/members/leaving.json
     *
     * @description Get all the vote positions of a member.
     *              Data set includes specific information about each Bill and if it passed.
     * @param $memberId
     * @return array
     * @throws Exception
     * @todo Write Test
     */
    public function getMemberVotePositions($memberId)
    {
        $endpoint ="members/{$memberId}/votes.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/
     * @endpoint https://api.propublica.org/congress/v1/{congress}/{chamber}/members.json
     *
     * @description Get the members of a specific congress in a specific chamber.
     * @param $congress
     * @param $chamber - Accepted values are "senate" and "house"
     * @return mixed
     * @throws Exception
     * @todo Write test
     */
    public function getMembers($congress, $chamber)
    {
        $endpoint = "{$congress}/{$chamber}.members.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/#get-current-members-by-statedistrict
     * @endpoint https://api.propublica.org/congress/v1/members/{chamber}/{state}/current.json
     *
     * @param $district
     * @return mixed
     * @throws Exception
     * @todo Write test
     */
    public function getMembersByDistrict($district)
    {
        $endpoint = "members/house/{$district}/current.json";
        return $this->makeCall($endpoint);
    }


    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/#get-current-members-by-statedistrict
     * @endpoint https://api.propublica.org/congress/v1/members/{chamber}/{state}/current.json
     *
     * @param $state
     * @return mixed
     * @throws Exception
     * @todo Write test
     */
    public function getMembersByState($state)
    {
        $endpoint = "members/senate/{$state}/current.json";
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
     * * @todo Write test
     */
    public function getMember($memberId)
    {
        $endpoint = "member/{$memberId}.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/#get-new-members
     * @endpoint https://api.propublica.org/congress/v1/members/new.json     *
     * @return array
     * @throws Exception
     * @todo Write test
     */
    public function getNewMembers()
    {
        $endpoint = "members/new.json";
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