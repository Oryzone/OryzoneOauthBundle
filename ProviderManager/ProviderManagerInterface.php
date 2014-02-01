<?php

namespace Oryzone\Bundle\OauthBundle\ProviderManager;

interface ProviderManagerInterface
{
    public function has($provider);

    public function getType($provider);

    public function getAppKey($provider);

    public function getAppSecret($provider);

    public function getScopes($provider);

    public function getStorageService($provider);

}
