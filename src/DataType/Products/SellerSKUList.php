<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Products;

use Maxs94\AmazonMws\DataType\Amazon\AmazonStringList;

/**
 * A list of Marketplace values
 */
class SellerSKUList extends AmazonStringList
{

    /**
     * Maximum: 20
     */
    protected $maxValues = 20;

    /**
     * parameter name 
     */
    public const NAME = 'SellerSKUList';

    /**
     * list suffix
     */
    protected $suffix = 'SellerSKU';

    /**
     * @var array
     */
    protected $list = [];


    public function __construct(array $list = []) 
    {
        if (count($list) > $this->maxValues) {
            throw new \Exception('Maximum number of values is ' . $this->maxValues);
        }

        $this->list = $list;
 
        parent::__construct(self::NAME, $this->suffix, $list);

    }

    public function getName() : string
    {
        return self::NAME;
    }

}


