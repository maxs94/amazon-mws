<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Amazon;

/**
 * Amazon DataType
 * Boolean
 */
class AmazonBoolean extends DataType implements DataTypeInterface
{

    /**
     * @var bool
     */
    protected $value;

    /**
     * @var string
     */
    protected $key;

    public function __construct(string $key, bool $value) 
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
          $this->key => $this->value ? 'true' : 'false'
      ];
    }

    public function getName() : string
    {
        return $this->key;
    }
}