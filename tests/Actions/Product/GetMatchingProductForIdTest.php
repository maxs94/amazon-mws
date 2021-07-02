<?php declare(strict_types=1);

use Unirest\Response;
use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\Xml\AmazonXmlParser;
use Maxs94\AmazonMws\DataType\MarketPlace;
use Maxs94\AmazonMws\DataType\Products\IdList;
use Maxs94\AmazonMws\DataType\Products\IdType;
use Maxs94\AmazonMws\DataType\Products\AsinList;
use Maxs94\AmazonMws\Actions\Product\GetMatchingProductForId;
use Maxs94\AmazonMws\Exceptions\InvalidAmazonResponseException;

final class GetMatchingProductForIdTest extends TestCase 
{

    private $amazonXmlParser;
    private $xmlResponse;
    private $action;

    protected function setUp() : void
    {
        
        $this->amazonXmlParser = new AmazonXmlParser();

        // load the response from the xml mock
        $this->xmlResponse = new Response(200, file_get_contents('tests/Mocks/Xml/AmazonResponses/Products/GetMatchingProductForIdResponse.xml'), 'Content-Type: text/xml');

        $this->action = new GetMatchingProductForId();
        $this->action->addParameter( new MarketPlace('DE'));
        $this->action->addParameter( new IdType('ISBN'));
        $this->action->addParameter( new IdList(['9781933988665', '0439708184']));

    }

    public function testParseXmlReturnElement() : void 
    {
        $res = $this->amazonXmlParser->parseXml($this->xmlResponse->raw_body, $this->action);
        $this->assertInstanceOf(SimpleXMLElement::class, $res);
    }

    public function testParseXmlReturnWrongResponse() : void 
    {
        $this->expectException(InvalidAmazonResponseException::class);
        $res = $this->amazonXmlParser->parseXml('<wrongxml/>', $this->action);
    }



}
