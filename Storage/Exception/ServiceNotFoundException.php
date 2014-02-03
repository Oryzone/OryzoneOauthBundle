<?php

namespace Oryzone\Bundle\OauthBundle\Storage\Exception;

use Oryzone\Bundle\OauthBundle\Exception\Exception;

class ServiceNotFoundException extends \Exception implements Exception
{

    protected $key;

    protected $serviceName;

    public function __construct($key, $serviceName)
    {
        $this->key = $key;
        $this->serviceName = $serviceName;
        $message = sprintf('The Oauth storage service "%s" is mapped to a non-existent service called "%s"', $this->key, $this->serviceName);
        parent::__construct($message);
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getServiceName()
    {
        return $this->serviceName();
    }

}
