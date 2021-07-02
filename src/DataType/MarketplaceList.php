<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType;

use Maxs94\AmazonMws\DataType\Amazon\AmazonStringList;

/**
 * A list of Marketplace values
 */
class MarketplaceList extends AmazonStringList
{

    /**
     * Maximum: 50
     */
    protected $maxValues = 50;

    /**
     * parameter name 
     */
    public const NAME = 'MarketplaceId';

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

        foreach ($list as $v) {
            if (!is_object($v) || get_class($v) !== Marketplace::class) {
                throw new \Exception(sprintf('Object must be of type %s, you have provided %s', Marketplace::class, print_r($v,true)));
            }
            $this->list[] = $v;
        }

 
        parent::__construct(self::NAME, $this->suffix, $list);

    }

    public function getName() : string
    {
        return self::NAME;
    }
    
    /**
     * return the key/value pairs
     * different from parent AmazonStringList as Marketplace is an object
     *
     * @return array
     */
    public function getKeyValuePair() : array 
    {   
        $arr = [];
        for ($i=0; $i<count($this->values); $i++) {
            $num = $i + 1;
            $key = sprintf('%s.%s.%d', $this->key, $this->suffix, $num);
            $arr[$key] = $this->values[$i]->getValue();
        }

        return $arr;
    }


}


