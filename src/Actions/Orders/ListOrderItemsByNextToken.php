<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Actions\Orders;

use Unirest\Method;
use Maxs94\AmazonMws\Actions\AmazonAction;
use Maxs94\AmazonMws\DataType\Common\NextToken;
use Maxs94\AmazonMws\Parameters\AmazonRequestParameter;

/**
 * ListOrderItemsByNextToken
 * https://docs.developer.amazonservices.com/en_US/feeds/Feeds_GetFeedSubmissionListByNextToken.html
 */
class ListOrderItemsByNextToken extends AmazonAction 
{
    protected $name = 'ListOrderItemsByNextToken';
    protected $version = '2013-09-01';
    protected $method = Method::POST;
    protected $uri = '/Orders';
    protected $xmlSchema = '';
    protected $requestParameters;
    protected $parameters = [];

    public function __construct()
    {
        $this->requestParameters = [
            new AmazonRequestParameter( NextToken::NAME, true ),
        ];

    }
}