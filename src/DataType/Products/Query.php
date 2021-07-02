<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Products;

use Maxs94\AmazonMws\DataType\Amazon\AmazonString;

/**
 * Query
 * String
 */
class Query extends AmazonString 
{

    /**
     * @var string
     */
    protected $value;

    /**
     * parameter name 
     */
    public const NAME = 'Query';


    public function __construct(string $value) 
    {
        $this->value = $value;
        parent::__construct(self::NAME, urlencode($value));
    }

    public function getName() : string
    {
        return self::NAME;
    }
}