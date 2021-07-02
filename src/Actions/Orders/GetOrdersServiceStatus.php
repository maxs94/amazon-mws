<?php 

namespace Maxs94\AmazonMws\Actions\Orders;

use Unirest\Method;
use Maxs94\AmazonMws\Actions\AmazonAction;

/**
 * GetOrdersServiceStatus
 * https://docs.developer.amazonservices.com/en_US/orders-2013-09-01/MWS_GetServiceStatus.html
 */
class GetOrdersServiceStatus extends AmazonAction 
{
    protected $name = 'GetServiceStatus';
    protected $version = '2013-09-01';
    protected $method = Method::POST;
    protected $uri = '/Orders';
    protected $xmlSchema = '';
    protected $xmlTemplate = '';      // no template needed for this call
    protected $requestParameters; 
    protected $parameters;
    protected $xmlResponseMask = [];

    public function __construct()
    {
        
    }

}