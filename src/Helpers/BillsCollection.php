<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 2/20/19
 * Time: 6:33 PM
 */

namespace DevelopingSonder\PropublicaCongress\Helpers;


use DevelopingSonder\PropublicaCongress\Traits\CreatesResources;
use DevelopingSonder\PropublicaCongress\Resources\Bill;

class BillsCollection extends ResourceCollection
{
    use CreatesResources;
    public static $resource = Bill::class;
}