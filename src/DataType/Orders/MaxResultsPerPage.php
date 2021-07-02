<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Orders;

use Maxs94\AmazonMws\DataType\Amazon\AmazonInteger;

/**
 * MaxResultsPerPage
 */
class MaxResultsPerPage extends AmazonInteger
{

    /**
     * @var int
     */
    protected $value;

    /**
     * parameter name 
     */
    public const NAME = 'MaxResultsPerPage';


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