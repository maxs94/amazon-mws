<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Actions\Feeds;

use Unirest\Method;
use Maxs94\AmazonMws\Actions\AmazonAction;
use Maxs94\AmazonMws\DataType\Common\NextToken;
use Maxs94\AmazonMws\Parameters\AmazonRequestParameter;

/**
 * GetFeedSubmissionListByNextToken
 * https://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_GetFeedSubmissionListByNextToken.html
 */
class GetFeedSubmissionListByNextToken extends AmazonAction 
{
    protected $name = 'GetFeedSubmissionListByNextToken';
    protected $version = '2013-09-01';
    protected $method = Method::POST;
    protected $uri = '/Feeds';
    protected $xmlSchema = '';
    protected $requestParameters;
    protected $parameters = [];
    protected $payloadRequired = false;      

    public function __construct()
    {
        
        $this->requestParameters = [
            new AmazonRequestParameter( NextToken::NAME, true ),
        ];

    }
}