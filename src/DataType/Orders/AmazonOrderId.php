<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Orders;

use Maxs94\AmazonMws\DataType\Amazon\AmazonStringList;

/**
 * AmazonOrderId
 * https://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_GetOrder.html
 */
class AmazonOrderId extends AmazonStringList
{


    /**
     * maxium values
     *
     * @var integer
     */
    protected $maxValues = 50;

    /**
     * @var array 
     */
    protected $values;

    /**
     * parameter name 
     */
    public const NAME = 'AmazonOrderId';

    /**
     * @var string
     */
    protected $suffix = 'Id';

    public function __construct(array $values) 
    {

        if (count($values) > $this->maxValues) {
           throw new \Exception(sprintf('maximum amount of order ids is %d', $this->maxValues));
        }

        // format of Amazon order id is 3-7-7 format (3 numbers - 7 numbers - 7 numbers)
        foreach ($values as $value) {
            if (!preg_match('/^[0-9]{3}-[0-9]{7}-[0-9]{7}$/', $value)) {
                throw new \Exception(sprintf('AmazonOrderId %s does not match format 3-7-7. Please see Amazon API documentation for the GetOrder endpoint.', $value));
            }
            $this->values[] = $value;
        }

        parent::__construct(self::NAME, $this->suffix, $values);
    }

    public function getName() : string
    {
        return self::NAME;
    }
}