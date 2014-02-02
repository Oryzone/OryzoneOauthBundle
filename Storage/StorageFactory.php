<?php

namespace Oryzone\Bundle\OauthBundle\Storage;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Oryzone\Bundle\OauthBundle\Storage\Exception\InvalidServiceException;
use Oryzone\Bundle\OauthBundle\Storage\Exception\ServiceNotFoundException;
use Oryzone\Bundle\OauthBundle\Storage\Exception\UndefinedKeyException;

class StorageFactory implements StorageFactoryInterface
{
    protected $services;

    protected $container;

    public function __construct($services, ContainerInterface $container)
    {
        $this->services = $services;
        $this->container = $container;
    }

    public function has($key)
    {
        return isset($this->services[$key]) && $this->container->has($this->services[$key]);
    }

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
