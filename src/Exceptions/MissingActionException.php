<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Exceptions;

class MissingActionException extends \Exception 
{
    protected $message = 'No action defined. Please set one with setAction()';
}