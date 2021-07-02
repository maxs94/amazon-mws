<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Exceptions;

class MissingAllParametersException extends \Exception 
{
    protected $message = 'You did not provide any of the required parameters. Please check API documentation on this call. You can get a list of all parameters by calling getRequestParameters()';
}