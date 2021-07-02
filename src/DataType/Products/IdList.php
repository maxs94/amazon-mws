<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Products;

use Maxs94\AmazonMws\DataType\Amazon\AmazonStringList;

/**
 * A structured list of Id values. Used to identify products in the given Marketplace.
 */
class IdList extends AmazonStringList
{

    /**
     * Maximum: 5
     */
    protected $maxValues = 5;

    /**
     * parameter name 
     */
    public const NAME = 'IdList';

    /**
     * list suffix
     */
    protected $suffix = 'Id';

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



