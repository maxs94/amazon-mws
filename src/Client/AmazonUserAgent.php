<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Client;

class AmazonUserAgent
{

    /**
     * application Name
     *
     * @var string
     */
    private $applicationName = 'AmazonMWSClient';

    /**
     * application Version
     *
     * @var string
     */
    private $applicationVersion = '1.0.0'; 

    public function __construct(string $applicationName='', string $applicationVersion='')
    {
        if ($applicationName) $this->applicationName = $applicationName;
        if ($applicationVersion) $this->applicationVersion = $applicationVersion;
    }


     /**
     * Construct a valid MWS compliant HTTP User-Agent Header. From the MWS Developer's Guide, this
     * entails:
     * "To meet the requirements, begin with the name of your application, followed by a forward
     * slash, followed by the version of the application, followed by a space, an opening
     * parenthesis, the Language name value pair, and a closing paranthesis. The Language parameter
     * is a required attribute, but you can add additional attributes separated by semi-colons."
     *
     * @return string
     */
    public function getString(): string
    {
        $userAgent = $this->applicationName . '/' . $this->applicationVersion;
        $userAgent .= ' (Language=PHP/' . phpversion();
        $userAgent .= '; Platform=' . php_uname('s') . '/' . php_uname('m') . '/' . php_uname('r');
        $userAgent .= '; Packagist=maxs94/amazon_mws)';
        return $userAgent; 
    }

}