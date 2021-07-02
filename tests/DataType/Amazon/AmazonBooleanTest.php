<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\DataType\Amazon\AmazonBoolean;

final class AmazonBooleanTest extends TestCase 
{

    public function testValue() : void 
    {
        $s = new AmazonBoolean('key', true);
        $kv = $s->getKeyValuePair();

        $this->assertSame('key', $s->getName());
        $this->assertIsArray($kv);
        $this->assertArrayHasKey('key', $kv);
        $this->assertSame('true', $kv['key']);

    }

}