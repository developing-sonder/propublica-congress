<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 1/10/19
 * Time: 10:47 AM
 */

namespace DevelopingSonder\PropublicaCongress\Helpers;

use DevelopingSonder\PropublicaCongress\Resources\Member;
use DevelopingSonder\PropublicaCongress\Traits\CreatesResources;

class MembersCollection extends ResourceCollection
{
    use CreatesResources;
    public $resource = Member::class;
}