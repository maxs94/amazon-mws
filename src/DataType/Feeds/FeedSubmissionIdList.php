<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Feeds;

use Maxs94\AmazonMws\DataType\Amazon\AmazonStringList;

/**
 * FeedSubmissionIdList
 * A structured list of no more than 100 FeedSubmmissionId values. 
 * If you pass in FeedSubmmissionId values in a request, 
 * other query conditions are ignored.
 */
class FeedSubmissionIdList extends AmazonStringList
{

    /**
     * Maximum: 100
     */
    protected $maxValues = 100;

    /**
     * parameter name 
     */
    public const NAME = 'FeedSubmissionIdList';

    /**
     * list suffix
     */
    protected $suffix = 'Id';

    /**
     * @var array
     */
    protected $list = [];


    public function __construct(array $list = []) 
    {
        if (count($list) > $this->maxValues) {
            throw new \Exception('Maximum number of values is ' . $this->maxValues);
        }

        $this->list = $list;
 
        parent::__construct(self::NAME, $this->suffix, $list);

    }

    public function getName() : string
    {
        return self::NAME;
    }

}


