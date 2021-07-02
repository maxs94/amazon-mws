<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Orders;

use Maxs94\AmazonMws\DataType\Amazon\AmazonString;

/**
 * SellerOrderId
 * 
 * todo: 
 * If SellerOrderId is specified, then FulfillmentChannel, OrderStatus, PaymentMethod, LastUpdatedAfter, LastUpdatedBefore, and BuyerEmail cannot be specified.
 */
class SellerOrderId extends AmazonString 
{

    /**
     * @var string
     */
    protected $value;

    /**
     * parameter name 
     */
    public const NAME = 'SellerOrderId';


    public function __construct(string $value) 
    {
        $this->value = $value;
        parent::__construct(self::NAME, $value);
    }

    public function getName() : string
    {
        return self::NAME;
    }
}