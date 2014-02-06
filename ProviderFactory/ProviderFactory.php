<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\ProviderFactory;

use OAuth\ServiceFactory;
use OAuth\Common\Consumer\Credentials;

use Oryzone\Bundle\OauthBundle\ProviderFactory\Exception\UndefinedProviderException;
use Oryzone\Bundle\OauthBundle\Storage\StorageFactoryInterface;

/**
 * Class ProviderFactory
 * @package Oryzone\Bundle\OauthBundle\ProviderFactory
 */
class ProviderFactory implements ProviderFactoryInterface
{
    /**
     * @var OAuth\ServiceFactory $serviceFactory
     */
    protected $serviceFactory;

    /**
     * @var \Oryzone\Bundle\OauthBundle\Storage\StorageFactoryInterface $storageFactory
     */
    protected $storageFactory;

    /**
     * @var array $providers
     */
    protected $providers;

    /**
     * Constructor
     *
     * @param StorageFactoryInterface $storageFactory
     * @param $defaultTargetPath
     * @param array                   $providers
     */
    public function __construct(ServiceFactory $serviceFactory, StorageFactoryInterface $storageFactory, $providers = array())
    {
        $this->serviceFactory = $serviceFactory;
        $this->storageFactory = $storageFactory;
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
    public function get($provider, $callBackUrl = null)
    {
        if (!$this->has($provider)) {
            throw new UndefinedProviderException($provider, array_keys($this->providers));
        }

        $storage = $this->storageFactory->get($this->providers[$provider]['storageService']);
        $providerType = $this->providers[$provider]['type'];
        $appKey = $this->providers[$provider]['key'];
        $appSecret = $this->providers[$provider]['secret'];
        $scopes = $this->providers[$provider]['scopes'];

        $credentials = new Credentials($appKey, $appSecret, $callBackUrl);
        $service = $this->serviceFactory->createService($providerType, $credentials, $storage, $scopes);

        return $service;
    }
}
