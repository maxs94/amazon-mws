<?php 

namespace Maxs94\AmazonMws\Actions\Product;

use Unirest\Method;
use Maxs94\AmazonMws\Actions\AmazonAction;
use Maxs94\AmazonMws\DataType\Marketplace;
use Maxs94\AmazonMws\DataType\AmazonDataType;
use Maxs94\AmazonMws\DataType\Products\AsinList;
use Maxs94\AmazonMws\DataType\Products\ItemCondition;
use Maxs94\AmazonMws\Parameters\AmazonRequestParameter;

/**
 * GetLowestOfferListingsForASIN
 * https://docs.developer.amazonservices.com/en_US/products/Products_GetLowestOfferListingsForASIN.html
 */
class GetLowestOfferListingsForASIN extends AmazonAction 
{
    protected $name = 'GetLowestOfferListingsForASIN';
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
            new AmazonRequestParameter( AsinList::NAME, true ),
            new AmazonRequestParameter( ItemCondition::NAME, false )
        ];
        
    }


}