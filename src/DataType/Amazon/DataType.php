<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Amazon;

abstract class DataType implements DataTypeInterface 
{
    public const NAME = 'Undefined';


    /**
     * return the suffix if defined (lists)
     */
    public function getSuffix() : string 
    {
        return $this->suffix ? $this->suffix : '';
    }

    /**
     * return the value
     *
     * @return void
     */
    public function getValue()
    {
        return $this->value;
    }

}