<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\DataType\MarketPlace;
use Maxs94\AmazonMws\DataType\MarketplaceList;

final class DataTypesTest extends TestCase 
{

    public function testMarketPlace() : void 
    {
        
        $value = 'DE';
        $type = new MarketPlace($value);

        $kv = $type->getKeyValuePair();
        
        $this->assertIsArray($kv);
        $this->assertArrayHasKey($type->getName(), $kv);
        

    }

    public function testMarketplaceList() : void 
    {
        $values = [new Marketplace('DE'), new Marketplace('BR')];
        $type = new MarketplaceList($values);

        $kv = $type->getKeyValuePair();

        $this->assertIsArray($kv);
        $this->assertArrayHasKey($type->getName() . '.' . $type->getSuffix() . '.1', $kv);
        $this->assertArrayHasKey($type->getName() . '.' . $type->getSuffix() . '.2', $kv);

    }

    public function testMarketplaceListTooManyValues() : void 
    {
        $values = [];
        for ($i=0; $i<100; $i++) {
            $values[] = uniqid();
        }

        $this->expectException(\Exception::class);
        $type = new MarketplaceList($values);

    }

}