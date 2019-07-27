<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 1/8/19
 * Time: 3:01 PM
 */

namespace DevelopingSonder\PropublicaCongress\Resources;


use DevelopingSonder\PropublicaCongress\Clients\BillsClient;

class Bill extends BaseResource
{
    public static function get($slug, $congress)
    {
        $client = new BillsClient();
        $bill = $client->find($slug, $congress);

        return new self($bill);
    }
}