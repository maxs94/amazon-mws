<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Products;

use Maxs94\AmazonMws\DataType\Amazon\DataType;

class Points extends DataType
{

    public const NAME = 'Points';

    /**
     * @var int
     */
    protected $pointsNumber;

    /**
     * @var MoneyType 
     */
    protected $pointsMonetaryValue;

    /**
     * constructor
     *
     * @param int $pointsNumber
     * @param MoneyType $pointsMonetaryValue
     */
    public function __construct(
        int $pointsNumber,
        MoneyType $pointsMonetaryValue
    ) {
        $this->pointsNumber = $pointsNumber;
        $this->pointsMonetaryValue = $pointsMonetaryValue;
    }

    /**
     * Get the value of pointsNumber
     *
     * @return  int
     */ 
    public function getPointsNumber()
    {
        return $this->pointsNumber;
    }


    /**
     * Get the value of pointsMonetaryValue
     *
     * @return  MoneyType
     */ 
    public function getPointsMonetaryValue()
    {
        return $this->pointsMonetaryValue;
    }

    public function getName() : string 
    {
        return self::NAME;
    }

    public function getKeyValuePair(): array
    {
        return [];
    }
}