<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Feeds;

use Maxs94\AmazonMws\DataType\Amazon\AmazonString;

/**
 * FeedSubmissionId
 * String
 */
class FeedSubmissionId extends AmazonString 
{

    /**
     * @var string
     */
    protected $value;

    /**
     * parameter name 
     */
    public const NAME = 'FeedSubmissionId';


    public function __construct(string $value) 
    {
        $this->value = $value;
        parent::__construct(self::NAME, urlencode($value));
    }

    public function getName() : string
    {
        return self::NAME;
    }
}