<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\DataType\Products\ItemCondition;

final class ItemConditionTest extends TestCase 
{

    public function testName() : void 
    {
        $ic = new ItemCondition('Any');
        $this->assertSame(ItemCondition::NAME, $ic->getName());
    }

    public function testWrongCondition() : void 
    {
        $this->expectException(\Exception::class);
        $ic = new ItemCondition('XXX');
    }

}
