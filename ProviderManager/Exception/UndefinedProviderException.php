<?php

namespace Oryzone\Bundle\OauthBundle\ProviderManager\Exception;

use Oryzone\Bundle\OauthBundle\Exception\Exception;

class UndefinedProviderException extends \Exception implements Exception
{

    protected $provider;

    protected $definedProviders;

    public function __construct($provider, $definedProviders = array())
    {
        $this->provider = $provider;
        $this->definedProviders = $definedProviders;
        $message = sprintf('Provider "%s" has not been defined. Defined providers: %s',
            $this->provider, json_encode($this->definedProviders));
        parent::__construct($message);
    }

    public function getProvider()
    {
        return $this->provider;
    }

    public function getDefinedProviders()
    {
        return $this->definedProviders;
    }

}
