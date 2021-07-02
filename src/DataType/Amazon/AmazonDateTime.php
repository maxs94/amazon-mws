<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Amazon;

/**
 * Amazon DataType
 * DateTime
 */
class AmazonDateTime extends DataType implements DataTypeInterface
{

    /**
     * @var \DateTime
     */
    protected $value;

    /**
     * @var string
     */
    protected $key;

    public function __construct(string $key, \DateTime $value) 
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
          $this->key => $this->value->format('Y-m-d\TH:i:s\Z')
      ];
    }

    public function getName() : string
    {
        return $this->key;
    }
}