# Amazon MWS PHP Library

## Installation
```composer require maxs94/amazon-mws```

## Basic usage
```php
 use Maxs94\AmazonMws\Client\AmazonClient;
 use Maxs94\AmazonMws\Actions\Orders\GetOrdersServiceStatus;

 $amazonClient = new AmazonClient(
     YOUR_AWS_ACCES_KEY_ID,
     YOUR_AWS_SECRET_ACCESS_KEY,
     YOUR_MWS_AUTH_TOKEN,
     YOUR_MERCHANT_ID
 );


 // set the Amazon action you want to use
 $amazonClient->setAction(
     new GetOrdersServiceStatus()
 );

 // get the result from Amazon
 $result = $amazonClient->submitFeed();

 // show result from Amazon
 print_r($result);
 ```

## Usage in a Symfony project
###config/services.yaml
```yaml
 parameters:
   amazon.AWS_ACCESS_KEY_ID: 'your access key'
   amazon.AWS_SECRET_ACCESS_KEY: 'your secret here'
   amazon.MERCHANT_ID: 'your merchant id'
   amazon.MWS_AUTH_TOKEN: 'amzn.mws.yourtoken'

 services:
   Maxs94\AmazonMws\Client\AmazonClient:
     class: Maxs94\AmazonMws\Client\AmazonClient
     arguments:
        $AWS_ACCESS_KEY_ID: '%amazon.AWS_ACCESS_KEY_ID%'
        $AWS_SECRET_ACCESS_KEY: '%amazon.AWS_SECRET_ACCESS_KEY%'
        $MWS_AUTH_TOKEN: '%amazon.MWS_AUTH_TOKEN%'
        $MERCHANT_ID: '%amazon.MERCHANT_ID%'
```

### in your Command, Controller, ...
```php
  
  use Maxs94\AmazonMws\Client\AmazonClient;
  use Maxs94\AmazonMws\Actions\Orders\GetOrdersServiceStatus;

  class amazonTestcommand extends Command 
  {

      /** @var AmazonClient */
      private $amazonClient;

      public function __construct(AmazonClient $amazonClient)
      {
          $this->amazonClient = $amazonClient;
          parent::__construct();
      }

      protected function configure()
      {
          $this->setName('amazon:test')
            ->setDescription('tests amazon');
      }

      protected function execute(InputInterface $input, OutputInterface $output)
      {

            // set the Amazon action you want to use
            $this->amazonClient->setAction(
                new GetOrdersServiceStatus()
            );

            // get the result from Amazon
            $result = $this->amazonClient->submitFeed();

            // show result from Amazon
            dd($result);
      }

  }
```

# Examples
## List orders
```php
$action = New ListOrders();
$action->addParameter(new MarketplaceList([
    new Marketplace('DE'),
    new Marketplace('BR')
]));
$action->addParameter(
    new CreatedAfter(new \DateTime()))
);
$results = $amazonClient->setAction($action)->submitFeed();
foreach ($results->ListOrdersResult->Orders as $order) {
    //do something with them
    print_r($order);
}
``` 

## ListMatchingProducts
```php 
$action = new ListMatchingProducts();
$action->addParameter(new Marketplace('DE'));
$action->addParameter(new Query('Harry Potter DVD'));
$results = $amazonClient->setAction($action)->submitFeed();
```

## GetMatchingProductForId 
```php
$action = new GetMatchingForProductId();
$action->addParameter(new Marketplace('DE'));
$action->addParameter(new IdType('ISBN'));
$action->addParameter(new IdList(['9781933988665', '0439708184']));
$results = $amazonClient->setAction($action)->submitFeed();
``` 

## GetMyFeesEstimate
```php 
$action = new GetMyFeesEstimate();
$feesEstimateRequest = new FeesEstimateRequest(
            new Marketplace('DE'), 
            new IdType('ASIN'), 
            'B002KT3XQM', 
            new PriceToEstimateFees( 
                new MoneyType(30.00, 'EUR' ), 
                new MoneyType(3.99, 'EUR'), 
                null),
            'IDENTIFIER1',
            false);

$action->addParameter(new FeesEstimateRequestList([$feesEstimateRequest]));

$results = $amazonClient->setAction($action)->submitFeed();
```

## GetOrder 
```php 
$action = new GetOrder();
$action->addParameter( new AmazonOrderId(['123-1234567-1234567']));
$results = $amazonClient->setAction($action)->submitFeed();
```

## SubmitFeed - add products 
```php 
$action = new SubmitFeed();
$action->addParameter(new FeedType( FeedType::PRODUCT ));
$action->addParameter(new MarketplaceList([new Marketplace('DE')]));

$products[] = [
    'SKU' => 56789,
    'StandardProductID' => (new StandardProductID(new IdType('ASIN'), 'B0EXAMPLEG'))->getArray(),
    'ProductTaxCode' => 'A_GEN_NOTAX',
    'IsHeatSensitive' => 'false',
    'ItemForm' => 'example-item-form',
    'DescriptionData' => [
        'Title' => 'Example Product Title',
        'Brand' => 'Example Product Brand',
        'Description' => 'This is an example product description.',
        'BulletPoint' => [
            'Example Bullet Point 1',
            'Example Bullet Point 2',
        ],
        'MSRP' => (new MoneyType(25.19, 'EUR'))->getArray(),
        'Manufacturer' => 'Example Product Manufacturer',
        'ItemType' => 'example-item-type',
    ],
    'ProductData' => [
        'Health' => [
            'ProductType' => [
                'HealthMisc' => [
                    'Ingredients' => 'Example Ingredients',
                    'Directions' => 'Example Directions',
                ],
            ],
        ],
    ],
];

$action->addData($products);
$results = $amazonClient->setAction($action)->submitFeed();
``` 

## GetFeedSubmissionList - get all submitted product feeds status from Amazon
```php 
$action = new GetFeedSubmissionList();  // this optionally takes an array of feedSubmissionIds
$results = $amazonClient->setAction($action)->submitFeed();

// iterate through your submitted feeds
foreach ($results->GetFeedSubmissionListResult->FeedSubmissionInfo as $result) {

    if ($result->FeedProcessingStatus == '_DONE_') {
        // submit GetFeedSubmissionResult
        $action = new GetFeedSubmissionResult($result->FeedSubmissionId->__toString());
        $results = $this->amazon->setAction($action)->submitFeed();
        print_r($results);
    }

}
```




# Available actions
  Refer to `src/Actions` to see which actions are currently implemented.


# PHPUnit Tests
You can test the package using the provided `tests.sh` script in the root. To be able to do so, run `composer install` first in the package directory.

# Collaboration, Help
Feel free to fork this repo and send me pull requests if you want to implement more Amazon Actions, for example.