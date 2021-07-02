<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Actions\Feeds;

use Maxs94\AmazonMws\Actions\AmazonAction;
use Maxs94\AmazonMws\DataType\Feeds\FeedSubmissionId;
use Maxs94\AmazonMws\Parameters\AmazonRequestParameter;
use Unirest\Method;

/**
 * GetFeedSubmissionResult
 * https://docs.developer.amazonservices.com/en_US/feeds/Feeds_GetFeedSubmissionResult.html
 */
class GetFeedSubmissionResult extends AmazonAction 
{
    protected $name = 'GetFeedSubmissionResult';
    protected $version = '2009-01-01';
    protected $method = Method::POST;
    protected $uri = '/Feeds';
    protected $xmlSchema = '';
    protected $requestParameters;
    protected $parameters;
    protected $checkAmazonResponseString = false;       // needed, as the xml report does not return a "GetFeedSubmissionResultResponse" object

    public function __construct(string $feedSubmissionId='')
    {
        $this->requestParameters = [
            new AmazonRequestParameter( FeedSubmissionId::NAME, true ),
        ];

        if ($feedSubmissionId) {
            $this->addParameter(new FeedSubmissionId($feedSubmissionId));
        }

    }
}