<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Actions\Orders;

use Unirest\Method;
use Maxs94\AmazonMws\Actions\AmazonAction;
use Maxs94\AmazonMws\DataType\Orders\AmazonOrderId;
use Maxs94\AmazonMws\Parameters\AmazonRequestParameter;

/**
 * ListOrderItems
 * https://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_ListOrderItems.html
 */
class ListOrderItems extends AmazonAction 
{
    protected $name = 'ListOrderItems';
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
            new AmazonRequestParameter( AmazonOrderId::NAME, true ),
        ];

    }
}