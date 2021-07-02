<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Orders;

use Maxs94\AmazonMws\DataType\Amazon\AmazonEmail;

/**
 * BuyerEmail
 */
class BuyerEmail extends AmazonEmail
{

    /**
     * @var string
     */
    protected $value;

    /**
     * parameter name 
     */
    public const NAME = 'BuyerEmail';


    public function __construct(string $value) 
    {
        $this->value = $value;
        parent::__construct(self::NAME, $value);
    }

    public function getName() : string
    {
        return self::NAME;
    }
}