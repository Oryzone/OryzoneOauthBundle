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

/**
 * Interface ProviderFactoryInterface
 * @package Oryzone\Bundle\OauthBundle\ProviderFactory
 */
interface ProviderFactoryInterface
{

    /**
     * Check if a provider with a given name has been defined
     *
     * @param  string $provider
     * @return bool
     */
    public function has($provider);

    /**
     * Get a given provider
     *
     * @param  string                                 $provider
     * @param  null|string                            $callbackUrl
     * @return \OAuth\Common\Service\ServiceInterface
     */
    public function get($provider, $callbackUrl = null);

    /**
     * @param  string                               $provider
     * @return \OAuth\Common\Token\TokenInterface
     * @throws Exception\UndefinedProviderException
     */
    public function getAccessToken($provider);

}
