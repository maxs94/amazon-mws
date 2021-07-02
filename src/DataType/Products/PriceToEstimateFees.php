<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Products;

use Maxs94\AmazonMws\DataType\Amazon\DataType;

class PriceToEstimateFees extends DataType
{

    public const NAME = 'PriceToEstimateFees';

    /**
     * @var MoneyType
     */
    protected $listingPrice;

    /**
     * @var MoneyType
     */
    protected $shipping;

    /**
     * @var Points
     */
    protected $points;

    /**
     * constructor
     *
     * @param MoneyType $listingPrice
     * @param MoneyType $shipping
     * @param Points $points
     */
    public function __construct(
        MoneyType $listingPrice,
        MoneyType $shipping = null,
        Points $points = null
    ) {
        $this->listingPrice = $listingPrice;
        $this->shipping = $shipping;
        $this->points = $points;
    }



    /**
     * Get the value of listingPrice
     *
     * @return  MoneyType
     */ 
    public function getListingPrice()
    {
        return $this->listingPrice;
    }


    /**
     * Get the value of shipping
     *
     * @return  MoneyType
     */ 
    public function getShipping()
    {
        return $this->shipping;
    }


    /**
     * Get the value of points
     *
     * @return  Points
     */ 
    public function getPoints()
    {
        return $this->points;
    }


    public function getKeyValuePair() : array 
    {
        
        if ($this->getListingPrice()) $arr[$this->getName() . '.ListingPrice.CurrencyCode'] = $this->getListingPrice()->getCurrencyCode();
        if ($this->getListingPrice()) $arr[$this->getName() . '.ListingPrice.Amount'] = $this->getListingPrice()->getAmount();
        if ($this->getShipping()) $arr[$this->getName() . '.Shipping.CurrencyCode'] = $this->getShipping()->getCurrencyCode();
        if ($this->getShipping()) $arr[$this->getName() . '.Shipping.Amount'] = $this->getShipping()->getAmount();
        if ($this->getPoints()) $arr[$this->getName() . '.Points.PointNumber'] = $this->getPoints()->getPointsNumber();

        return $arr;
    }

    public function getName() : string 
    {
        return self::NAME;
    }

}