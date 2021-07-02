<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Products;

use Maxs94\AmazonMws\DataType\Amazon\AmazonString;

/**
 * ItemCondition
 */
class ItemCondition extends AmazonString
{

    /**
     * @var string
     */
    protected $value;

    /**
     * parameter name 
     */
    public const NAME = 'ItemCondition';

    // see: https://docs.developer.amazonservices.com/en_US/products/Products_GetLowestOfferListingsForSKU.html
    protected $validStrings = [
        'Any',
        'New',
        'Used',
        'Collectible',
        'Refurbished',
        'Club',
    ];

    public function __construct(string $value) 
    {

        // check if valid
        if (!in_array($value, $this->validStrings)) {
            throw new \Exception(sprintf('%s is not valid for this parameter, Valid values are: %s', $value, implode(', ', $this->validStrings)));
        }

        $this->value = $value;
        parent::__construct(self::NAME, $value);
    }

    public function getName() : string
    {
        return self::NAME;
    }

}