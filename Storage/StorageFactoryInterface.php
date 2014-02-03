<?php

namespace Oryzone\Bundle\OauthBundle\Storage;

interface StorageFactoryInterface
{
    /**
     * Check if a storage with a given key is available
     *
     * @param  string $key
     * @return bool
     */
    public function has($key);

    /**
     * @param  string                                                                 $key
     * @throws \Oryzone\Bundle\OauthBundle\Storage\Exception\InvalidServiceException
     * @throws \Oryzone\Bundle\OauthBundle\Storage\Exception\ServiceNotFoundException
     * @throws \Oryzone\Bundle\OauthBundle\Storage\Exception\UndefinedKeyException
     * @return \OAuth\Common\Storage\TokenStorageInterface
     */
    public function get($key);

}
