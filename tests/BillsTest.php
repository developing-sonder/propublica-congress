<?php

namespace DevelopingSonder\PropublicaCongress;


use DevelopingSonder\PropublicaCongress\Resources\Bill;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class BillsTest extends TestCase
{
    public function testBillsClientCreation()
    {
        $loader = new Dotenv(__DIR__ . "/../");
        $loader->load();

        $billsClient = new Bills();
        $this->assertInstanceOf(Bills::class, $billsClient);

        return $billsClient;
    }

    /**
     * @depends testBillsClientCreation
     * @param $client
     * @return Collection
     */
    public function testCanSearchBills($client)
    {
        $bills = $client->search("military", "date", "asc");

        $this->assertInstanceOf(Collection::class, $bills);

        return $bills;
    }

    /**
     * @param $bills
     * @depends testCanSearchBills
     */
    public function testCanMakeBillsCollection($bills)
    {
        $this->assertContainsOnlyInstancesOf(Bill::class, $bills);
        $this->assertClassHasAttribute('attributes', Bill::class);
    }

    /**
     * @depends testBillsClientCreation
     * @param $client
     */
    public function testCanGetRecentBills($client)
    {
        $bills = $client->recent('116', 'house', 'introduced');

        $this->assertInstanceOf(Collection::class, $bills);
        $this->assertGreaterThan(0, $bills->count());
    }
}