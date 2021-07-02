<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Maxs94\AmazonMws\DataType\MarketPlace;
use Maxs94\AmazonMws\DataType\Products\IdType;
use Maxs94\AmazonMws\DataType\Products\MoneyType;
use Maxs94\AmazonMws\DataType\Products\FeesEstimateRequest;
use Maxs94\AmazonMws\DataType\Products\FeesEstimateRequestList;
use Maxs94\AmazonMws\DataType\Products\PriceToEstimateFees;

final class FeesEstimateRequestListTest extends TestCase 
{

    protected $fer = [];

    protected $tooManyFer = [];

    protected $marketPlaceCountryCode = 'DE';
    protected $idType = 'ASIN';
    protected $idValue = 'IDVALUE1';
    protected $listingAmount = 30.0;
    protected $shippingAmount = 3.99;
    protected $identifier = 'IDENTIFIER1';

    protected function setUp() : void 
    {
        
        $this->fer = new FeesEstimateRequest(
            new MarketPlace($this->marketPlaceCountryCode), 
            new IdType($this->idType), 
            $this->idValue,
            new PriceToEstimateFees( 
                new MoneyType($this->listingAmount, 'EUR' ), 
                new MoneyType($this->shippingAmount, 'EUR'), 
                null),
            $this->identifier,
            false
        );

        // build array with 30 requests
        for ($i=0; $i<30; $i++) {
            $this->tooManyFer[] = $this->fer;
        }


    }

    public function testFeesEstimateRequestListWrongDataType() : void 
    {
        
        // wrong datatype 
        $this->expectException(\Exception::class);
        $ferl = new FeesEstimateRequestList(['invalidarray']);

    }

    public function testFeesEstimateRequestListTooManyRequests() : void 
    {

        // too many values 
        $this->expectException(\Exception::class);
        $ferl = new FeesEstimateRequestList($this->tooManyFer);

    }

    public function testFeesEstimateRequest() : void 
    {

        // correct call
        $ferl = new FeesEstimateRequestList([ $this->fer ]);
        $this->assertIsObject($ferl);

        $kv = $ferl->getKeyValuePair();

        $this->assertIsArray($kv);

        $this->assertArrayHasKey( $ferl->getName() . '.FeesEstimateRequest.1.MarketplaceId', $kv);
        $this->assertArrayHasKey( $ferl->getName() . '.FeesEstimateRequest.1.IdType', $kv);
        $this->assertArrayHasKey( $ferl->getName() . '.FeesEstimateRequest.1.IdValue', $kv);
        $this->assertArrayHasKey( $ferl->getName() . '.FeesEstimateRequest.1.IsAmazonFulfilled', $kv);
        $this->assertArrayHasKey( $ferl->getName() . '.FeesEstimateRequest.1.Identifier', $kv);
        $this->assertArrayHasKey( $ferl->getName() . '.FeesEstimateRequest.1.PriceToEstimateFees.ListingPrice.CurrencyCode', $kv);
        $this->assertArrayHasKey( $ferl->getName() . '.FeesEstimateRequest.1.PriceToEstimateFees.ListingPrice.Amount', $kv);
        $this->assertArrayHasKey( $ferl->getName() . '.FeesEstimateRequest.1.PriceToEstimateFees.Shipping.CurrencyCode', $kv);
        $this->assertArrayHasKey( $ferl->getName() . '.FeesEstimateRequest.1.PriceToEstimateFees.Shipping.Amount', $kv);

        
    }


}