<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\Authorization;

use OAuth\Common\Token\TokenInterface;
use Oryzone\Bundle\OauthBundle\Authorization\Error\ErrorInterface;

interface AuthorizationProcedureInterface
{
    /**
     * Get the provider name
     *
     * @return string
     */
    public function getProvider();

    /**
     * Check if it must redirect
     *
     * @return bool
     */
    public function mustRedirect();

    /**
     * Set the redirect url
     *
     * @param string $redirectUrl
     */
    public function setRedirectUrl($redirectUrl);

    /**
     * Get the redirect url
     *
     * @return string
     */
    public function getRedirectUrl();

    /**
     * Generate the redirect response
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function generateRedirectResponse();

    /**
     * Check if it has the access token
     *
     * @return bool
     */
    public function hasAccessToken();

    /**
     * Get the access token
     *
     * @return \OAuth\Common\Token\TokenInterface
     */
    public function getAccessToken();

    /**
     * Set the access token
     *
     * @param \OAuth\Common\Token\TokenInterface $accessToken
     */
    public function setAccessToken(TokenInterface $accessToken);

    /**
     * Check if the authorization succeeded
     *
     * @return bool
     */
    public function succeeded();

    /**
     * Marks the procedure as successful or not
     *
     * @param bool $success
     */
    public function setSuccess($success);

    /**
     * Check if the procedure has some error
     *
     * @return bool
     */
    public function hasError();

    /**
     * Set the error
     *
     * @param ErrorInterface $error
     */
    public function setError(ErrorInterface $error);

    /**
     * Get the error
     *
     * @return ErrorInterface
     */
    public function getError();

}
