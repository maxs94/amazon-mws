<?php 

namespace Maxs94\AmazonMws\Actions\Product;

use Unirest\Method;
use Maxs94\AmazonMws\Actions\AmazonAction;
use Maxs94\AmazonMws\DataType\Marketplace;
use Maxs94\AmazonMws\DataType\Products\ItemCondition;
use Maxs94\AmazonMws\DataType\Products\SellerSKUList;
use Maxs94\AmazonMws\Parameters\AmazonRequestParameter;

/**
 * GetLowestOfferListingsForSKU
 * https://docs.developer.amazonservices.com/en_US/products/Products_GetLowestOfferListingsForSKU.html
 */
class GetLowestOfferListingsForSKU extends AmazonAction 
{
    protected $name = 'GetLowestOfferListingsForSKU';
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
            new AmazonRequestParameter( SellerSKUList::NAME, true ),
            new AmazonRequestParameter( ItemCondition::NAME, false )
        ];
        
    }


}