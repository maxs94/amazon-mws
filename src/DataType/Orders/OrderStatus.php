<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Orders;

use Maxs94\AmazonMws\DataType\Amazon\AmazonStringList;

/**
 * OrderStatus
 */
class OrderStatus extends AmazonStringList
{

    /**
     * @var array 
     */
    protected $values;

    /**
     * parameter name 
     */
    public const NAME = 'OrderStatus';

    /**
     * @var string
     */
    protected $suffix = 'Status';

    // see: https://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_ListOrders.html
    protected $validStrings = [
        'PendingAvailability',
        'Pending',
        'Unshipped',
        'PartiallyShipped',
        'Shipped',
        'Canceled',
        'Unfulfillable'
    ];

    public function __construct(array $values) 
    {

        // check if valid
        foreach ($values as $value) {
            if (!in_array($value, $this->validStrings)) {
                throw new \Exception(sprintf('%s is not valid for this parameter, Valid values are: %s', $value, implode(', ', $this->validStrings)));
            }
        }

        // Unshipped and PartiallyShipped must be used together. Using one and not the other returns an error 
        if ((in_array('Unshipped', $values) && !in_array('PartiallyShipped', $values)) || 
            (in_array('PartiallyShipped', $values) && !in_array('Unshipped', $values))) {
                throw new \Exception('Unshipped and PartiallyShipped must be used together.');
        }

        $this->values = $values;
        parent::__construct(self::NAME, $this->suffix, $values);
    }

    public function getName() : string
    {
        return self::NAME;
    }
}