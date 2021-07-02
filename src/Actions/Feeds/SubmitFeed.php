<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Actions\Feeds;

use Unirest\Method;
use Maxs94\AmazonMws\DataType\Feeds\FeedType;
use Maxs94\AmazonMws\Actions\AmazonFeedAction;
use Maxs94\AmazonMws\DataType\MarketplaceList;
use Maxs94\AmazonMws\DataType\Orders\AmazonOrderId;
use Maxs94\AmazonMws\DataType\Feeds\PurgeAndReplace;
use Maxs94\AmazonMws\Parameters\AmazonRequestParameter;

/**
 * SubmitFeed
 * https://docs.developer.amazonservices.com/en_US/feeds/Feeds_SubmitFeed.html
 */
class SubmitFeed extends AmazonFeedAction 
{
    protected $name = 'SubmitFeed';
    protected $version = '2009-01-01';
    protected $method = Method::POST;
    protected $uri = '/Feeds';
    protected $requestParameters;
    protected $parameters;
    protected $payloadRequired = true;      // this action requires a HTTP-BODY payload (usually XML content)

    public function __construct()
    {
        $this->requestParameters = [
            new AmazonRequestParameter( FeedType::NAME, true ),
            new AmazonRequestParameter( MarketplaceList::NAME, false ),
            new AmazonRequestParameter( PurgeAndReplace::NAME, false ),
            new AmazonRequestParameter( AmazonOrderId::NAME, false ),
        ];

    }
}