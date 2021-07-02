<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Amazon;

/**
 * Amazon DataType
 * String List
 */
class AmazonStringList extends DataType implements DataTypeInterface
{

    /**
     * @var array
     */
    protected $values;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $suffix;

    public function __construct(string $key, string $suffix, array $values) 
    {
        $this->key = $key;
        $this->values = $values;
        $this->suffix = $suffix;
    }

    /**
     * return the key/value pairs
     *
     * @return array
     */
    public function getKeyValuePair() : array 
    {   
        $arr = [];
        for ($i=0; $i<count($this->values); $i++) {
            $num = $i + 1;
            $key = sprintf('%s.%s.%d', $this->key, $this->suffix, $num);
            $arr[$key] = $this->values[$i];
        }
        return $arr;
    }

    public function getName() : string
    {
        return $this->key;
    }
}