<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 12/5/18
 * Time: 8:23 AM
 */

namespace DevelopingSonder\PropublicaCongress;
use DevelopingSonder\PropublicaCongress\Http\Client;
use DevelopingSonder\PropublicaCongress\Resources\Bill;
use Illuminate\Support\Collection;


class Bills extends Client
{

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#search-bills
     * @endpoint https://api.propublica.org/congress/v1/bills/search.json?query={query}
     *
     * @param $query
     * @param string $sort
     * @param string $dir
     * @return Collection
     * @throws \Exception
     */
    public function search($query, $sort = 'date', $dir = 'desc')
    {
        $endpoint = "bills/search.json?query={$query}&sort={$sort}&dir={$dir}";
        $response = $this->makeCall($endpoint);

        return $this->makeBillsCollection($response);
    }

    /**
     * @documentation https://api.propublica.org/congress/v1/{congress}/{chamber}/bills/{type}.json
     * @endpoint https://projects.propublica.org/api-docs/congress-api/bills/#get-recent-bills
     *
     * @param $congress
     * @param $chamber
     * @param $type
     * @return Collection
     * @throws \Exception
     *
     * Options for Type: introduced, updated, active, passed, enacted, or vetoed
     */
    public function recent($congress, $chamber, $type)
    {
        $endpoint = "{$congress}/{$chamber}/bills/{$type}.json";
        $response = $this->makeCall($endpoint);

        return $this->makeBillsCollection($response);
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
    public function recentByMember($memberId, $type)
    {
        $endpoint = "members/{$memberId}/bills/{$type}.json";
        $response = $this->makeCall($endpoint);

        return $this->makeBillsCollection($response);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-recent-bills-by-a-specific-subject
     * @endpoint https://api.propublica.org/congress/v1/bills/subjects/{subject}.json
     *
     * @param $subject
     * @return array
     * @throws \Exception
     */
    public function recentBySubject($subject)
    {
        $endpoint = "bills/subjects/{$subject}.json";
        $response = $this->makeCall($endpoint);

        return $this->makeBillsCollection($response);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-upcoming-bills
     * @endpoint https://api.propublica.org/congress/v1/bills/upcoming/{chamber}.json
     *
     * @param $chamber
     * @return array
     * @throws \Exception
     */
    public function upcoming($chamber)
    {
        $endpoint = "bills/upcoming/{$chamber}.json";
        $response = $this->makeCall($endpoint);

        return $this->makeBillsCollection($response);
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
    public function find($id, $congress)
    {
        $endpoint = "{$congress}/bills/{$id}.json";
        $response = $this->makeCall($endpoint);

        return $this->makeBillsCollection($response);
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
    public function amendments($id, $congress)
    {
        $endpoint = "{$congress}/bills/{$id}/amendments.json";
        $response = $this->makeCall($endpoint);

        return $this->makeBillsCollection($response);
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
    public function subjects($id, $congress)
    {
        $endpoint = "{$congress}/bills/{$id}/subjects.json";
        $response = $this->makeCall($endpoint);

        return $this->makeBillsCollection($response);
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
        $response = $this->makeCall($endpoint);

        return $this->makeBillsCollection($response);
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
        $response = $this->makeCall($endpoint);

        return $this->makeBillsCollection($response);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/bills/#get-cosponsors-for-a-specific-bill
     * @endpoint GET https://api.propublica.org/congress/v1/{congress}/bills/{bill-id}/cosponsors.json
     *
     * @param $id
     * @param $congress
     * @return Collection
     * @throws \Exception
     */
    public function cosponsors($id, $congress)
    {
        $endpoint = "{$congress}/bills/{$id}/cosponsors.json";
        $response = $this->makeCall($endpoint);

        return $this->makeBillsCollection($response);
    }

    /**
     * @param $response
     * @return Collection
     */
    protected function makeBillsCollection($response)
    {
        $bills = new Collection();

        if (!count($response->bills)) {
           return $bills;
        }
        
        foreach ($response->bills as $billsArray)
        {
            $bill = new Bill($billsArray);
            $bill->chamber = $this->lastResponse->chamber;
            $bill->congress = $this->lastResponse->congress;

            $bills->push($bill);
        }

        return $bills;
    }

    /**
     * @return Collection|void
     * @throws \Exception
     */
    public function nextPage()
    {
        parent::nextPage();

        $response = $this->makeCall($this->lastEndpoint, $this->lastOptions);
        return $this->makeBillsCollection($response);
    }
}