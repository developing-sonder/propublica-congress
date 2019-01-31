<?php
namespace DevelopingSonder\PropublicaCongress\Facades;


use Illuminate\Support\Facades\Facade;

class ProPublicaBills extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'bills';
    }
}