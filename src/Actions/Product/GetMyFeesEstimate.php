<?php 

namespace Maxs94\AmazonMws\Actions\Product;

use Maxs94\AmazonMws\Actions\AmazonAction;
use Maxs94\AmazonMws\DataType\Products\FeesEstimateRequestList;
use Maxs94\AmazonMws\Parameters\AmazonRequestParameter;
use Unirest\Method;

/**
 * GetMyFeesEstimate
 * https://docs.developer.amazonservices.com/en_US/products/Products_GetMyFeesEstimate.html
 */
class GetMyFeesEstimate extends AmazonAction 
{
    protected $name = 'GetMyFeesEstimate';
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
        $this->requestParameters = [
            new AmazonRequestParameter( FeesEstimateRequestList::NAME, true )
        ];

    }


}