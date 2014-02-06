<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\Security\Core\User;

/**
 * Interface OAuthAwareUserProviderInterface
 * @package Oryzone\Bundle\OauthBundle\Security\Core\User
 */
interface OauthAwareUserProviderInterface
{
    /**
     * Loads a user from a given oauth response
     *
     * @param  mixed $response
     * @return mixed
     */
    public function loadUserByOAuthUserResponse($response);
}
