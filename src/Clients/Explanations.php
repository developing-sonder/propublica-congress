<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 2/12/19
 * Time: 9:18 AM
 */
namespace DevelopingSonder\PropublicaCongress\Clients;

class Explanations extends BaseClient
{
    /**
    * Accepted categories as defined by Propublica:
    * https://projects.propublica.org/api-docs/congress-api/votes/#get-recent-personal-explanation-votes-by-a-specific-member-by-category
    **/
    protected $categories;

    public function construct()
    {
        $this->categories = collect([
            'ambiguous',
            'claims-voted',
            'election-related',
            'leave-of-absence',
            'medical',
            'memorial',
            'military-service',
            'misunderstanding',
            'official-business',
            'other',
            'personal',
            'prior-commitment',
            'travel-difficulties',
            'voted-incorrectly',
            'weather'
        ]);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/votes/#get-recent-personal-explanations
     * @endpoint https://api.propublica.org/congress/v1/{congress}/explanations.json
     *
     * @param $congress
     * @return array
     * @throws \Exception
     */
    public function recent($congress)
    {
        $endpoint = "{$congress}/explanations.json";
        return $this->makeCall($endpoint);
    }


    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/votes/#get-recent-personal-explanation-votes
     * @endpoint https://api.propublica.org/congress/v1/{congress}/explanations/votes.json
     *
     * @param $congress
     * @return array
     * @throws \Exception
     */
    public function recentVotes($congress)
    {
        $endpoint = "{$congress}/explanations/votes.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/votes/#get-recent-personal-explanation-votes-by-category
     * @endpoint https://api.propublica.org/congress/v1/{congress}/explanations/votes/{category}.json
     *
     * @param $category
     * @param $congress
     * @return array
     * @throws \Exception
     */
    public function byCategory($category, $congress)
    {
        $endpoint = "{$congress}/explanations/votes/{$category}.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/votes/#get-recent-personal-explanations-by-a-specific-member
     * @endpoint https://api.propublica.org/congress/v1/members/{member_id}/explanations/{congress}.json
     *
     * @param $memberId
     * @param $congress
     * @return array
     * @throws \Exception
     */
    public function recentByMember($memberId, $congress)
    {
        $endpoint = "members/{$memberId}/explanations/{$congress}.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/votes/#get-recent-personal-explanation-votes-by-a-specific-member
     * @endpoint https://api.propublica.org/congress/v1/members/{member_id}/explanations/{congress}/votes.json
     * @param $memberId
     * @param $congress
     * @return array
     * @throws \Exception
     */
    public function recentByMemberVotes($memberId, $congress)
    {
        $endpoint = "{$memberId}/explanations/{$congress}/votes.json";
        return $this->makeCall($endpoint);
    }

    /**
     * https://projects.propublica.org/api-docs/congress-api/votes/#get-recent-personal-explanation-votes-by-a-specific-member-by-category
     * @documentation https://projects.propublica.org/api-docs/congress-api/votes/#get-recent-personal-explanation-votes-by-a-specific-member-by-category
     * @endpoint https://api.propublica.org/congress/v1/members/{member_id}/explanations/{congress}/votes/{category}.json
     *
     * @param $memberId
     * @param $congress
     * @param $category
     * @return array
     * @throws \Exception
     */
    public function byMemberAndCategory($memberId, $congress, $category)
    {
        if(!$this->categories->has($category))
        {
            throw \Exception("{$category} is not an acceptable input.");
        }

        $endpoint = "{$memberId}/explanations/{$congress}/votes/{$category}.json";
        return $this->makecall($endpoint);
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }
}