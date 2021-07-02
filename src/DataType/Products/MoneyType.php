<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Products;

use Maxs94\AmazonMws\DataType\Amazon\DataType;
use Maxs94\AmazonMws\Xml\SimpleXMLElementExtension;

/**
 * https://docs.developer.amazonservices.com/en_US/products/Products_Datatypes.html#MoneyType
 */
class MoneyType extends DataType
{


    public const NAME = 'MoneyType';

    /**
     * valid currencies
     *
     * @var array
     */
    private $validCurrencies = [
        'USD',
        'EUR',
        'GBP',
        'RMB',
        'INR',
        'JPY',
        'CAD',
        'MXN'
    ];

    /**
     * @var float 
     */  
    protected $amount;

    /**
     * @var string 
     */
    protected $currencyCode;

    /**
     * constructor
     *
     * @param float $amount
     * @param string $currencyCode
     */
    public function __construct(
        float $amount,
        string $currencyCode
    ) {
        $this->amount = $amount;
        $this->setCurrencyCode($currencyCode);
    }


    /**
     * Get the value of amount
     */ 
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */ 
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of currencyCode
     *
     * @return  string
     */ 
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * Set the value of currencyCode
     *
     * @param  string  $currencyCode
     *
     * @return  self
     */ 
    public function setCurrencyCode(string $currencyCode)
    {
        if (!in_array($currencyCode, $this->validCurrencies)) {
            throw new \Exception('provided currency is not a valid currency code.');
        }

        $this->currencyCode = $currencyCode;

        return $this;
    }

    public function getName() : string 
    {
        return self::NAME;
    }

    public function getKeyValuePair(): array
    {
        return [];
    }

    public function getXml(string $nodeName = 'MSRP'): SimpleXMLElementExtension
    {
        $xml = new SimpleXMLElementExtension('<' . $nodeName . '/>');
        $xml[0] = sprintf('%f', $this->getAmount());
        $xml->addAttribute('currency', $this->getCurrencyCode());
        return $xml;
    }

    public function getArray() : array 
    {
        $data = [
            '@currency' => $this->getCurrencyCode(),
            '@value' => $this->getAmount()
        ];
        return $data;
    }

    
}