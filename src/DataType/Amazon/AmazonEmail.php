<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Amazon;

/**
 * Amazon DataType
 * Email
 */
class AmazonEmail extends DataType implements DataTypeInterface
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

        // check for email address 
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception(sprintf('%s is not a valid email address.', $value));
        }

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
          $this->key => $this->value
      ];
    }

    public function getName() : string
    {
        return $this->key;
    }
}