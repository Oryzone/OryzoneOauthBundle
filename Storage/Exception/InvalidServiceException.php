<?php

namespace Oryzone\Bundle\OauthBundle\Storage\Exception;

use Oryzone\Bundle\OauthBundle\Exception\Exception;

/**
 * Class InvalidServiceException
 * @package Oryzone\Bundle\OauthBundle\Storage\Exception
 */
class InvalidServiceException extends \Exception implements Exception
{
    /**
     * @var string $serviceName
     */
    protected $serviceName;

    /**
     * Constructor
     *
     * @param string $serviceName The name of the DIC service
     */
    public function __construct($serviceName)
    {
        $this->serviceName = $serviceName;
        $message = sprintf('The Oauth Storage service "%s" is not an instance of "\OAuth\Common\Storage\TokenStorageInterface"',
            $this->serviceName);
        parent::__construct($message);
    }

    /**
     * Get the name of the DIC service
     *
     * @return string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }
}
