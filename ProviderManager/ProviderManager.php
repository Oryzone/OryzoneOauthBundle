<?php


namespace Oryzone\Bundle\OauthBundle\ProviderManager;


class ProviderManager implements ProviderManagerInterface {

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
        // TODO: check data

        return $this->providers[$provider]['type'];
    }

    public function getConsumerId($provider)
    {
        // TODO: check data

        return $this->providers[$provider]['id'];
    }

    public function getConsumerSecret($provider)
    {
        // TODO: check data

        return $this->providers[$provider]['secret'];
    }

    public function getScopes($provider)
    {
        // TODO: check data

        return $this->providers[$provider]['scopes'];
    }

    public function getStorageService($provider)
    {
        // TODO: check data

        return $this->providers[$provider]['storageService'];
    }
}