<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 8/22/18
 * Time: 9:23 AM
 */

namespace DevelopingSonder\PropublicaCongress\Tests;

use DevelopingSonder\PropublicaCongress\Bills;
use DevelopingSonder\PropublicaCongress\Http\Connection;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class HttpTest extends TestCase
{
    public function testConnectionCreation(): void
    {
        $loader = new Dotenv(__DIR__ . "/../");
        $loader->load();

        $this->assertInstanceOf(Connection::class, Connection::instance());
    }

    public function testClientCreation()
    {
        $bills = new Bills();
        $this->assertInstanceOf(Bills::class, $bills);

        return $bills;
    }

    /**
     * @depends testClientCreation
     * @param Bills $bills
     * @throws
     */
    public function testResponseCreation(Bills $bills)
    {
        $bills = $bills->recent('116', 'house', 'active');
        $this->assertTrue(is_object($bills), "Response data is not in object form.");
    }
}