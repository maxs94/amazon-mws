<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataTransformer;

use Maxs94\AmazonMws\DataType\Amazon\DataType;
use Maxs94\AmazonMws\Xml\SimpleXMLElementExtension;

class Array2XmlDataTransformer
{

    /** @var bool */
    private static $autoclose = false;

    // based on http://stackoverflow.com/a/1397164/1037948
    public static function toXml($arr, SimpleXMLElementExtension $root = null, $el = 'x', $parent = null) {
    
        if(!isset($root) || null == $root) {
			// xml hack -- if not, self-close
			if(false === strpos($el, '/') && 0 !== strpos($el, '<')) $el = "<$el/>";
			$root = new SimpleXMLElementExtension($el);
		}
		
		if(is_array($arr)) {

			foreach($arr as $k => $v) {

                // special: attributes
                if (is_string($k) && $k == '@value') {
                    // @value sets the xml tag value
                    $root[0] = $v;

                } else if (is_string($k) && $k[0] == '@') {
                    
                    // only add attribute
                    $root->addAttribute(substr($k, 1), $v);

                } else if(is_numeric($k)) {

				    // special: a numerical index only should mean repeating nodes 
					// first time, just add it to the existing element
					if($k == 0) self::toXml($v, $root, $el, $parent);
                    else self::toXml($v, $parent->addChild($root->getName()), $el, $parent);

				}
				// normal: append
				else self::toXml($v, $root->addChild($k), $el, $root);
			}
		} else {

			if (self::$autoclose && empty($arr)) {
			    // don't set a value if nothing
            } else {
                $root[0] = $arr;
            }

		}

		return $root;
    }

    /**
     * Check if the tag name or attribute name contains illegal characters
     * Ref: http://www.w3.org/TR/xml/#sec-common-syn.
     *
     * @param string $tag
     * @return bool
     */
    private static function isValidTagName($tag)
    {
        $pattern = '/^[a-z_]+[a-z0-9\:\-\.\_]*[^:]*$/i';
        return preg_match($pattern, $tag, $matches) && $matches[0] == $tag;
    }



}