<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 12/5/18
 * Time: 8:23 AM
 */

namespace DevelopingSonder\PropublicaCongress;


class Bills extends Client
{

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#search-bills
     * @endpoint https://api.propublica.org/congress/v1/bills/search.json?query={query}
     *
     * @param $query
     * @param string $sort
     * @param string $dir
     * @return array
     * @throws \Exception
     */
    public static function search($query, $sort = 'date', $dir = 'desc')
    {
        $endpoint = "bills/search.json?query={$query}&sort={$sort}&dir={$dir}";
        return static::makeCall($endpoint);
    }

    /**
     * @documentation https://api.propublica.org/congress/v1/{congress}/{chamber}/bills/{type}.json
     * @endpoint https://projects.propublica.org/api-docs/congress-api/bills/#get-recent-bills
     *
     * @param $congress
     * @param $chamber
     * @param $type
     * @return array
     * @throws \Exception
     *
     * Options for Type: introduced, updated, active, passed, enacted, or vetoed
     */
    public static function recent($congress, $chamber, $type)
    {
        $endpoint = "{$congress}/{$chamber}/bills/{$type}.json";
        return static::makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-recent-bills-by-a-specific-member
     * @endpoint https://api.propublica.org/congress/v1/members/{member-id}/bills/{type}.json
     *
     * @param $memberId
     * @param $type
     * @return array
     * @throws \Exception
     */
    public static function recentByMember($memberId, $type)
    {
        $endpoint = "members/{$memberId}/bills/{$type}.json";
        return static::makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-recent-bills-by-a-specific-subject
     * @endpoint https://api.propublica.org/congress/v1/bills/subjects/{subject}.json
     *
     * @param $subject
     * @return array
     * @throws \Exception
     */
    public static function recentBySubject($subject)
    {
        $endpoint = "bills/subjects/{$subject}.json";
        return static::makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-upcoming-bills
     * @endpoint https://api.propublica.org/congress/v1/bills/upcoming/{chamber}.json
     *
     * @param $chamber
     * @return array
     * @throws \Exception
     */
    public static function upcoming($chamber)
    {
        $endpoint = "bills/upcoming/{$chamber}.json";
        return static::makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-a-specific-bill
     * @endpoint https://api.propublica.org/congress/v1/{congress}/bills/{bill-id}.json
     *
     * @param $id
     * @param $congress
     * @return array
     * @throws \Exception
     */
    public static function find($id, $congress)
    {
        $endpoint = "{$congress}/bills/{$id}.json";
        return static::makecall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-amendments-for-a-specific-bill
     * @endpoint https://api.propublica.org/congress/v1/{congress}/bills/{bill-id}/amendments.json
     *
     * @param $id
     * @param $congress
     * @return array
     * @throws \Exception
     */
    public static function amendments($id, $congress)
    {
        $endpoint = "{$congress}/bills/{$id}/amendments.json";
        return static::makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-subjects-for-a-specific-bill
     * @endpoint GET https://api.propublica.org/congress/v1/{congress}/bills/{bill-id}/subjects.json
     *
     * @param $id
     * @param $congress
     * @return array
     * @throws \Exception
     */
    public static function subjects($id, $congress)
    {
        $endpoint = "{$congress}/bills/{$id}/subjects.json";
        return static::makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-related-bills-for-a-specific-bill
     * @endpoint https://api.propublica.org/congress/v1/{congress}/bills/{bill-id}/related.json
     *
     * @param $id
     * @param $congress
     * @return array
     * @throws \Exception
     */
    public static function relatedBills($id, $congress)
    {
        $endpoint = "{$congress}/bills/{$id}/related.json";
        return static::makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-a-specific-bill-subject
     * @endpoint GET https://api.propublica.org/congress/v1/bills/subjects/search.json
     *
     * @param $query
     * @return array
     * @throws \Exception
     */
    public function searchBySubject($query)
    {
        $endpoint = "bills/subject/search.json?query={$query}";
        return static::makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-cosponsors-for-a-specific-bill
     * @endpoint GET https://api.propublica.org/congress/v1/{congress}/bills/{bill-id}/cosponsors.json
     *
     * @param $id
     * @param $congress
     * @return array
     * @throws \Exception
     */
    public static function cosponsors($id, $congress)
    {
        $endpoint = "{$congress}/bills/{$id}/cosponsors.json";
        return static::makeCall($endpoint);
    }
}