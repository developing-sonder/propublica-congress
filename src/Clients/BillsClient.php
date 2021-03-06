<?php
namespace DevelopingSonder\PropublicaCongress\Clients;

use DevelopingSonder\PropublicaCongress\Http\Response;
use DevelopingSonder\PropublicaCongress\Resources\Member;

class BillsClient extends BaseClient
{

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#search-bills
     * @endpoint https://api.propublica.org/congress/v1/bills/search.json?query={query}
     *
     * @param $query
     * @param string $sort
     * @param string $dir
     * @return Response
     * @throws \Exception
     */
    public function search($query, $sort = 'date', $dir = 'desc')
    {
        $endpoint = "bills/search.json?query={$query}&sort={$sort}&dir={$dir}";
        $response = $this->makeCall($endpoint);

        return $response->items();
    }

    /**
     * @documentation https://api.propublica.org/congress/v1/{congress}/{chamber}/bills/{type}.json
     * @endpoint https://projects.propublica.org/api-docs/congress-api/bills/#get-recent-bills
     *
     * @param $congress
     * @param $chamber
     * @param $type
     * @return Response
     * @throws \Exception
     *
     * Options for Type: introduced, updated, active, passed, enacted, or vetoed
     */
    public function recent($congress, $chamber, $type)
    {
        $endpoint = "{$congress}/{$chamber}/bills/{$type}.json";
        $response =  $this->makeCall($endpoint);

        return $response->items();
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-recent-bills-by-a-specific-member
     * @endpoint https://api.propublica.org/congress/v1/members/{member-id}/bills/{type}.json
     *
     * @param $member
     * @param $type
     * @return Response
     * @throws \Exception
     */
    public function recentByMember($member, $type)
    {
        $memberId = ($member instanceof Member)? $member->id : $member;

        $endpoint = "members/{$memberId}/bills/{$type}.json";
        $response = $this->makeCall($endpoint);

        return $response->items();
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-recent-bills-by-a-specific-subject
     * @endpoint https://api.propublica.org/congress/v1/bills/subjects/{subject}.json
     *
     * @param $subject
     * @return Response
     * @throws \Exception
     */
    public function recentBySubject($subject)
    {
        $endpoint = "bills/subjects/{$subject}.json";
        $response = $this->makeCall($endpoint);

        return $response->items();
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-upcoming-bills
     * @endpoint https://api.propublica.org/congress/v1/bills/upcoming/{chamber}.json
     *
     * @param $chamber
     * @return Response
     * @throws \Exception
     */
    public function upcoming($chamber)
    {
        $endpoint = "bills/upcoming/{$chamber}.json";
        $response = $this->makeCall($endpoint);

        return $response->items();
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-a-specific-bill
     * @endpoint https://api.propublica.org/congress/v1/{congress}/bills/{bill-id}.json
     *
     * @param $id
     * @param $congress
     * @return Response
     * @throws \Exception
     */
    public function find($id, $congress)
    {
        $endpoint = "{$congress}/bills/{$id}.json";
        $response = $this->makeCall($endpoint);

        return $response->item();
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-amendments-for-a-specific-bill
     * @endpoint https://api.propublica.org/congress/v1/{congress}/bills/{bill-id}/amendments.json
     *
     * @param $id
     * @param $congress
     * @param $onlyAmendments
     * @return mixed
     * @throws \Exception
     */
    public function amendments($id, $congress, $onlyAmendments = true)
    {
        $endpoint = "{$congress}/bills/{$id}/amendments.json";
        $response = $this->makeCall($endpoint);

        return ($onlyAmendments) ?
            $response->results()[0]->amendments :
            $response->results()[0];
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-subjects-for-a-specific-bill
     * @endpoint GET https://api.propublica.org/congress/v1/{congress}/bills/{bill-id}/subjects.json
     *
     * @param $id
     * @param $congress
     * @param $onlySubjects
     * @return Response
     * @throws \Exception
     */
    public function subjects($id, $congress, $onlySubjects = false)
    {
        $endpoint = "{$congress}/bills/{$id}/subjects.json";
        $response = $this->makeCall($endpoint);

        return ($onlySubjects) ?
            $response->results()[0]->subjects :
            $response->results()[0];
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
    public function relatedBills($id, $congress)
    {
        $endpoint = "{$congress}/bills/{$id}/related.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-a-specific-bill-subject
     * @endpoint GET https://api.propublica.org/congress/v1/bills/subjects/search.json
     *
     * @param $query
     * @return Response
     * @throws \Exception
     */
    public function specificBillSubject($query, $onlySubjects = true)
    {
        $endpoint = "bills/subjects/search.json?query={$query}";
        $response = $this->makeCall($endpoint);

        return ($onlySubjects)?
            $response->results()[0]->subjects :
            $response->results()[0];
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-cosponsors-for-a-specific-bill
     * @endpoint GET https://api.propublica.org/congress/v1/{congress}/bills/{bill-id}/cosponsors.json
     *
     * @param $id
     * @param $congress
     * @return Response
     * @throws \Exception
     */
    public function cosponsors($id, $congress)
    {
        $endpoint = "{$congress}/bills/{$id}/cosponsors.json";
        $response = $this->makeCall($endpoint);

        return $response->items();
    }
}