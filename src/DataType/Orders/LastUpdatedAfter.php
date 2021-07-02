<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Orders;

use Maxs94\AmazonMws\DataType\Amazon\AmazonDateTime;

/**
 * LastUpdatedAfter
 */
class LastUpdatedAfter extends AmazonDateTime
{

    /**
     * @var \DateTime
     */
    protected $value;

    /**
     * parameter name 
     */
    public const NAME = 'LastUpdatedAfter';


    public function __construct(\DateTime $value) 
    {
        $this->value = $value;
        parent::__construct(self::NAME, $value);
    }

    public function getName() : string
    {
        return self::NAME;
    }
}