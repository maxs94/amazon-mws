<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Products;

use Maxs94\AmazonMws\DataType\Amazon\AmazonString;

/**
 * IdType
 */
class IdType extends AmazonString
{

    /**
     * @var string
     */
    protected $value;

    /**
     * parameter name 
     */
    public const NAME = 'IdType';

    // see: https://docs.developer.amazonservices.com/en_US/products/Products_GetMatchingProductForId.html
    protected $validStrings = [
        'ASIN',
        'GCID',
        'SellerSKU',
        'UPC',
        'EAN',
        'ISBN',
        'JAN'
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