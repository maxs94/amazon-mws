<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Exceptions;

class MissingServiceUrlException extends \Exception 
{
    protected $message = 'No ServiceURL defined. Set ServiceURL first with method setServiceURL()';
}