<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 2/13/19
 * Time: 12:16 PM
 */
namespace DevelopingSonder\PropublicaCongress\Traits;

trait CreatesResources
{
    public static function resource($items = [], $additional = [])
    {
        $collection = new static($items);
        return $collection->transform(function($item) use ($additional){
            return array_merge($item, $additional);
        })->mapInto(static::$resource);
    }
}