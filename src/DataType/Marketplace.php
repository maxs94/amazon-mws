<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType;

use Maxs94\AmazonMws\DataType\Amazon\AmazonString;

/**
 * List of market place ids: https://docs.developer.amazonservices.com/en_US/dev_guide/DG_Endpoints.html
 */
class Marketplace extends AmazonString 
{

    /**
     * @var string
     */
    protected $value;

    /**
     * parameter name 
     */
    public const NAME = 'MarketplaceId';

    /**
     * Marketplace Ids
     * https://docs.developer.amazonservices.com/en_US/dev_guide/DG_Endpoints.html
     */
    public const ENDPOINTS = [

        'BR' => ['endpoint' => 'https://mws.amazonservices.com', 'id' => 'A2Q3Y263D00KWC'],
        'CA' => ['endpoint' => 'https://mws.amazonservices.ca', 'id' => 'A2EUQ1WTGCTBG2'],
        'MX' => ['endpoint' => 'https://mws.amazonservices.com.mx', 'id' => 'A1AM78C64UM0Y8'],
        'US' => ['endpoint' => 'https://mws.amazonservices.com', 'id' => 'ATVPDKIKX0DER'],
        
        'AE' => ['endpoint' => 'https://mws.amazonservices.ae', 'id' => 'A2VIGQ35RCS4UG'],
        'DE' => ['endpoint' => 'https://mws-eu.amazonservices.com', 'id' => 'A1PA6795UKMFR9'],
        'EG' => ['endpoint' => 'https://mws-eu.amazonservices.com', 'id' => 'ARBP9OOSHTCHU'],
        'ES' => ['endpoint' => 'https://mws-eu.amazonservices.com', 'id' => 'A1RKKUPIHCS9HS'],
        'FR' => ['endpoint' => 'https://mws-eu.amazonservices.com', 'id' => 'A13V1IB3VIYZZH'],
        'GB' => ['endpoint' => 'https://mws-eu.amazonservices.com', 'id' => 'A1F83G8C2ARO7P'],
        'IN' => ['endpoint' => 'https://mws.amazonservices.in', 'id' => 'A21TJRUUN4KGV'],
        'IT' => ['endpoint' => 'https://mws-eu.amazonservices.com', 'id' => 'APJ6JRA9NG5V4'],
        'NL' => ['endpoint' => 'https://mws-eu.amazonservices.com', 'id' => 'A1805IZSGTT6HS'],
        'SA' => ['endpoint' => 'https://mws-eu.amazonservices.com', 'id' => 'A17E79C6D8DWNP'],
        'SE' => ['endpoint' => 'https://mws-eu.amazonservices.com', 'id' => 'A2NODRKZP88ZB9'],
        'TR' => ['endpoint' => 'https://mws-eu.amazonservices.com', 'id' => 'A33AVAJ2PDY3EV'],

        'SG' => ['endpoint' => 'https://mws-fe.amazonservices.com', 'id' => 'A19VAU5U5O7RUS'],
        'AU' => ['endpoint' => 'https://mws.amazonservices.com.au', 'id' => 'A39IBJ37TRP1C6'],
        'JP' => ['endpoint' => 'https://mws.amazonservices.jp', 'id' => 'A1VC38T7YXB528'],

    ];

    /**
     * return the Marketplace by Country Code
     *
     * @param string $cc
     * @return string
     */
    public function getIdByCountryCode(string $cc) : string 
    {
        return self::ENDPOINTS[$cc]['id'];
    }

    /**
     * return the Endpoint by CountryCode
     *
     * @param string $cc
     * @return string 
     */
    public function getEndpointByCountryCode(string $cc) : string 
    {
        return self::ENDPOINTS[$cc]['endpoint'];
    }

    /**
     * return endpoint 
     *
     * @return string|null
     */
    public function getEndpoint() : ?string 
    {
        foreach (self::ENDPOINTS as $k => $v) {
            if ($v['id'] == $this->value) {
                return $v['endpoint'];
            }
        }
        return null;
    }

    public function __construct(string $cc) 
    {
        if (!array_key_exists($cc, self::ENDPOINTS)) {
            throw new \Exception(sprintf('Given Country code %s does not exist.', $cc));
        }   

        $MarketplaceId = $this->getIdByCountryCode($cc);
        $this->value = $MarketplaceId;
        parent::__construct(self::NAME, $MarketplaceId);
    }

    public function getName() : string
    {
        return self::NAME;
    }

    public function getValue() : string 
    {
        return $this->value;
    }
}