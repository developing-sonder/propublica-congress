<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 1/8/19
 * Time: 1:11 PM
 */

namespace DevelopingSonder\PropublicaCongress\Resources;

use Illuminate\Support\Collection;

abstract class BaseResource
{
    protected $attributes;

    public function __construct($attributes)
    {
        $this->attributes = new Collection($attributes);
    }

    public function __get($name)
    {
        return $this->attributes->get($name);
    }

    public function __set($name, $value)
    {
        $this->attributes->put($name, $value);
    }

    public function all()
    {
        return $this->attributes->all();
    }

    public function __call($name, $arguments)
    {
        try {
            return $this->attributes->{$name}($arguments);
        }catch(\Exception $e)
        {
            throw new \BadMethodCallException($e);
        }
    }

}