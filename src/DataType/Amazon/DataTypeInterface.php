<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Amazon;

interface DataTypeInterface 
{

    /**
     * return the name
     */
    public function getName() : string;

    /**
     * return the suffix
     */
    public function getSuffix() : string;

    /**
     * return the key/value pair 
     */
    public function getKeyValuePair() : array;

    /**
     * return the value 
     */
    public function getValue();


}