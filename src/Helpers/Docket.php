<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 12/12/18
 * Time: 8:33 PM
 */

namespace DevelopingSonder\PropublicaCongress\Http;


use DevelopingSonder\PropublicaCongress\Client;

class Docket extends Client
{
    protected $endpoint = '';
    protected $page = 0;
    protected $offset = 20;
    protected $sort = 'date';
    protected $dir = 'desc';
    protected $keyword = '';


    /**
     * Query constructor.
     */
    public function __construct()
    {
        return $this;
    }

    public function bills()
    {
        $this->endpoint = 'bills';
        return $this;
    }

    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function byScore()
    {
        $this->sort = "_score";
        return $this;
    }

    public function page($page)
    {
        $this->page = $page;
        return $this;
    }

    public function keyword($keyword)
    {
        $this->keyword = $keyword;
        return $this;
    }

    public function next()
    {
        $this->page++;
        return $this->get();
    }

    public function get()
    {
        $this->validateQuery();

        $endpoint = "{$this->endpoint}/search.json?query={$this->sort}&sort={$this->sort}&dir={$this->dir}";
        return static::makeCall($endpoint);
    }

    private function validateQuery()
    {
        return true;
    }

}