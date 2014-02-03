<?php

namespace Oryzone\Bundle\OauthBundle\ProviderManager;

use Oryzone\Bundle\OauthBundle\ProviderManager\Exception\UndefinedProviderException;

/**
 * Class ProviderManager
 * @package Oryzone\Bundle\OauthBundle\ProviderManager
 */
class ProviderManager implements ProviderManagerInterface
{
    /**
     * @var array $providers
     */
    protected $providers;

    /**
     * Constructor
     *
     * @param array $providers
     */
    public function __construct($providers)
    {
        $this->providers = $providers;
    }

    /**
     * {@inheritDoc}
     */
    public function has($provider)
    {
        return isset($this->providers[$provider]);
    }

    /**
     * {@inheritDoc}
     */
    public function getType($provider)
    {
        $this->checkExistence($provider);

        return $this->providers[$provider]['type'];
    }

    /**
     * {@inheritDoc}
     */
    public function getAppKey($provider)
    {
        $this->checkExistence($provider);

        return $this->providers[$provider]['key'];
    }

    /**
     * {@inheritDoc}
     */
    public function getAppSecret($provider)
    {
        $this->checkExistence($provider);

        return $this->providers[$provider]['secret'];
    }

    /**
     * {@inheritDoc}
     */
    public function getScopes($provider)
    {
        $this->checkExistence($provider);

        return $this->providers[$provider]['scopes'];
    }

    /**
     * {@inheritDoc}
     */
    public function getStorageService($provider)
    {
        $this->checkExistence($provider);

        return $this->providers[$provider]['storageService'];
    }

    /**
     * Check if a given provider has been defined and raises an exception if not
     *
     * @param  string                               $provider
     * @throws Exception\UndefinedProviderException
     */
    private function checkExistence($provider)
    {
        if (!isset($this->providers[$provider])) {
            throw new UndefinedProviderException($provider, array_keys($this->providers));
        }
    }
}
