<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\DataType\Amazon\AmazonInteger;

final class AmazonIntegerTest extends TestCase 
{

    public function testValue() : void 
    {
        $s = new AmazonInteger('key', 42);
        $kv = $s->getKeyValuePair();

        $this->assertSame('key', $s->getName());
        $this->assertIsArray($kv);
        $this->assertArrayHasKey('key', $kv);
        $this->assertSame(42, $kv['key']);

    }

}