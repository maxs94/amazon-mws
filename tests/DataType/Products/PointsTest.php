<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\DataType\Products\Points;
use Maxs94\AmazonMws\DataType\Products\MoneyType;

final class PointsTest extends TestCase 
{

    public function testPoints() : void 
    {
        $p = new Points(1, new MoneyType(9.9, 'EUR'));
        $this->assertSame(Points::NAME, $p->getName());

        $this->assertSame(1, $p->getPointsNumber());
        $this->assertSame(9.9, $p->getPointsMonetaryValue()->getAmount());

    }

}

