<?php

namespace Oryzone\Bundle\OauthBundle\ProviderManager;

interface ProviderManagerInterface
{
    /**
     * Check if a provider with a given name has been defined
     *
     * @param  string $provider the name of the provider
     * @return bool
     */
    public function has($provider);

    /**
     * Get the type of a given provider
     *
     * @param  string                               $provider
     * @throws Exception\UndefinedProviderException
     * @return string
     */
    public function getType($provider);

    /**
     * Get the application key (consumer key) of a given provider
     *
     * @param  string                               $provider
     * @throws Exception\UndefinedProviderException
     * @return string
     */
    public function getAppKey($provider);

    /**
     * Get the application secret (consumer secret) of a given provider
     *
     * @param  string                               $provider
     * @throws Exception\UndefinedProviderException
     * @return string
     */
    public function getAppSecret($provider);

    /**
     * Get the scopes defined for a given provider
     *
     * @param  string                               $provider
     * @throws Exception\UndefinedProviderException
     * @return array
     */
    public function getScopes($provider);

    /**
     * Get the name of the storage type to use to store the token for a given provider
     *
     * @param  string                               $provider
     * @throws Exception\UndefinedProviderException
     * @return string
     */
    public function getStorageService($provider);

}
