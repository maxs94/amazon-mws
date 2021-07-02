<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Products;

class StandardProductID
{

    /**
     * @var IdType
     */
    private $type;

    /**
     * @var string
     */
    private $value;


    /**
     * constructor
     *
     * @param IdType $type
     * @param string $value
     */
    public function __construct(IdType $type, string $value) {
        $this->setType($type);
        $this->setValue($value);
    }

    /**
     * Get the value of type
     *
     * @return  IdType
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param  IdType  $type
     *
     * @return  self
     */ 
    public function setType(IdType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of value
     *
     * @return  string
     */ 
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @param  string  $value
     *
     * @return  self
     */ 
    public function setValue(string $value)
    {
        $this->value = $value;

        return $this;
    }

    public function getArray() : array 
    {
        return [
            'Type' => $this->getType()->getValue(),
            'Value' => $this->getValue(),
        ];
    }
}