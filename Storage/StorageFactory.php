<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\Storage;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Oryzone\Bundle\OauthBundle\Storage\Exception\InvalidServiceException;
use Oryzone\Bundle\OauthBundle\Storage\Exception\ServiceNotFoundException;
use Oryzone\Bundle\OauthBundle\Storage\Exception\UndefinedKeyException;

/**
 * Class StorageFactory
 * @package Oryzone\Bundle\OauthBundle\Storage
 *
 * Instantiates a storage
 */
class StorageFactory implements StorageFactoryInterface
{
    /**
     * @var array $services
     */
    protected $services;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    protected $container;

    /**
     * Constructor
     *
     * @param array              $services
     * @param ContainerInterface $container
     */
    public function __construct($services, ContainerInterface $container)
    {
        $this->services = $services;
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function has($key)
    {
        return isset($this->services[$key]) && $this->container->has($this->services[$key]);
    }

    /**
     * {@inheritDoc}
     */
    public function get($key)
    {
        if (!isset($this->services[$key])) {
            throw new UndefinedKeyException($key, array_keys($this->services));
        }

        $serviceName = $this->services[$key];

        if (!$this->container->has($serviceName)) {
           throw new ServiceNotFoundException($key, $serviceName);
        }

        $service = $this->container->get($serviceName);

        if (! $service instanceof \OAuth\Common\Storage\TokenStorageInterface) {
            throw new InvalidServiceException($serviceName);
        }

        return $service;
    }
}
