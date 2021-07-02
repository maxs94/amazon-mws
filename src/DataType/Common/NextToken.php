<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Common;

use Maxs94\AmazonMws\DataType\Amazon\AmazonString;

/**
 * NextToken
 */
class NextToken extends AmazonString 
{

    /**
     * @var string
     */
    protected $value;

    /**
     * parameter name 
     */
    public const NAME = 'NextToken';


    public function __construct(string $value) 
    {
        $this->value = $value;
        parent::__construct(self::NAME, $value);
    }

    public function getName() : string
    {
        return self::NAME;
    }
}