<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 1/10/19
 * Time: 10:35 AM
 */

namespace DevelopingSonder\PropublicaCongress\Resources;


class VoteResource extends BaseResource
{
    public function passed()
    {
        return strtolower($this->result) == 'passed';
    }

    public function failed()
    {
        return strtolower($this->result) == 'failed';
    }


}