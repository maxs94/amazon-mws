<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Amazon;

/**
 * Amazon DataType
 * Integer
 */
class AmazonInteger extends DataType implements DataTypeInterface
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
        $this->value = intval($value);
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