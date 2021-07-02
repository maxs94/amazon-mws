<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Orders;

use Maxs94\AmazonMws\DataType\Amazon\AmazonStringList;

/**
 * PaymentMethod
 */
class PaymentMethod extends AmazonStringList
{

    /**
     * @var array 
     */
    protected $values;

    /**
     * parameter name 
     */
    public const NAME = 'PaymentMethod';

    /**
     * @var string
     */
    protected $suffix = 'Method';

    // see: https://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_ListOrders.html
    protected $validStrings = [
        'COD',
        'CVS',
        'Other',
    ];

    public function __construct(array $values) 
    {

        // check if valid
        foreach ($values as $value) {
            if (!in_array($value, $this->validStrings)) {
                throw new \Exception(sprintf('%s is not valid for this parameter, Valid values are: %s', $value, implode(', ', $this->validStrings)));
            }
        }

        $this->values = $values;
        parent::__construct(self::NAME, $this->suffix, $values);
    }

    public function getName() : string
    {
        return self::NAME;
    }
}