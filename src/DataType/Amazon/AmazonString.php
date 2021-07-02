<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Amazon;

/**
 * Amazon DataType
 * String
 */
class AmazonString extends DataType implements DataTypeInterface
{

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $key;

    public function __construct(string $key, string $value) 
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * return the key/value pairs
     *
     * @return array
     */
    public function getKeyValuePair() : array 
    {   
      return [
          $this->key => urlencode($this->value)
      ];
    }

    public function getName() : string
    {
        return $this->key;
    }

    public function getValue() : string 
    {
        return $this->value;
    }
}