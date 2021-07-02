<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Actions\Feeds;

use Maxs94\AmazonMws\Actions\AmazonAction;
use Maxs94\AmazonMws\DataType\Feeds\FeedSubmissionId;
use Maxs94\AmazonMws\DataType\Feeds\FeedSubmissionIdList;
use Maxs94\AmazonMws\DataType\Feeds\FeedType;
use Maxs94\AmazonMws\DataType\Feeds\FeedTypeList;
use Maxs94\AmazonMws\DataType\Feeds\SubmittedFromDate;
use Maxs94\AmazonMws\DataType\Feeds\SubmittedToDate;
use Maxs94\AmazonMws\Parameters\AmazonRequestParameter;
use Unirest\Method;

/**
 * CancelFeedSubmissions
 * https://docs.developer.amazonservices.com/en_US/feeds/Feeds_CancelFeedSubmissions.html
 */
class CancelFeedSubmissions extends AmazonAction 
{
    protected $name = 'CancelFeedSubmissions';
    protected $version = '2009-01-01';
    protected $method = Method::POST;
    protected $uri = '/Feeds';
    protected $xmlSchema = '';
    protected $requestParameters;
    protected $parameters = [];

    public function __construct(
        array $ids = null,
        array $feedTypeList = null,
        \DateTime $submittedFromDate = null,
        \DateTime $submittedToDate = null
    ) {

        $this->requestParameters = [
            new AmazonRequestParameter( FeedSubmissionIdList::NAME, false ), 
            new AmazonRequestParameter( FeedTypeList::NAME, false ),
            new AmazonRequestParameter( SubmittedFromDate::NAME, false ),
            new AmazonRequestParameter( SubmittedToDate::NAME, false )
        ];

        if ($ids !== null) {
            $this->addParameter(new FeedSubmissionIdList($ids));
        }

        if ($feedTypeList !== null) {
            $this->addParameter(new FeedTypeList($feedTypeList));
        }

        if ($submittedFromDate !== null) {
            $this->addParameter(new SubmittedFromDate($submittedFromDate));
        }

        if ($submittedToDate !== null) {
            $this->addParameter(new SubmittedToDate($submittedToDate));
        }

    }
}