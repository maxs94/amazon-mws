<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Actions\Orders;

use Unirest\Method;
use Maxs94\AmazonMws\Actions\AmazonAction;
use Maxs94\AmazonMws\DataType\Common\NextToken;
use Maxs94\AmazonMws\Parameters\AmazonRequestParameter;

/**
 * ListOrders
 * https://docs.developer.amazonservices.com/en_UK/orders-2013-09-01/Orders_ListOrders.html
 */
class ListOrdersByNextToken extends AmazonAction 
{
    protected $name = 'ListOrdersByNextToken';
    protected $version = '2013-09-01';
    protected $method = Method::POST;
    protected $uri = '/Orders';
    protected $xmlSchema = '';
    protected $requestParameters;
    protected $parameters;
    protected $xmlResponseMask = [];

    public function __construct()
    {
        
        $this->requestParameters = [
            new AmazonRequestParameter( NextToken::NAME, true ),
        ];

    }
}