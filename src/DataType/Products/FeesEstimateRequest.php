<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Products;

use Maxs94\AmazonMws\DataType\Marketplace;
use Maxs94\AmazonMws\DataType\Amazon\DataType;
use Maxs94\AmazonMws\DataType\Products\IdType;

class FeesEstimateRequest extends DataType
{

    public const NAME = 'FeesEstimateRequest';

    /**
     * @var Marketplace
     */
    protected $Marketplace;

    /**
     * @var IdType
     */
    protected $idType;
    
    /**
     * @var string 
     */
    protected $idValue;

    /**
     * @var PriceToEstimateFees
     */
    protected $priceToEstimateFeeds;

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var bool
     */
    protected $isAmazonFulfilled;

    /**
     * constructor
     *
     * @param Marketplace $Marketplace
     * @param IdType $idType
     * @param string $idValue
     * @param PriceToEstimateFees $priceToEstimateFees
     * @param string $identifier
     * @param bool $isAmazonFulfilled
     */
    public function __construct(
        Marketplace $Marketplace,
        IdType $idType,
        string $idValue,
        PriceToEstimateFees $priceToEstimateFees,
        string $identifier,
        bool $isAmazonFulfilled
    ) {
        $this->Marketplace = $Marketplace;
        $this->idType = $idType;
        $this->idValue = $idValue;
        $this->priceToEstimateFeeds = $priceToEstimateFees;
        $this->identifier = $identifier;
        $this->isAmazonFulfilled = $isAmazonFulfilled;
    }

    public function getMarketplace() : Marketplace 
    {
        return $this->Marketplace;
    }

    public function getIdType() : IdType 
    {
        return $this->idType;
    }

    public function getIdValue() : string 
    {
        return $this->idValue;
    }

    public function getPriceToEstimateFees() : PriceToEstimateFees
    {
        return $this->priceToEstimateFeeds;
    }

    public function getIdentifier() : string 
    {
        return $this->identifier;
    }

    public function getIsAmazonFulfilled() : bool 
    {
        return $this->isAmazonFulfilled;
    }

    public function getName() : string 
    {
        return self::NAME;
    }

    public function getKeyValuePair(): array
    {
        return [];
    }


}