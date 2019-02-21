<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 1/10/19
 * Time: 10:47 AM
 */

namespace DevelopingSonder\PropublicaCongress\Helpers;

use DevelopingSonder\PropublicaCongress\Resources\Vote;
use DevelopingSonder\PropublicaCongress\Traits\CreatesResources;

class VotesCollection extends ResourceCollection
{
    use CreatesResources;
    public $resource = Vote::class;

    public function havePassed()
    {
        $passed = $this->filter(function($vote){
            return $vote->passed();
        });

        return $passed;
    }

    public function haveFailed()
    {
        $passed = $this->filter(function($vote){
            return $vote->passed();
        });

        return $passed;
    }
}