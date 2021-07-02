<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\DataType\Products\MoneyType;

final class MoneyTypeTest extends TestCase 
{

    public function testWrongCurrency() : void 
    {
        $this->expectException(\Exception::class);
        $mt = new MoneyType(9.9, 'XXX');
        
    }

    public function testName() : void 
    {
        $mt = new MoneyType(9.9, 'EUR');
        $this->assertSame(MoneyType::NAME, $mt->getName());
    }

    public function testSetAmount() : void 
    {
        $mt = new MoneyType(9.9, 'EUR');
        $this->assertSame(9.9, $mt->getAmount());

        $mt->setAmount(3.9);
        $this->assertSame(3.9, $mt->getAmount());
    }


}
