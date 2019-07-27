<?php

namespace DevelopingSonder\PropublicaCongress;

use DevelopingSonder\PropublicaCongress\Http\Response;
use DevelopingSonder\PropublicaCongress\Clients\BillsClient;
use DevelopingSonder\PropublicaCongress\Resources\Bill;
use DevelopingSonder\PropublicaCongress\Helpers\BillsCollection;

use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class BillsTest extends TestCase
{

    public function testBillsClientCreation()
    {
        $loader = Dotenv::create(__DIR__);
        $loader->load();

        $billsClient = new BillsClient();
        $this->assertInstanceOf(BillsClient::class, $billsClient);

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

        $this->assertInstanceOf(Response::class, $client->response());
        $this->assertEquals('OK', $client->response()->status);
        $this->assertIsArray($bills);

        return $bills;
    }

    /**
     * @depends testCanSearchBills
     * @param $bills
     * @depends testCanSearchBills
     */
    public function testCanMakeBillsCollection($bills)
    {
        $response = BillsCollection::resource($bills);
        $this->assertContainsOnlyInstancesOf(Bill::class, $response);
        //$this->assertClassHasAttribute('attributes', Bill::class);
    }

    /**
     * @throws \Exception
     */
    public function testCanGetRecentBills()
    {
        $client = new BillsClient();

        $bills = $client->recent('116', 'house', 'introduced');

        $this->assertInstanceOf(Response::class, $client->response());
        $this->assertIsArray($bills);

        $coll = BillsCollection::resource($bills);
        $this->assertGreaterThan(0, $coll->count());
    }

    /**
     * @throws \Exception
     */
    public function testCanGetRecentBillsByMember()
    {
        $client = new BillsClient();
        $bills = $client->recentByMember('A000360', 'introduced');

        $this->assertInstanceOf(Response::class, $client->response());
        $this->assertGreaterThan(0, $bills);
    }

    /**
     * @return BillsClient
     * @throws \Exception
     *
     */
    public function testCanGetRecentBillsBySubject()
    {
        $client = new BillsClient();
        $bills = $client->recentBySubject('Meat');

        $this->assertInstanceOf(Response::class, $client->response());
        $this->assertGreaterThan(0, count($bills));
        
        return $client;
    }

    /**
     * @depends testCanGetRecentBillsBySubject
     * @param $client
     */
    public function testBillsClientCanGetNextPage($client)
    {
        $bills = $client->nextPage();
        $this->assertInstanceOf(Response::class, $client->response());
        $this->assertEquals(20, $client->response()->offset);
        $this->assertGreaterThan(0, count($bills));

        $bills = $client->nextPage();
        $this->assertInstanceOf(Response::class, $client->response());
        $this->assertEquals(40, $client->response()->offset);
        $this->assertGreaterThan(0, count($bills));
    }


    /**
     * @throws \Exception
     */
    public function testCanGetUpcomingBills()
    {
        $client = new BillsClient();
        $bills = $client->upcoming('house');

        $this->assertInstanceOf(Response::class, $client->response());
        $this->assertEquals('OK', $client->response()->status);
        $this->assertGreaterThan(0, count($bills));
    }

    /**
     * @return Bill
     * @throws \Exception
     */
    public function testCanFindBills()
    {
        $client = new BillsClient();
        $bill = $client->find('hr21', '115');

        $this->assertInstanceOf(Response::class, $client->response());
        $this->assertEquals('OK', $client->response()->status);
        $this->assertInstanceOf(\stdClass::class, $bill);

        $bill = new Bill($bill);
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
        $client = new BillsClient();
        $amendments = $client->amendments($bill->bill_slug, $bill->congress);

        $this->assertInstanceOf(Response::class, $client->response());
        $this->assertEquals('OK', $client->response()->status);

        $this->assertGreaterThan(0, $amendments);

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
        $client = new BillsClient();
        $subjects = $client->subjects($bill->bill_slug, $bill->congress);

        $this->assertInstanceOf(Response::class, $client->response());
        $this->assertEquals('OK', $client->response()->status);

        $this->assertInstanceOf(\stdClass::class, $client->response()->item());
        $this->assertObjectHasAttribute('subjects', $client->response()->item());


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
        $client = new BillsClient();
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
        $client = new BillsClient();
        $subjects = $client->specificBillSubject('climate');

        $this->assertInstanceOf(Response::class, $client->response());
        $this->assertEquals('OK', $client->response()->status);

        $this->assertIsArray($subjects);
        $this->assertObjectHasAttribute('subjects', $client->response()->item());
    }


    /**
     * @depends testCanGetRelatedBills
     * @param $bill
     * @return mixed
     * @throws \Exception
     */
    public function testCanGetCosponsorsForASpecificBill($bill)
    {
        $client = new BillsClient();
        $cosponsors = $client->cosponsors($bill->bill_slug, $bill->congress);

        $this->assertInstanceOf(Response::class, $client->response());
        $this->assertEquals('OK', $client->response()->status);

        $this->assertIsArray($cosponsors);

        return $bill;
    }

    //-- TODO: Negative Test for Bill ID



}