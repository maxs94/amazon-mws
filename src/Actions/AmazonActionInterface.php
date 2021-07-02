<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Actions;
use Unirest\Method;
use Maxs94\AmazonMws\DataType\Amazon\DataType;

interface AmazonActionInterface
{

    public function setName($name);
    public function getName() : string;

    public function setVersion($version);
    public function getVersion() : string;
 
    public function setMethod(Method $method);
    public function getMethod() : string;
 
    public function getXmlTemplate() : string;
    public function setXmlTemplate(string $template);

    public function getUri() : string;
    public function setUri(string $uri);

    public function validateParameters() : bool;

    public function addParameter(DataType $data);
    public function getParameters() : array;

    public function getRequestParameters() : array;
    public function getRequestParameter($parameterName);

    public function getXmlResponseMask() : array;
    public function setXmlResponseMask(array $xmlResponseMask);

    public function getPayloadRequired() : bool;
    public function addPayload($payload) : void;
    public function getPayload() : ?string;

}