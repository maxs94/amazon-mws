<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\DataType\Amazon\AmazonDateTime;

final class AmazonDateTimeTest extends TestCase 
{

    public function testValue() : void 
    {
        $time = \DateTime::createFromFormat('Y-m-d H:i:s', '1970-01-01 00:00:00');

        $s = new AmazonDateTime('key', $time);
        $kv = $s->getKeyValuePair();

        $this->assertSame('key', $s->getName());
        $this->assertIsArray($kv);
        $this->assertArrayHasKey('key', $kv);
        $this->assertSame('1970-01-01T00:00:00Z', $kv['key']);

    }

}