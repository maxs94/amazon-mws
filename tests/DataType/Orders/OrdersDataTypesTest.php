<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\DataType\Amazon\DataType;
use Maxs94\AmazonMws\DataType\Common\NextToken;
use Maxs94\AmazonMws\DataType\Orders\OrderStatus;
use Maxs94\AmazonMws\DataType\Orders\CreatedAfter;
use Maxs94\AmazonMws\DataType\Orders\AmazonOrderId;
use Maxs94\AmazonMws\DataType\Orders\CreatedBefore;
use Maxs94\AmazonMws\DataType\Orders\PaymentMethod;
use Maxs94\AmazonMws\DataType\Orders\SellerOrderId;
use Maxs94\AmazonMws\DataType\Orders\LastUpdatedAfter;
use Maxs94\AmazonMws\DataType\Orders\LastUpdatedBefore;
use Maxs94\AmazonMws\DataType\Orders\MaxResultsPerPage;
use Maxs94\AmazonMws\DataType\Orders\FulfillmentChannel;
use Maxs94\AmazonMws\DataType\Orders\EasyShipShipmentStatus;

final class OrdersDataTypesTest extends TestCase 
{

    protected $datetime;
    protected $datetimeString = '1970-01-01T00:00:00Z';

    protected function setUp() : void 
    {
        $this->datetime = \DateTime::createFromFormat('Y-m-d H:i:s', '1970-01-01 00:00:00');
    }

    private function dateTimeDataTypeTest(DataType $type) : void
    {
        $kv = $type->getKeyValuePair();

        $this->assertIsArray($kv);
        $this->assertArrayHasKey($type->getName(), $kv);
        $this->assertSame('1970-01-01T00:00:00Z', $kv[$type->getName()]);
    }

    private function listTest(DataType $type) : void 
    {
        $kv = $type->getKeyValuePair();

        $this->assertIsArray($kv);
        $this->assertArrayHasKey($type->getName() . '.' . $type->getSuffix() . '.1', $kv);

        // test wrong value 
        $this->expectException(\Exception::class);
        $values[] = 'XXX';
        $class = get_class($type);
        $test = new $class($values);
    }

    public function testCreatedBefore() : void 
    {
        $this->dateTimeDataTypeTest(new CreatedBefore($this->datetime));
    }

    public function testCreatedAfter() : void 
    {
        $this->dateTimeDataTypeTest(new CreatedAfter($this->datetime));
    }

    public function testLastUpdatedAfter() : void 
    {
        $this->dateTimeDataTypeTest(new LastUpdatedAfter($this->datetime));
    }

    public function testLastUpdatedBefore() : void 
    {
        $this->dateTimeDataTypeTest(new LastUpdatedBefore($this->datetime));
    }

    public function testEasyShipmentStatus() : void 
    {
        $values = ['Delivered'];
        $type = new EasyShipShipmentStatus($values);
        $this->listTest($type);
    }

    public function testFulfillmentChannel() : void 
    {
        $values = ['AFN'];
        $type = new FulfillmentChannel($values);
        $this->listTest($type);
    }

    public function testMaxResultsPerPage() : void 
    {
        $type = new MaxResultsPerPage(5);
        $kv = $type->getKeyValuePair();

        $this->assertIsArray($kv);
        $this->assertArrayHasKey($type->getName(), $kv);

        // wrong number 
        $this->expectException(\Exception::class);
        $type = new MaxResultsPerPage(999);
    }

    public function testOrderStatus() : void 
    {
        $values = ['Pending'];
        $type = new OrderStatus($values);
        $this->listTest($type);
    }

    public function testOrderStatusUnshipped() : void 
    {
        // test unshipped & partiallyshipped 
        $values = ['Unshipped'];
        $this->expectException(\Exception::class);
        $type = new OrderStatus($values);
    }

    public function testPaymentMethod() : void 
    {
        $values = ['Other'];
        $type = new PaymentMethod($values);
        $this->listTest($type);
    }

    public function testSellerOrderId() : void 
    {
        $type = new SellerOrderId('ID1');
        $kv = $type->getKeyValuePair();
        $this->assertIsArray($kv);
        $this->assertArrayHasKey($type->getName(), $kv);
        $this->assertSame('ID1', $kv[$type->getName()]);
    }

    public function testNextToken() : void 
    {
        $type = new NextToken('Token1');
        $kv = $type->getKeyValuePair();
        $this->assertIsArray($kv);
        $this->assertArrayHasKey($type->getName(), $kv);
        $this->assertSame('Token1', $kv[$type->getName()]);
    }

    public function testAmazonOrderId() : void 
    {
        $values[] = '123-1234567-1234567';
        $type = new AmazonOrderId($values);
        $this->listTest($type);

    }

    public function testWrongAmazonOrderId() : void 
    {
        $values[] = '123xxx';
        $this->expectException(\Exception::class);
        $type = new AmazonOrderId($values);
    }



}