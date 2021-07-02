<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Actions\Feeds;

use Maxs94\AmazonMws\Actions\AmazonFeedAction;
use Maxs94\AmazonMws\DataType\Feeds\FeedProcessingStatusList;
use Maxs94\AmazonMws\DataType\Feeds\FeedSubmissionIdList;
use Maxs94\AmazonMws\DataType\Feeds\FeedTypeList;
use Maxs94\AmazonMws\DataType\Feeds\MaxCount;
use Maxs94\AmazonMws\DataType\Feeds\SubmittedFromDate;
use Maxs94\AmazonMws\DataType\Feeds\SubmittedToDate;
use Maxs94\AmazonMws\Parameters\AmazonRequestParameter;
use Unirest\Method;

/**
 * GetFeedSubmissionList
 * https://docs.developer.amazonservices.com/en_US/feeds/Feeds_GetFeedSubmissionList.html
 */
class GetFeedSubmissionList extends AmazonFeedAction 
{
    protected $name = 'GetFeedSubmissionList';
    protected $version = '2009-01-01';
    protected $method = Method::POST;
    protected $uri = '/Feeds';
    protected $requestParameters;
    protected $parameters = [];
    protected $payloadRequired = false;

    public function __construct(
        array $ids = null,
        int $maxCount = null,
        array $feedTypeList = null,
        array $feedProcessingStatusList = null,
        \DateTime $submittedFromDate = null,
        \DateTime $submittedToDate = null
    ) {
        $this->requestParameters = [
            new AmazonRequestParameter( FeedSubmissionIdList::NAME, false), 
            new AmazonRequestParameter( MaxCount::NAME, false ),
            new AmazonRequestParameter( FeedTypeList::NAME, false ),
            new AmazonRequestParameter( FeedProcessingStatusList::NAME, false ),
            new AmazonRequestParameter( SubmittedFromDate::NAME, false ),
            new AmazonRequestParameter( SubmittedToDate::NAME, false ),
        ];

        if ($ids !== null) {
            $this->addParameter(new FeedSubmissionIdList($ids));
        }

        if ($maxCount !== null) {
            $this->addParameter(new MaxCount($maxCount));
        }

        if ($feedTypeList !== null) {
            $this->addParameter(new FeedTypeList($feedTypeList));
        }

        if ($feedProcessingStatusList !== null) {
            $this->addParameter(new FeedProcessingStatusList($feedProcessingStatusList));
        }

        if ($submittedFromDate !== null) {
            $this->addParameter(new SubmittedFromDate($submittedFromDate));
        }

        if ($submittedToDate !== null) {
            $this->addParameter(new SubmittedToDate($submittedToDate));
        }

    }

}