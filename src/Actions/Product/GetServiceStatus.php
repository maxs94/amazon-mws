<?php 

namespace Maxs94\AmazonMws\Actions\Product;

use Unirest\Method;
use Maxs94\AmazonMws\Actions\AmazonAction;

/**
 * GetProductsServiceStatus
 * https://docs.developer.amazonservices.com/en_US/products/Products_GetServiceStatus.html
 */
class GetProductsServiceStatus extends AmazonAction 
{
    protected $name = 'GetServiceStatus';
    protected $version = '2011-10-01';
    protected $method = Method::POST;
    protected $uri = '/Products';
    protected $xmlSchema = '';
    protected $xmlTemplate = '';      // no template needed for this call
    protected $requestParameters; 
    protected $parameters;
    protected $xmlResponseMask = [];

    public function __construct()
    {
        
    }

}