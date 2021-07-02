<?php

declare(strict_types=1);

namespace Maxs94\AmazonMws\Client;

use Exception;
use Unirest\Request;
use SimpleXMLElement;
use Maxs94\AmazonMws\Xml\AmazonXmlParser;
use Maxs94\AmazonMws\Actions\AmazonAction;
use Maxs94\AmazonMws\DataType\Marketplace;
use Maxs94\AmazonMws\Xml\AmazonXmlTemplate;
use Maxs94\AmazonMws\Client\AmazonUserAgent;
use Maxs94\AmazonMws\DataType\MarketplaceList;
use Maxs94\AmazonMws\Actions\AmazonActionInterface;
use Maxs94\AmazonMws\Exceptions\MissingActionException;
use Maxs94\AmazonMws\Exceptions\MissingPayloadException;
use Maxs94\AmazonMws\Exceptions\MissingServiceUrlException;
use Maxs94\AmazonMws\Exceptions\WrongServiceUrlSchemeException;
use Maxs94\AmazonMws\Xml\SimpleXMLElementExtension;

/**
 * Marketplace ids: https://docs.developer.amazonservices.com/en_US/dev_guide/DG_Endpoints.html
 */
class AmazonClient implements AmazonClientInterface
{

    protected $AWS_ACCESS_KEY_ID;
    protected $AWS_SECRET_ACCESS_KEY;
    protected $MWS_AUTH_TOKEN;
    protected $APP_VERSION;
    protected $MERCHANT_ID;

    protected $scheme = 'https';

    private $eol = "\n";

    private $serviceUrl;

    /**
     * @var AmazonAction
     */
    protected $action;

    /**
     * @var AmazonUserAgent
     */
    protected $amazonUserAgent;

    /**
     * @var AmazonXmlParser
     */
    protected $amazonXmlParser;

    /**
     * @var AmazonXmlTemplate
     */
    protected $amazonXmlTemplate;

    /**
     * Construtor
     */
    public function __construct(
        string $AWS_ACCESS_KEY_ID,
        string $AWS_SECRET_ACCESS_KEY,
        string $MWS_AUTH_TOKEN,
        string $MERCHANT_ID
    ) {
        $this->AWS_ACCESS_KEY_ID = $AWS_ACCESS_KEY_ID;
        $this->AWS_SECRET_ACCESS_KEY = $AWS_SECRET_ACCESS_KEY;
        $this->MWS_AUTH_TOKEN = $MWS_AUTH_TOKEN;
        $this->MERCHANT_ID = $MERCHANT_ID;

        // userAgent
        $this->amazonUserAgent = new AmazonUserAgent();

        // amazonXmlParser
        $this->amazonXmlParser = new AmazonXmlParser();

        // amazonXmlTemplate 
        $this->amazonXmlTemplate = new AmazonXmlTemplate();

    }

    public function setServiceURL(string $serviceURL)
    {
        $parsedUrl = parse_url($serviceURL);

        // take the scheme from the provided serviceURL 
        if (array_key_exists('scheme', $parsedUrl)) {
            $this->setScheme($parsedUrl['scheme']);
        }

        // remove scheme from url 
        $url = preg_replace('#^https?://#', '', rtrim($serviceURL, '/'));
        $this->serviceUrl = $url;
    }

    public function getServiceURL()
    {
        return $this->serviceUrl;
    }

    /**
     * set client action
     *
     * @param AmazonActionInterface $action
     * @return AmazonClientInterface
     */
    public function setAction(AmazonActionInterface $action): AmazonClientInterface
    {
        $this->action = $action;
        return $this;
    }

    public function setScheme(string $scheme)
    {
        $scheme = strtolower($scheme);
        if ($scheme != 'https' && $scheme != 'http') {
            throw new WrongServiceUrlSchemeException();
        }

        $this->scheme = $scheme;
    }



    /**
     * generates a RFC 2104-compliant HMAC signature
     * https://docs.aws.amazon.com/general/latest/gr/signature-version-2.html
     * 
     * @param string $data
     * @param string $secretKey
     * @param string $algorithm
     * @return string (base64 encoded hash of $data)
     */
    protected function sign(string $data, string $secretKey, $algorithm = 'HmacSHA256'): string
    {
        if ($algorithm === 'HmacSHA1') {
            $algo = 'sha1';
        } elseif ($algorithm === 'HmacSHA256') {
            $algo = 'sha256';
        } else {
            throw new Exception('Invalid hashing algorithm specified');
        }

        return base64_encode(
            hash_hmac($algo, $data, $secretKey, true)
        );
    }

    /**
     * calculate the signature for the parameters and return the POST url
     * SignatureVersion 2
     * docs: http://docs.developer.amazonservices.com/en_DE/dev_guide/DG_SigningQueryRequest.html
     *
     *    1. The HTTP Request Method followed by an ASCII newline (%0A)
     *
     *    2. The HTTP Host header in the form of lowercase host,
     *       followed by an ASCII newline.
     *
     *    3. The URL encoded HTTP absolute path component of the URI
     *       (up to but not including the query string parameters);
     *       if this is empty use a forward '/'. This parameter is followed
     *       by an ASCII newline.
     *
     *    4. The concatenation of all query string components (names and
     *       values) as UTF-8 characters which are URL encoded as per RFC
     *       3986 (hex characters MUST be uppercase), sorted using
     *       lexicographic byte ordering. Parameter names are separated from
     *       their values by the '=' character (ASCII character 61), even if
     *       the value is empty. Pairs of parameter and values are separated
     *       by the '&' character (ASCII code 38).
     * 
     * @param array $parameters
     * @param string $secretKey
     * @return string
     */
    protected function getUrl(array $parameters, string $secretKey): string
    {
        // sort array alphabetically
        ksort($parameters);

        // create flattened representation for signing
        $data = $this->action->getMethod() . $this->eol;
        $data .= $this->serviceUrl . $this->eol;

        $uriencoded = $this->action->getUri() . '/' . $this->action->getVersion();
        $data .= $uriencoded . $this->eol;

        uksort($parameters, 'strcmp');
        $data .= http_build_query($parameters);

        // add signature to the parameters
        $parameters['Signature'] = $this->sign($data, $secretKey);

        // construct url 
        $url = $this->scheme . '://' . $this->serviceUrl . $this->action->getUri() . '/' . $this->action->getVersion();
        $url .= '?' . http_build_query($parameters);

        return $url;
    }

    /**
     * if no serviceURL has been provided, we try to find the correct one from the action
     * note: some actions don't require a MarketplaceId
     */
    private function findServiceUrl()
    {
        if (count($this->action->getParameters()) == 0) {
            throw new MissingServiceUrlException();
        }

        // try to get it from the MarketplaceId if set

        /** @var Marketplace */
        $Marketplace = $this->action->getParameter('MarketplaceId');
        if (!$Marketplace) {
            throw new MissingServiceUrlException();
        }

        if (get_class($Marketplace) == MarketplaceList::class) {
            throw new MissingServiceUrlException('Multiple Marketplaces provided. Cannot decide which one to send the call to. Please provide a service url with ->setServiceURL yourself.');
        }

        $endpoint = $Marketplace->getEndPoint();
        if (!$endpoint) {
            throw new MissingServiceUrlException();
        }

        $this->setServiceURL($Marketplace->getEndpoint());
    }


    /**
     * prepare and return payload XML
     *
     * @return string
     */
    private function prepareXmlPayload() : string
    {
        $xml = new SimpleXMLElementExtension('<AmazonEnvelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="amzn-envelope.xsd"/>');
        $header = $xml->addChild('Header');
        $header->addChild('DocumentVersion', '1.01');
        $header->addChild('MerchantIdentifier', $this->MERCHANT_ID);

        /** @var FeedType */
        $feedType = $this->action->getParameter('FeedType');
        $xml->addChild('MessageType', $feedType->getElementName());

        /** @var PurgeAndReplace */
        $purgeAndReplace = $this->action->getParameter('PurgeAndReplace');
        $xml->addChild('PurgeAndReplace', $purgeAndReplace ? strval($purgeAndReplace->getValue()) : 'false');

        $xml->appendXML($this->action->getXmlMessage());

        return $xml->asXML();
    }

    /**
     * create the feed
     */
    public function createFeed()
    {

        // no action? no action.
        if (!$this->action) {
            throw new MissingActionException();
        }
        
        // if no serviceURL has been provided, we try to find the correct one from the action
        if ($this->serviceUrl === null) {
            $this->findServiceUrl();
        }

        if (!$this->getServiceURL()) {
            throw new MissingServiceUrlException();
        }

        // check if we have all additional action parameters 
        $this->action->validateParameters();

        /** @var DateTime */
        $time = new \DateTime();
        $time->setTimezone(new \DateTimeZone('UTC'));

        /** @var array */
        $parameters = array(
            'AWSAccessKeyId' => $this->AWS_ACCESS_KEY_ID,
            'Action' => $this->action->getName(),
            'MWSAuthToken' => $this->MWS_AUTH_TOKEN,
            'SellerId' => $this->MERCHANT_ID,
            'SignatureMethod' => 'HmacSHA256',
            'SignatureVersion' => '2',
            'Timestamp' => $time->format('Y-m-d\TH:i:s\Z'),
            'Version' => $this->action->getVersion()
        );

        // add the parameters 
        foreach ($this->action->getParameters() as $p) {
            // call the parameters getParameterArray method 
            $parameters = array_merge($parameters, $p->getKeyValuePair());
        }


        // check if this action requires a payload 
        $feed['payload'] = null;
        if ($this->action->getPayloadRequired() && !$this->action->getXmlMessage()) {

            throw new MissingPayloadException('You did not provide a payload for this action. Provide one with ->addPayload method');

        } else if ($this->action->getPayloadRequired() && $this->action->getXmlMessage()) {

            // prepare and add the payload to the action
            $this->action->addPayload($this->prepareXmlPayload());

        } 

        // add a payload if one is defined
        if ($this->action->getPayload() && $this->action->getPayloadRequired()) {

            $feed['payload'] = $this->action->getPayload();

            // calc the MD5 hash for the payload
            $parameters['ContentMD5Value'] = base64_encode(md5($feed['payload'], true));
        }

        // get a formatted url string
        $feed['url'] = $this->getUrl($parameters, $this->AWS_SECRET_ACCESS_KEY);

        // add the headers
        $feed['headers'] = [
            'User-Agent' => $this->amazonUserAgent->getString(),
            'Content-Type' => 'text/xml'
        ];

        return $feed;
    }

    /**
     * submit the feed
     *
     * @return void
     */
    public function submitFeed()
    {
        $feed = $this->createFeed();

        $response = Request::send($this->action->getMethod(), $feed['url'], $feed['payload'], $feed['headers']);

        return $this->parseResponse($response);
    }

    /**
     * parse Amazon's Xml response
     *
     * @param $response
     * @return SimpleXMLElement
     */
    protected function parseResponse($response): SimpleXMLElement
    {

        if (!$response) {
            throw new Exception('Did not receive any response from Amazon');
        }

        if ($response->code !== 200) {
            throw new Exception(sprintf('%s', $response->body));
        }

        if (stristr($response->headers['Content-Type'], 'text/xml') === false) {
            throw new Exception(sprintf('Got %s Content-Type in response, should be text/xml', $response->headers['Content-Type']));
        }

        return $this->amazonXmlParser->parseXml($response->raw_body, $this->action);
    }
}
