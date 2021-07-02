#Amazon MWS PHP Library

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
 
## Available actions
  Refer to `src/Actions` to see which Actions are currently implemented.


## PHPUnit Tests
You can test the package using the provided `tests.sh` script in the root. To be able to do so, run `composer install` first in the package directory.

## Collaboration
Feel free to fork this repo and send me pull requests if you want to implement more Amazon Actions, for example.