<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\DataType\Amazon\AmazonString;

final class AmazonStringTest extends TestCase 
{

    public function testValue() : void 
    {
        $s = new AmazonString('key', 'value');
        $kv = $s->getKeyValuePair();

        $this->assertSame('key', $s->getName());
        $this->assertIsArray($kv);
        $this->assertArrayHasKey('key', $kv);
        $this->assertSame('value', $kv['key']);

    }

}