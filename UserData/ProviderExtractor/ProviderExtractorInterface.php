<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\UserData\ProviderExtractor;

/**
 * Interface ProviderExtractorInterface
 * @package Oryzone\Bundle\OauthBundle\UserData\ProviderExtractor
 */
interface ProviderExtractorInterface
{
    /**
     * @param \OAuth\Common\Service\ServiceInterface $service
     */
    public function setService($service);

    /**
     * @return \Oryzone\Bundle\OauthBundle\UserData\UserDataInterface
     */
    public function getData();

}
