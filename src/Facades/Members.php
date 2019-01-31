<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 12/20/18
 * Time: 10:01 AM
 */

namespace DevelopingSonder\PropublicaCongress\Facades;


use Illuminate\Support\Facades\Facade;

class Members extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'members';
    }
}