<?php
namespace DevelopingSonder\PropublicaCongress\Clients;

use DevelopingSonder\PropublicaCongress\Resources\Member;
use Illuminate\Support\Collection;

class Members extends BaseClient
{
   
    /**********************************************************
     *  MEMBERS
     **********************************************************/

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/#compare-two-members-bill-sponsorships
     * @endpoint https://api.propublica.org/congress/v1/members/{first-member-id}/bills/{second-member-id}/{congress}/{chamber}.json
     *
     * @param $member1
     * @param $member2
     * @param $congress
     * @param $chamber
     * @return array
     * @throws \Exception
     */
    public function compareMembersBillSponsorships($member1, $member2, $congress, $chamber)
    {
        $endpoint = "members/{$member1}/bills/{$member2}/{$congress}/{$chamber}.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/#compare-two-members-vote-positions
     * @endpoint https://api.propublica.org/congress/v1/members/{first-member-id}/votes/{second-member-id}/{congress}/{chamber}.json
     *
     * @param $member1 integer
     * @param $member2 integer
     * @param $congress string
     * @param $chamber - Accepted values are senate and house.
     * @return array
     * @throws \Exception
     */
    public function membersVotePositions($member1, $member2, $congress, $chamber)
    {
        $endpoint = "members/{$member1}/votes/{$member2}/{$congress}/{$chamber}.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/#get-members-leaving-office
     * @endpoint https://api.propublica.org/congress/v1/{congress}/{chamber}/members/leaving.json
     *
     * @description Get all members of a specific congress and chamber that are leaving office.
     * @param $congress
     * @param $chamber - Accepted values are "senate" and "house"
     * @return mixed
     * @throws \Exception
     * @todo Write test
     */
    public function leavingMembers($congress, $chamber)
    {
        $endpoint = "{$congress}/{$chamber}/members/leaving.json";
        return $this->makeCall($endpoint);;
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/#get-members-leaving-office
     * @endpoint https://api.propublica.org/congress/v1/{congress}/{chamber}/members/leaving.json
     *
     * @description Get all the vote positions of a member.
     *              Data set includes specific information about each Bill and if it passed.
     * @param $memberId
     * @return Member
     * @throws \Exception
     * @todo Write Test
     */
    public function memberVotePositions($memberId)
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
     * @return Collection
     * @throws \Exception
     * @todo Write test
     */
    public function members($congress, $chamber)
    {
        $endpoint = "{$congress}/{$chamber}/members.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/#get-current-members-by-statedistrict
     * @endpoint https://api.propublica.org/congress/v1/members/{chamber}/{state}/current.json
     *
     * @param $district
     * @return mixed
     * @throws \Exception
     * @todo Write test
     */
    public function membersByDistrict($district)
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
     * @throws \Exception
     * @todo Write test
     */
    public function membersByState($state)
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
     * @throws \Exception
     * @return mixed - Expected
     * * @todo Write test
     */
    public static function find($memberId)
    {
        $endpoint = "members/{$memberId}.json";
        return static::makeCall($endpoint);
    }

    /***
     * @return Collection
     * @throws \Exception
     */
    public function newMembers()
    {
        $endpoint = "members/new.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/#get-quarterly-office-expenses-by-a-specific-house-member
     * @endpoint https://api.propublica.org/congress/v1/members/{member-id}/office_expenses/{year}/{quarter}.json
     *
     * @param $member
     * @param $quarter
     * @param $year
     * @return array
     * @throws \Exception
     */
    public function memberQuarterlyOfficeExpenses($member, $quarter, $year)
    {
        $endpoint = "members/{$member}/office_expenses/{$year}/{$quarter}.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/#get-quarterly-office-expenses-by-category-for-a-specific-house-member
     * @endpoint https://api.propublica.org/congress/v1/members/{member-id}/office_expenses/category/{category}.json
     *
     * @param $member
     * @param $category
     * @return array
     * @throws \Exception
     */
    public function memberQuarterlyOfficeExpensesByCategory($member, $category)
    {
        $endpoint = "members/{$member}/office_expenses/category/{$category}.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/members/#get-quarterly-office-expenses-for-a-specified-category
     * @endpoint https://api.propublica.org/congress/v1/office_expenses/category/{category}/{year}/{quarter}.json
     *
     * @param $category
     * @param $quarter
     * @param $year
     * @return array
     * @throws \Exception
     */
    public function quarterlyOfficeExpensesByCategory($category, $quarter, $year)
    {
        $endpoint = "office_expenses/category/{$category}/{$year}/{$quarter}.json";
        return $this->makeCall($endpoint);
    }
}