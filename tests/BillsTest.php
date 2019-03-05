<?php

namespace DevelopingSonder\PropublicaCongress;


use DevelopingSonder\PropublicaCongress\Http\Response;
use DevelopingSonder\PropublicaCongress\Clients\Bills;
use DevelopingSonder\PropublicaCongress\Resources\Bill;
use DevelopingSonder\PropublicaCongress\Helpers\BillsCollection;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class BillsTest extends TestCase
{

    public function testBillsClientCreation()
    {
        $loader = new Dotenv(__DIR__);
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
        $this->assertInstanceOf(Response::class, $bills);

        return $bills;
    }

    /**
     * @param $bills
     * @depends testCanSearchBills
     */
    public function testCanMakeBillsCollection($response)
    {
        $this->assertIsArray($response->results);
        $this->assertIsArray($response->items());

        $response = BillsCollection::resource($response->items());
        $this->assertContainsOnlyInstancesOf(Bill::class, $response);
        //$this->assertClassHasAttribute('attributes', Bill::class);
    }

    /**
     * @throws \Exception
     */
    public function testCanGetRecentBills()
    {
        $client = new Bills();

        $response = $client->recent('116', 'house', 'introduced');
        $this->assertInstanceOf(Response::class, $response);

        $coll = BillsCollection::resource($response->items());
        $this->assertGreaterThan(0, $coll->count());
    }

    /**
     * @return mixed
     */
    public function testCanGetRecentBillsByMember()
    {
        $client = new Bills();
        $response = $client->recentByMember('A000360', 'introduced');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertGreaterThan(0, $response->items());

        return $client;
    }

    /**
     * @return Bills
     * @throws \Exception
     *
     */
    public function testCanGetRecentBillsBySubject()
    {
        $client = new Bills();
        $response = $client->recentBySubject('Meat');

        $this->assertInstanceOf(Response::class, $response);

        $this->assertGreaterThan(0, count($response->items()));

        $response = $client->nextPage();
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(20, $response->offset);
        $this->assertGreaterThan(0, count($response->items()));

        $response = $client->nextPage();
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(40, $response->offset);
        $this->assertGreaterThan(0, count($response->items()));
        
        return $client;
    }



    /**
     * @return mixed
     */
    public function testCanGetUpcomingBills()
    {
        $client = new Bills();
        $response = $client->upcoming('house');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('OK', $response->status);

        $this->assertGreaterThan(0, count($response->items()));

        return $client;
    }

    /**
     * @return mixed
     */
    public function testCanFindBills()
    {
        $client = new Bills();
        $response = $client->find('hr21', '115');
        $bill = new Bill($response->item());

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('OK', $response->status);

        $this->assertEquals(1, count($response->results));
        $this->assertEquals('hr21', $bill->bill_slug);

        return $bill;
    }

    /**
     * @depends testCanFindBills
     * @param $bill
     * @return Bill
     * @throws \Exception
     */
    public function testCanGetAmendments($bill)
    {
        $client = new Bills();
        $response = $client->amendments($bill->bill_slug, $bill->congress);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('OK', $response->status);

        $this->assertGreaterThan(0, $response->items());

        return $bill;
    }


    /**
     * @depends testCanGetAmendments
     * @param $bill
     * @return mixed
     * @throws \Exception
     */
    public function testCanGetBillSubjects($bill)
    {
        $client = new Bills();
        $response = $client->subjects($bill->bill_slug, $bill->congress);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('OK', $response->status);

        $this->assertInstanceOf(\stdClass::class, $response->item());
        $this->assertObjectHasAttribute('subjects', $response->item());


        return $bill;
    }

    /**
     * @depends testCanGetBillSubjects
     * @param $bill
     * @return mixed
     * @throws \Exception
     */
    public function testCanGetRelatedBills($bill)
    {
        $client = new Bills();
        $response = $client->relatedBills($bill->bill_slug, $bill->congress);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('OK', $response->status);

        $this->assertInstanceOf(\stdClass::class, $response->item());
        $this->assertObjectHasAttribute('related_bills', $response->item());

        return $bill;
    }

    /**
     * @throws \Exception
     */
    public function testCanGetSpecificBillSubject()
    {
        $client = new Bills();
        $response = $client->specificBillSubject('climate');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('OK', $response->status);

        $this->assertInstanceOf(\stdClass::class, $response->item());
        $this->assertObjectHasAttribute('subjects', $response->item());
    }


    /**
     * @depends testCanGetRelatedBills
     * @param $bill
     * @return mixed
     * @throws \Exception
     */
    public function testCanGetCosponsorsForASpecificBill($bill)
    {
        $client = new Bills();
        $response = $client->cosponsors($bill->bill_slug, $bill->congress);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('OK', $response->status);

        $this->assertIsArray($response->items());

        return $bill;
    }

    //-- TODO: Negative Test for Bill ID



}