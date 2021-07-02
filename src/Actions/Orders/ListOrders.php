<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Actions\Orders;

use Unirest\Method;
use Maxs94\AmazonMws\DataType\Orders\BuyerEmail;
use Maxs94\AmazonMws\Actions\AmazonAction;
use Maxs94\AmazonMws\DataType\Orders\OrderStatus;
use Maxs94\AmazonMws\DataType\Orders\CreatedAfter;
use Maxs94\AmazonMws\DataType\Orders\CreatedBefore;
use Maxs94\AmazonMws\DataType\Orders\PaymentMethod;
use Maxs94\AmazonMws\DataType\Orders\LastUpdatedAfter;
use Maxs94\AmazonMws\DataType\Orders\LastUpdatedBefore;
use Maxs94\AmazonMws\DataType\MarketplaceList;
use Maxs94\AmazonMws\DataType\Orders\MaxResultsPerPage;
use Maxs94\AmazonMws\DataType\Orders\FulfillmentChannel;
use Maxs94\AmazonMws\DataType\Orders\EasyShipShipmentStatus;
use Maxs94\AmazonMws\Parameters\AmazonRequestParameter;

/**
 * ListOrders
 * https://docs.developer.amazonservices.com/en_UK/orders-2013-09-01/Orders_ListOrders.html
 */
class ListOrders extends AmazonAction 
{
    protected $name = 'ListOrders';
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
            new AmazonRequestParameter( MarketplaceList::NAME, true ),
            new AmazonRequestParameter( CreatedAfter::NAME, false ),
            new AmazonRequestParameter( CreatedBefore::NAME, false ),
            new AmazonRequestParameter( LastUpdatedAfter::NAME, false ),
            new AmazonRequestParameter( LastUpdatedBefore::NAME, false ),
            new AmazonRequestParameter( OrderStatus::NAME, false ),
            new AmazonRequestParameter( FulfillmentChannel::NAME, false ),
            new AmazonRequestParameter( PaymentMethod::NAME, false ),
            new AmazonRequestParameter( BuyerEmail::NAME, false ),
            new AmazonRequestParameter( MaxResultsPerPage::NAME, false ),
            new AmazonRequestParameter( EasyShipShipmentStatus::NAME, false )
        ];

        $this->requireOneOfParameters = [
            [ CreatedAfter::NAME, LastUpdatedAfter::NAME]   
        ];

    }
}