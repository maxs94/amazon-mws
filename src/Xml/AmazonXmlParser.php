<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Xml;

use Exception;
use Maxs94\AmazonMws\Actions\AmazonAction;
use Maxs94\AmazonMws\Exceptions\InvalidAmazonResponseException;
use SimpleXMLElement;

class AmazonXmlParser 
{

    /**
     * parse Xml into an object
     *
     * @param string $xmlString
     * @return SimpleXMLElement
     */
    public function parseXml(string $xmlString, AmazonAction $action) : SimpleXMLElement
    {

        try {
            $xml = new SimpleXMLElement($xmlString);
        } catch (Exception $ex) {
            throw $ex;
        }

        // should we check Amazon's XML response?
        if ($action->getCheckAmazonResponseString() == true) {

            // expected response element name
            $returnResponseName = sprintf('%sResponse', $action->getName());

            // check if the response is correct
            if ($xml->getName() != $returnResponseName) {
                throw new InvalidAmazonResponseException(
                    sprintf('invalid response from Amazon, expected: %s, received: %s', 
                        $returnResponseName,
                        $xml->getName())
                    );
            }

        }

        return $xml;

    }

    

}
