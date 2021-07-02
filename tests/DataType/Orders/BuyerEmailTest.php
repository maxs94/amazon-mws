<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\DataType\Orders\BuyerEmail;

final class BuyerEmailTest extends TestCase 
{

    public function testValidEmail() : void 
    {
        $s = new BuyerEmail('test@test.net');
        $kv = $s->getKeyValuePair();

        $this->assertSame(BuyerEmail::NAME, $s->getName());
        $this->assertIsArray($kv);
        $this->assertArrayHasKey($s->getName(), $kv);
        $this->assertSame('test@test.net', $kv[$s->getName()]);

    }

    public function testInvalidEmail() : void 
    {
        $this->expectException(\Exception::class);
        $s = new BuyerEmail('invalid-email-test-net');
    }

}