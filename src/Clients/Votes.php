<?php
namespace DevelopingSonder\PropublicaCongress\Clients;

use Carbon\Carbon;
use DevelopingSonder\PropublicaCongress\Http\BaseClient;

class Votes extends BaseClient
{
    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/votes/#get-recent-votes
     * @endpoint GET https://api.propublica.org/congress/v1/{chamber}/votes/recent.json
     *
     * @param $chamber
     * @return array
     * @throws \Exception
     *
     * Options for Chamber: House or Senate
     */
    public function recent($chamber)
    {
        $endpoint = "{$chamber}/votes/recent.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/votes/#get-a-specific-roll-call-vote
     * @endpoint https://api.propublica.org/congress/v1/{congress}/{chamber}/sessions/{session-number}/votes/{roll-call-number}.json
     *
     * @param $congress
     * @param $chamber
     * @param $sessionNumber
     * @param $rollCallNumber
     * @return array
     * @throws \Exception
     */
    public function rollCall($congress, $chamber, $sessionNumber, $rollCallNumber)
    {
        $endpoint = "{$congress}/{$chamber}/sessions/{$sessionNumber}/votes/{$rollCallNumber}.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/votes/#get-votes-by-type
     * @endpoint https://api.propublica.org/congress/v1/{congress}/{chamber}/sessions/{session-number}/votes/{roll-call-number}.json
     *
     * @param $congress
     * @param $chamber
     * @param $voteType
     * @return array
     * @throws \Exception
     */
    public function byType($congress, $chamber, $voteType)
    {
        $endpoint = "{$congress}/{$chamber}/votes/{$voteType}.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/votes/#get-votes-by-date
     * @endpoint https://api.propublica.org/congress/v1/{chamber}/votes/{year}/{month}.json
     *
     * @param $chamber
     * @param $year
     * @param $month
     * @return array
     * @throws \Exception
     */
    public function byDate($chamber, $year, $month)
    {
        $year = Carbon::parse($year)->format('Y');
        $month = Carbon::parse($month)->format('m');

        $endpoint = "{$chamber}/votes/{$year}/{$month}.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentation https://projects.propublica.org/api-docs/congress-api/votes/#get-votes-by-date
     * @endpoint https://api.propublica.org/congress/v1/{chamber}/votes/{start-date}/{end-date}.json
     *
     * @param $chamber
     * @param $startDate
     * @param $endDate
     * @return array
     * @throws \Exception
     */
    public function byDateRange($chamber, $startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate)->format('Y-m-d');
        $endDate = Carbon::parse($endDate)->format('Y-m-d');

        $endpoint = "{$chamber}/votes/{$startDate}/{$endDate}.json";
        return $this->makeCall($endpoint);
    }

    /**
     * @documentaion https://projects.propublica.org/api-docs/congress-api/votes/#get-senate-nomination-votes
     * @endpoint https://api.propublica.org/congress/v1/{congress}/nominations.json
     *
     * @param $congress
     * @return array
     * @throws \Exception
     */
    public function senateNominations($congress)
    {
        $endpoint = "{$congress}/nominations.json";
        return $this->makeCall($endpoint);
    }





}