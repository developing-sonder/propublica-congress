<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 2/12/19
 * Time: 3:42 PM
 */

namespace DevelopingSonder\PropublicaCongress\Helpers;


use Illuminate\Support\Collection;

abstract class ResourceCollection extends Collection
{
    public static function make($items = [], $additional = [])
    {
        $collection = new static($items);
        return $collection->transform(function($item) use ($additional){
            return array_merge($item, $additional);
        })->mapInto(static::$resource);
    }
}