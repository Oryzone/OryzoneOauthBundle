<?php

namespace Oryzone\Bundle\OauthBundle\Storage;

interface StorageFactoryInterface
{

    public function has($key);

    /**
     * @param $key
     * @throws \Oryzone\Bundle\OauthBundle\Storage\Exceptions\InvalidServiceException
     * @throws \Oryzone\Bundle\OauthBundle\Storage\Exceptions\ServiceNotFoundException
     * @throws \Oryzone\Bundle\OauthBundle\Storage\Exceptions\UndefinedKeyException
     * @return \OAuth\Common\Storage\TokenStorageInterface
     */
    public function get($key);

}
