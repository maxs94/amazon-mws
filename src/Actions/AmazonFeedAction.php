<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Actions;

use Maxs94\AmazonMws\Xml\SimpleXMLElementExtension;
use Maxs94\AmazonMws\DataTransformer\Array2XmlDataTransformer;

class AmazonFeedAction extends AmazonAction
{

    /**
     * @var array
     */
    private $data = [];


    /**
     * add data to action
     *
     * @param array $data
     * @return void
     */
    public function addData(array $data) 
    {
        $this->data = $data;
    }

    /**
     * return the data array
     *
     * @return void
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * get the xml string from each data item
     *
     * @return string
     */
    public function getXmlMessage() : SimpleXMLElementExtension
    {

        /** @var FeedType */
        $feedType = $this->getParameter('FeedType');

        /** @var SimpleXMLElementExtension */
        $xml = new SimpleXMLElementExtension('<Message/>');

        $xml->addChild('MessageID', '1');
        $xml->addChild('OperationType', 'Update');
        
        foreach ($this->data as $item) {
            if (is_array($item)) {
                // convert array to xml
                $child = Array2XmlDataTransformer::toXml($item, null, $feedType->getElementName());
                $xml->appendXML($child);
            } else {
                // use the getXml() method from the class
               $xml->appendXML($item->getXml());
            }
        }

        return $xml;
    }

}