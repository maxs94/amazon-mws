<?php 

namespace Maxs94\AmazonMws\Actions\Product;

use Maxs94\AmazonMws\Actions\AmazonAction;
use Maxs94\AmazonMws\DataType\Marketplace;
use Maxs94\AmazonMws\DataType\Products\IdList;
use Maxs94\AmazonMws\DataType\Products\IdType;
use Maxs94\AmazonMws\Parameters\AmazonRequestParameter;
use Unirest\Method;

/**
 * GetMatchingProductForId 
 * https://docs.developer.amazonservices.com/en_US/products/Products_GetMatchingProductForId.html
 */
class GetMatchingProductForId extends AmazonAction 
{
    protected $name = 'GetMatchingProductForId';
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
            new AmazonRequestParameter( Marketplace::NAME, true ),
            new AmazonRequestParameter( IdType::NAME, true ),
            new AmazonRequestParameter( IdList::NAME, true )
        ];
        
    }


}