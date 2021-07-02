<?php declare(strict_types=1);

use Unirest\Method;
use Unirest\Request;
use Unirest\Response;
use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\Client\AmazonClient;
use Maxs94\AmazonMws\Actions\AmazonAction;
use Maxs94\AmazonMws\DataType\MarketPlace;
use Maxs94\AmazonMws\DataType\AmazonDataType;
use Maxs94\AmazonMws\DataType\Products\Query;
use PHPUnit\Framework\MockObject\MockBuilder;
use Maxs94\AmazonMws\DataType\Products\IdType;
use Maxs94\AmazonMws\DataType\MarketplaceList;
use Maxs94\AmazonMws\DataType\Orders\OrderStatus;
use Maxs94\AmazonMws\DataType\Orders\CreatedAfter;
use Maxs94\AmazonMws\DataType\Orders\LastUpdatedAfter;
use Maxs94\AmazonMws\Parameters\AmazonRequestParameter;
use Maxs94\AmazonMws\Exceptions\MissingActionException;
use Maxs94\AmazonMws\Exceptions\InvalidParameterException;
use Maxs94\AmazonMws\Exceptions\MissingParametersException;
use Maxs94\AmazonMws\Exceptions\MissingServiceUrlException;
use Maxs94\AmazonMws\Exceptions\InvalidParameterTypeException;
use Maxs94\AmazonMws\Exceptions\MissingAllParametersException;
use Maxs94\AmazonMws\Exceptions\WrongServiceUrlSchemeException;
use Maxs94\AmazonMws\Exceptions\OnlyOneParameterAllowedException;

final class AmazonActionTest extends TestCase 
{

    /**
     * @var AmazonClient
     */
    private $amazonClient;

    /**
     * @var TestAction
     */
    private $action;

    /**
     * @var TestActionRequiredOne
     */
    private $actionRequiredOne;

    protected function setUp() : void
    {
        $this->amazonClient = new AmazonClient('key', 'key', 'auth', 'merchant_id');
        $this->action = new TestAction();
        $this->actionRequiredOne = new TestActionRequiredOne();
    }

    public function testMissingServiceURL() : void 
    {
        $this->expectException(MissingServiceUrlException::class);
        $this->amazonClient->setAction($this->action);
        $this->amazonClient->createFeed();
    }

    public function testSetServiceURL() : void 
    {
        $this->amazonClient->setServiceURL('testing.url');
        $this->assertSame('testing.url', $this->amazonClient->getServiceURL());
    }

    public function testWrongServiceUrlScheme() : void 
    {
        $this->expectException(WrongServiceUrlSchemeException::class);
        $this->amazonClient->setServiceURL('file://testing.url');
        $this->amazonClient->setAction($this->action);
        $this->amazonClient->createFeed();
    }

    public function testMissingAction() : void 
    {
        $this->expectException(MissingActionException::class);
        $this->amazonClient->createFeed();
    }

    public function testMissingAllParameters() : void 
    {
        $this->expectException(MissingAllParametersException::class);
        $this->amazonClient->setServiceURL('testing.url');
        $this->amazonClient->setAction($this->action);
        $this->amazonClient->createFeed();
    }

    public function testMissingRequiredParameter() : void 
    {
        $this->amazonClient->setServiceURL('testing.url');
        $this->expectException(MissingParametersException::class);
        $this->action->addParameter( new IdType('ASIN') );
        $this->amazonClient->setAction($this->action);
        $this->amazonClient->createFeed();
    }

    public function testWrongParameter() : void 
    {
        $this->expectException(MissingParametersException::class);
        $this->amazonClient->setServiceURL('testing.url');
        $this->action->addParameter( new Query('WrongParameter') );
        $this->amazonClient->setAction($this->action);
        $this->amazonClient->createFeed(); 
    }

    public function testMissingRequiredRequestParameters() : void 
    {
        $this->amazonClient->setServiceURL('testing.url');
        $this->amazonClient->setAction($this->action);
        $this->action->addParameter( new IdType('ASIN'));
        $this->expectException(MissingParametersException::class);
        $this->amazonClient->createFeed();
    }

    public function testRequireOneOfParameters() : void 
    {
        $this->amazonClient->setServiceURL('testing.url');
        $this->actionRequiredOne->addParameter(new CreatedAfter(new \DateTime()));
        $this->amazonClient->setAction($this->actionRequiredOne);
        $res = $this->amazonClient->createFeed();
        $this->assertIsArray($res);
    }

    public function testRequireOneOfParametersAllProvided() : void 
    {
        $this->expectException(OnlyOneParameterAllowedException::class);
        $this->amazonClient->setServiceURL('testing.url');
        $this->actionRequiredOne->addParameter(new CreatedAfter(new \DateTime()));
        $this->actionRequiredOne->addParameter(new LastUpdatedAfter(new \DateTime()));
        $this->amazonClient->setAction($this->actionRequiredOne);
        $this->amazonClient->createFeed();
    }

    public function testRequireOneOfParametersNoneProvided() : void 
    {
        $this->amazonClient->setServiceURL('testing.url');
        $this->expectException(OnlyOneParameterAllowedException::class);
        $this->amazonClient->setAction($this->actionRequiredOne);
        $this->amazonClient->createFeed();
    }

    public function testSignature() : void 
    {
        $this->action->addParameter(new MarketPlace('DE'));
        $this->amazonClient->setAction($this->action);
        $feed = $this->amazonClient->createFeed();

        $this->assertIsArray($feed);

    }
  
}

class TestAction extends AmazonAction
{
    protected $name = 'TestAction';
    protected $version = '1970-01-01';
    protected $method = Method::POST;
    protected $uri = '/TestAction';
    protected $xmlSchema = '';
    protected $xmlTemplate = '';      // no template needed for this call
    protected $requestParameters; 
    protected $parameters;
    protected $xmlResponseMask = [];

    public function __construct() 
    {
        $this->requestParameters = [
                new AmazonRequestParameter( MarketPlace::NAME, true ),
                new AmazonRequestParameter( IdType::NAME, false )
        ];
    }
}

final class TestActionRequiredOne extends TestAction 
{
    public function __construct() 
    {
        $this->requestParameters = [
            new AmazonRequestParameter( CreatedAfter::NAME, false ),
            new AmazonRequestParameter( LastUpdatedAfter::NAME, false ),
            new AmazonRequestParameter( OrderStatus::NAME, false),
        ];

        $this->requireOneOfParameters = [
            [CreatedAfter::NAME, LastUpdatedAfter::NAME]
        ];
    }


}


