<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Feeds;

use Maxs94\AmazonMws\DataType\Amazon\AmazonStringList;

/**
 * FeedProcessingStatusList
 * A structured list of one or more feed processing statuses by which to filter the list of feed submissions.
 */
class FeedProcessingStatusList extends AmazonStringList
{

    /**
     * @var array 
     */
    protected $values;

    /**
     * parameter name 
     */
    public const NAME = 'FeedProcessingStatusList';

    /**
     * @var string
     */
    protected $suffix = 'Status';

    // see: https://docs.developer.amazonservices.com/en_US/feeds/Feeds_FeedProcessingStatus.html
    protected $validStrings = [
        '_AWAITING_ASYNCHRONOUS_REPLY_',
        '_CANCELLED_',
        '_DONE_',
        '_IN_PROGRESS_',
        '_IN_SAFETY_NET_',
        '_SUBMITTED_',
        '_UNCONFIRMED_',
    ];

    public function __construct(array $values) 
    {

        // check if valid
        foreach ($values as $value) {
            if (!in_array($value, $this->validStrings)) {
                throw new \Exception(sprintf('%s is not valid for this parameter, Valid values are: %s', $value, implode(', ', $this->validStrings)));
            }
        }

        $this->values = $values;
        parent::__construct(self::NAME, $this->suffix, $values);
    }

    public function getName() : string
    {
        return self::NAME;
    }
}