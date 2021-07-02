<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\DataType\Products\Asin;
use Maxs94\AmazonMws\DataType\Products\IdList;
use Maxs94\AmazonMws\DataType\Products\IdType;
use Maxs94\AmazonMws\DataType\Products\AsinList;
use Maxs94\AmazonMws\DataType\Products\SellerSKU;
use Maxs94\AmazonMws\DataType\Products\SellerSKUList;
use Maxs94\AmazonMws\DataType\Products\QueryContextId;

final class ProductsDataTypesTest extends TestCase 
{

    protected $randomValues = [];

    protected function setUp() : void 
    {
        for ($i=0; $i<100; $i++) {
            $this->randomValues[] = uniqid();
        }

    }

    public function testAsin() : void 
    {
        
        $value = '123456';
        $type = new Asin($value);

        $kv = $type->getKeyValuePair();
        
        $this->assertIsArray($kv);
        $this->assertArrayHasKey($type->getName(), $kv);
        

    }

    public function testAsinList() : void 
    {
        $values = ['12345', '6789'];
        $type = new AsinList($values);

        $kv = $type->getKeyValuePair();

        $this->assertIsArray($kv);
        $this->assertArrayHasKey($type->getName() . '.' . $type->getSuffix() . '.1', $kv);
        $this->assertArrayHasKey($type->getName() . '.' . $type->getSuffix() . '.2', $kv);

        $this->expectException(\Exception::class);
        $type = new AsinList($this->randomValues);

    }

    public function testQueryContextId() : void 
    {
        $value = 'TEST';
        $type = new QueryContextId($value);

        $kv = $type->getKeyValuePair();
        $this->assertIsArray($kv);
        $this->assertArrayHasKey($type->getName(), $kv);
    }

    public function testSellerSKU() : void 
    {
        $value = 'SKUTEST';
        $type = new SellerSKU($value);

        $kv = $type->getKeyValuePair();
        $this->assertIsArray($kv);
        $this->assertArrayHasKey($type->getName(), $kv);
    }

    public function testSellerSKUList() : Void 
    {
        $values = ['TEST1', 'TEST2'];
        $type = new SellerSKUList($values);

        $kv = $type->getKeyValuePair();
        $this->assertIsArray($kv);
        $this->assertArrayHasKey($type->getName() . '.' . $type->getSuffix() . '.1', $kv);

        // test too many values 
        for ($i=0; $i<100; $i++) {
            $values[] = 'VAL-' . $i;
        }
        $this->expectException(\Exception::class);
        $type = new SellerSKUList($values);

    }

    public function testIdList() : void 
    {
        $values = ['1', '2', '3', '4', '5'];
        $type = new IdList($values);

        $kv = $type->getKeyValuePair();
        $this->assertIsArray($kv);
        $this->assertArrayHasKey($type->getName() . '.' . $type->getSuffix() . '.1', $kv);

        // test too many values 
        $values[] = '6';
        $this->expectException(\Exception::class);
        $type = new IdList($values);
        
    }
   
    public function testIdType() : void 
    {
        $type = new IdType('ASIN');

        $kv = $type->getKeyValuePair();
        $this->assertIsArray($kv);
        $this->assertArrayHasKey($type->getName(), $kv);

        // test wrong
        $this->expectException(\Exception::class);
        $type = new IdType('XXX');
        
    }

}