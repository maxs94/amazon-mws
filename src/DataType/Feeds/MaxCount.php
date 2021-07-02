<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Feeds;

use Maxs94\AmazonMws\DataType\Amazon\AmazonInteger;
use Maxs94\AmazonMws\DataType\Amazon\AmazonNonNegativeInteger;

/**
 * MaxCount
 * A non-negative integer that indicates the maximum number of feed submissions to return in the list. 
 * If you specify a number greater than 100, the request is rejected.
 */
class MaxCount extends AmazonNonNegativeInteger
{

    /**
     * @var int
     */
    protected $value;

    /**
     * parameter name 
     */
    public const NAME = 'MaxCount';


    public function __construct(int $value) 
    {

        if ($value > 0 && $value <= 100) {

            $this->value = intval($value);
            parent::__construct(self::NAME, $value);
        
        } else {
            throw new \Exception('Number must be in range 1-100');
        }
    }

    public function getName() : string
    {
        return self::NAME;
    }
}