<?php
namespace DevelopingSonder\PropublicaCongress\Resources;

use DevelopingSonder\PropublicaCongress\Helpers\VotesCollection;
use DevelopingSonder\PropublicaCongress\Members;
use DevelopingSonder\PropublicaCongress\Resources\Vote;

class Member extends BaseResource
{
    protected $memberClient;

    public function __construct($attributes)
    {
        parent::__construct($attributes);

        $this->checkForVotes();
    }

    /**
     * @return string
     */
    public function fullName()
    {
        return $this->attributes->get('first_name') . " " . $this->attributes->get('middle_name') . " " . $this->attributes->get('last_name');
    }

    /**
     * @return string
     */
    public function party()
    {
        switch(strtolower($this->party)) {
            case 'r':
                return 'Republican';
            case 'd':
                return 'Democrat';
            case 'i':
                return 'Independent';
            default:
                return 'Unknown';
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function votes()
    {
        $client = $this->getMemberClient();
        $response = $client->memberVotePositions($this->id);

        $votes = array_map(function($vote) {
            return new Vote($vote);
        }, $response);

        $this->attributes->votes = $votes;

        return $this->attributes->votes;
    }

    /**
     * @return Members
     */
    protected function getMemberClient()
    {
        if(!$this->memberClient) {
            $this->memberClient = new Members();
        }

        return $this->memberClient;
    }

    /**
     *
     */
    protected function checkForVotes()
    {
        //dd($this->attributes);
        if($this->attributes->has('votes') && is_array($this->votes)) {
            $votes = array_map(function($vote) {
                return new Vote($vote);
            }, $this->votes);

            $this->votes = new VotesCollection($votes);
        }
    }

}