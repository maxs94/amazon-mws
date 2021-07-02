<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Xml;

use SimpleXMLElement;

class SimpleXMLElementExtension extends SimpleXMLElement
{

    /**
     * add child only if value exists
     *
     * @param SimpleXMLElementExtension $xml
     * @param string $key
     * @return SimpleXMLElementExtension|null
     */
    public function addChildIfExists(string $key, $val) : ?SimpleXMLElementExtension
    {
        if (!empty($val)) {
            $res = $this->addChild($key, $val);
            return $res;
        }

        return null;

    }


    /**
     * Add SimpleXMLElement code into a SimpleXMLElement
     *
     * @param SimpleXMLElementExtension $append
     */
    public function appendXML(SimpleXMLElementExtension $append)
    {
        if ($append) {
            if (strlen(trim((string)$append)) == 0) {
                $xml = $this->addChild($append->getName());
            } else {
                $xml = $this->addChild($append->getName(), (string)$append);
            }

            foreach ($append->children() as $child) {
                $xml->appendXML($child);
            }


            foreach ($append->attributes() as $n => $v) {
                $xml->addAttribute((string)$n, (string)$v);
            }
        }
    }
}