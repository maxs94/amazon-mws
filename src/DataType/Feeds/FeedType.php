<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Feeds;

use Maxs94\AmazonMws\DataType\Amazon\AmazonString;

/**
 * FeedType
 */
class FeedType extends AmazonString
{

    /**
     * @var array 
     */
    protected $values;

    /**
     * parameter name 
     */
    public const NAME = 'FeedType';

    /**
     * Feed types
     */
    public const PRODUCT = '_POST_PRODUCT_DATA_';
    public const INVENTORY = '_POST_INVENTORY_AVAILABILITY_DATA_';
    public const OVERRIDE = '_POST_PRODUCT_OVERRIDES_DATA_';
    public const PRICING = '_POST_PRODUCT_PRICING_DATA_';
    public const PRODUCT_IMAGES = '_POST_PRODUCT_IMAGE_DATA_';
    public const RELATIONSHIP = '_POST_PRODUCT_RELATIONSHIP_DATA_';

    // see: https://docs.developer.amazonservices.com/en_US/feeds/Feeds_FeedType.html
    protected $xmlElements = [

        self::PRODUCT => 'Product',
        self::INVENTORY => 'Inventory',
        self::OVERRIDE => 'Override',
        self::PRICING => 'Price',
        self::PRODUCT_IMAGES => 'ProductImage',
        self::RELATIONSHIP => 'Relationship',
        
        // todo:  more to come

    ];

    public function __construct(string $value) 
    {

        // check if valid
        if (!array_key_exists($value, $this->xmlElements)) {
            throw new \Exception(sprintf('%s is not valid for this parameter, Valid values are: %s', $value, implode(', ', array_keys($this->xmlElements))));
        }

        $this->value = $value;
        parent::__construct(self::NAME, $value);
    }

    /**
     * return the Element name
     */
    public function getElementName() : string
    {
        return $this->xmlElements[$this->value];
    }

    public function getName() : string
    {
        return self::NAME;
    }
}