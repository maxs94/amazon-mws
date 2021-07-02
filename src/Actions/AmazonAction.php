<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Actions;
use Exception;
use Unirest\Method;
use Maxs94\AmazonMws\DataType\Amazon\DataType;
use Maxs94\AmazonMws\Exceptions\MissingParametersException;
use Maxs94\AmazonMws\Exceptions\MissingAllParametersException;
use Maxs94\AmazonMws\Exceptions\OnlyOneParameterAllowedException;
use Maxs94\AmazonMws\Xml\SimpleXMLElementExtension;

abstract class AmazonAction implements AmazonActionInterface
{
    /**
     * @var string 
     */
    protected $name;

    /**
     * @var string 
     */
    protected $version;

    /**
     * @var string
     */
    protected $method = Method::POST;

    /**
     * @var string 
     */
    protected $xmlSchema;

    /**
     * @var string 
     */
    protected $xmlTemplate = '';

    /**
     * needed parameters used for the request
     * @var array
     */
    protected $requestParameters = [];

    /**
     * required parameters which cannot be provided at the same time
     *
     * @var array
     */
    protected $requireOneOfParameters = [];

    /**
     * @var array 
     */
    protected $parameters = [];

     /**
     * @var array
     */
    protected $xmlResponseMask = [];

    /**
     * @var string 
     */
    protected $uri = '/';

    /**
     * @var bool
     */
    protected $payloadRequired = false;

    /**
     * @var string
     */
    protected $payload = null;

    /**
     * @var bool
     */
    protected $checkAmazonResponseString = true;


    public function setName($name) 
    {
        $this->name = $name;
    }

    public function getName() : string 
    {
        return $this->name;
    }

    public function setVersion($version) 
    {
        $this->version = $version;
    }

    public function getVersion() : string
    {
        return $this->version;
    }

    public function setMethod(Method $method)
    {
        $this->method = $method;
    }

    public function getMethod() : string
    {
        return $this->method;
    }

    public function getXmlSchema() : string
    {
        return $this->xmlSchema;
    }

    public function setXmlSchema($xmlSchema)
    {
        $this->xmlSchema = $xmlSchema;
    }

    public function getXmlTemplate() : string 
    {
        return $this->xmlTemplate;
    }

    public function setXmlTemplate(string $template) 
    {
        $this->xmlTemplate = $template;
    }
 
    public function getUri() : string 
    {
        return $this->uri;
    }

    public function setUri(string $uri) 
    {
        $this->uri = $uri;
    }

    public function getXmlResponseMask() : array
    {
        return $this->xmlResponseMask;
    }

    public function setXmlResponseMask(array $xmlResponseMask) 
    {
        $this->xmlResponseMask = $xmlResponseMask;
    }

    /**
     * check if given parameter name is found in the requireOneOfParamters array 
     *
     * @param [type] $parameterName
     * @return bool
     * 
     * @throws Exception if more than one parameter was provided
     */
    private function checkInRequireOneOfParameters($parameterName) : bool
    {
        if (!$this->requireOneOfParameters) return false;

        foreach ($this->requireOneOfParameters as $k => $roop) {

            // no parameters defined at all?
            if (!$this->parameters) {
                throw new OnlyOneParameterAllowedException(sprintf('Exactly one of the parameters %s should be provided', implode(',', $roop)));
            }

            if (in_array($parameterName, $roop)) {
                // found, now check if any of those parameters are set 
                $count = 0;
                
                foreach ($roop as $p) {
                    if (array_key_exists($p, $this->parameters)) $count++;
                }

                if ($count != 1) {
                    throw new OnlyOneParameterAllowedException(sprintf('Exactly one of the parameters %s should be provided', implode(',', $roop)));
                }

            }
        }
        return false;
    }

    /**
     * validate parameters
     * checks if we have provided all required parameters
     * checks if we have provided invalid parameters
     *
     * @return bool
     */
    public function validateParameters() : bool
    {

        // if we don't have any request Parameters to validate, return
        if (!$this->requestParameters) return true;

        foreach($this->requestParameters as $requestParameter) {

            // required parameter?
            if ($requestParameter->getRequired()) {

                // no parameters provided at all?
                if (!$this->parameters) {
                    throw new MissingAllParametersException(sprintf('Missing required action parameter: %s. Please check API documentation on this call. %s', $requestParameter->getName(), print_r($this->getRequestParameters(), true)));
                }

                // single required parameter, check if it has been set 
                if (!isset($this->parameters[$requestParameter->getName()])) {
                    throw new MissingParametersException(sprintf('Missing required action parameter: %s. Please check API documentation on this call. %s', $requestParameter->getName(), print_r($this->getRequestParameters(), true)));
                }


            } else {
                
                // optionals 
                // check if we have a "required on of these" paremeters set in this action
                $this->checkInRequireOneOfParameters($requestParameter->getName());

            }

        }
  
        return true;

    }

    /**
     * add payload to action 
     * todo: validation, checks
     *
     * @param $payload
     * @return void
     */
    public function addPayload($payload) : void 
    {
        $this->payload = $payload;
    }

    /**
     * get the payload as string for the http request
     * todo: convert to string
     *
     * @return string
     */
    public function getPayload() : ?string
    {
        return $this->payload;
    }

    /**
     * adds the parameter to the parameter array
     */
    public function addParameter(DataType $dataType)
    {
        $this->parameters[$dataType->getName()] = $dataType;
    }

    /**
     * get a single provided parameter value
     *
     * @param string $key
     * @return DataType|null
     */
    public function getParameter(string $key) : ?DataType
    {
        if (array_key_exists($key, $this->parameters)) {
            return $this->parameters[$key];
        }
        return null;
    }

    /**
     * return all provided parameters
     *
     * @return array
     */
    public function getParameters() : array 
    {
        return $this->parameters ? $this->parameters : [];
    }

    /**
     * return all request parameters for this action
     *
     * @return array
     */
    public function getRequestParameters() : array
    {
        return $this->requestParameters ? $this->requestParameters : [];
    }

    /**
     * find and return a requestParameter by its name
     *
     * @param $parameterName
     * @return AmazonRequestParameter or null
     */
    public function getRequestParameter($parameterName) {
        foreach ($this->requestParameters as $requestParameter) {
            if ($requestParameter->getName() == $parameterName) return $requestParameter;
        }
        return null;
    }

    /**
     * return if we need a payload for this action
     *
     * @return boolean
     */
    public function getPayloadRequired(): bool
    {
        return $this->payloadRequired;
    }


    public function getXmlMessage() : SimpleXMLElementExtension
    {
        $xml = new SimpleXMLElementExtension('<template/>');
        return $xml;
    }

    /**
     * Get the value of checkAmazonResponseString
     *
     * @return  bool
     */ 
    public function getCheckAmazonResponseString()
    {
        return $this->checkAmazonResponseString;
    }
}