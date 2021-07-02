<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Feeds;

use Maxs94\AmazonMws\DataType\Amazon\AmazonBoolean;

/**
 * PurgeAndReplace
 * A Boolean value that enables the purge and replace functionality. 
 * Set to true to purge and replace the existing data; otherwise false. 
 * This value only applies to product-related flat file feed types, 
 * which do not have a mechanism for specifying purge and replace in the feed body. 
 * Use this parameter only in exceptional cases. 
 * Usage is throttled to allow only one purge and replace within a 24-hour period.
 */
class PurgeAndReplace extends AmazonBoolean
{

    /**
     * @var bool
     */
    protected $value;

    /**
     * parameter name 
     */
    public const NAME = 'PurgeAndReplace';


    public function __construct(bool $value) 
    {
        $this->value = $value;
        parent::__construct(self::NAME, $value);
    }

    public function getName() : string
    {
        return self::NAME;
    }
}