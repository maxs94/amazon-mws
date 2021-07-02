<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Amazon;

/**
 * Amazon DataType
 * NonNegativeInteger
 */
class AmazonNonNegativeInteger extends DataType implements DataTypeInterface
{

    /**
     * @var int
     */
    protected $value;

    /**
     * @var string
     */
    protected $key;

    public function __construct(string $key, int $value) 
    {
        $this->key = $key;
        $this->value = intval($value) >= 0 ? intval($value) : 0;
    }

    /**
     * return the key/value pairs
     *
     * @return array
     */
    public function getKeyValuePair() : array 
    {   
      return [
          $this->key => $this->value
      ];
    }

    public function getName() : string
    {
        return $this->key;
    }
}