<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Products;

use Maxs94\AmazonMws\DataType\Amazon\AmazonStringList;

/**
 * A list of ASIN values
 */
class AsinList extends AmazonStringList
{

    /**
     * Maximum: 10
     */
    protected $maxValues = 10;

    /**
     * parameter name 
     */
    public const NAME = 'ASINList';

    /**
     * list suffix
     */
    protected $suffix = 'ASIN';

    /**
     * @var array
     */
    protected $list = [];


    public function __construct(array $list = []) 
    {
        if (count($list) > $this->maxValues) {
            throw new \Exception('Maximum number of ASINs is ' . $this->maxValues);
        }

        $this->list = $list;

        parent::__construct(self::NAME, $this->suffix, $list);
    
    }

    public function getName() : string
    {
        return self::NAME;
    }

}

