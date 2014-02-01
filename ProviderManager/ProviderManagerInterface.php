<?php

namespace Oryzone\Bundle\OauthBundle\ProviderManager;

interface ProviderManagerInterface
{
    public function has($provider);

    public function getType($provider);

    public function getConsumerId($provider);

    public function getConsumerSecret($provider);

    public function getScopes($provider);

    public function getStorageService($provider);

}
