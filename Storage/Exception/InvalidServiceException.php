<?php

namespace Oryzone\Bundle\OauthBundle\Storage\Exception;

use Oryzone\Bundle\OauthBundle\Exception\Exception;

class InvalidServiceException extends \Exception implements Exception
{
    protected $serviceName;

    public function __construct($serviceName)
    {
        $this->serviceName = $serviceName;
        $message = sprintf('The Oauth Storage service "%s" is not an istance of "\OAuth\Common\Storage\TokenStorageInterface"',
            $this->serviceName);
        parent::__construct($message);
    }

    public function getServiceName()
    {
        return $this->serviceName;
    }
}
