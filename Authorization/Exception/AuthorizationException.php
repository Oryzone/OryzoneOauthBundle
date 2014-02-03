<?php

namespace Oryzone\Bundle\OauthBundle\Authorization\Exception;

use Oryzone\Bundle\OauthBundle\Exception\Exception;

class AuthorizationException extends \Exception implements Exception
{

    protected $error;

    protected $reason;

    protected $provider;

    protected $redirect;

    public function __construct($error, $reason, $provider, $redirect, $message = null, $code = 0, \Exception $previous = null)
    {
        $this->error = $error;
        $this->reason = $reason;
        $this->provider = $provider;
        $this->redirect = $redirect;
        parent::__construct($message, $code, $previous);
    }

    public function getError()
    {
        return $this->error;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function getProvider()
    {
        return $this->provider;
    }

    public function getRedirect()
    {
        return $this->redirect;
    }

}
