<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\DataType\Amazon\AmazonEmail;

final class AmazonEmailTest extends TestCase 
{

    public function testValidEmail() : void 
    {
        $s = new AmazonEmail('key', 'test@test.net');
        $kv = $s->getKeyValuePair();

        $this->assertSame('key', $s->getName());
        $this->assertIsArray($kv);
        $this->assertArrayHasKey('key', $kv);
        $this->assertSame('test@test.net', $kv['key']);

    }

    public function testInvalidEmail() : void 
    {
        $this->expectException(\Exception::class);
        $s = new AmazonEmail('key', 'invalid-email-test-net');
    }

}