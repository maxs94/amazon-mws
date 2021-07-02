<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\DataType\Amazon\AmazonStringList;

final class AmazonStringListTest extends TestCase 
{

    public function testValue() : void 
    {
        $s = new AmazonStringList('key', 'suffix', ['value1', 'value2', 'value3']);
        $kv = $s->getKeyValuePair();

        $this->assertSame('key', $s->getName());
        $this->assertIsArray($kv);
        $this->assertArrayHasKey('key.suffix.1', $kv);
        $this->assertSame('value1', $kv['key.suffix.1']);
        $this->assertSame('value2', $kv['key.suffix.2']);
        $this->assertSame('value3', $kv['key.suffix.3']);

    }

}