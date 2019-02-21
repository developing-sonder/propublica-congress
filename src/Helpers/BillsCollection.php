<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 2/20/19
 * Time: 6:33 PM
 */

namespace DevelopingSonder\PropublicaCongress\Helpers;


use DevelopingSonder\PropublicaCongress\Traits\CreatesResources;

class BillsCollection extends ResourceCollection
{
    use CreatesResources;
    public $resource = Bill::class;
}