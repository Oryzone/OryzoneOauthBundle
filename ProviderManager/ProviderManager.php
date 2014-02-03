<?php

namespace Oryzone\Bundle\OauthBundle\ProviderManager;

use Oryzone\Bundle\OauthBundle\ProviderManager\Exception\UndefinedProviderException;

class ProviderManager implements ProviderManagerInterface
{
    protected $providers;

    public function __construct($providers)
    {
        $this->providers = $providers;
    }

    public function has($provider)
    {
        return isset($this->providers[$provider]);
    }

    public function getType($provider)
    {
        $this->checkExistence($provider);

        return $this->providers[$provider]['type'];
    }

    public function getAppKey($provider)
    {
        $this->checkExistence($provider);

        return $this->providers[$provider]['key'];
    }

    public function getAppSecret($provider)
    {
        $this->checkExistence($provider);

        return $this->providers[$provider]['secret'];
    }

    public function getScopes($provider)
    {
        $this->checkExistence($provider);

        return $this->providers[$provider]['scopes'];
    }

    public function getStorageService($provider)
    {
        $this->checkExistence($provider);

        return $this->providers[$provider]['storageService'];
    }

    private function checkExistence($provider)
    {
        if (!isset($this->providers[$provider])) {
            throw new UndefinedProviderException($provider, array_keys($this->providers));
        }
    }
}
