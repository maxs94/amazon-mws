<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Exceptions;

class WrongServiceUrlSchemeException extends \Exception 
{
    protected $message = 'Wrong scheme for ServiceURL. Only https or http are allowed';
}