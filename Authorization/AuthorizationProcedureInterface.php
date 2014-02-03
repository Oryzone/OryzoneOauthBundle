<?php

namespace Oryzone\Bundle\OauthBundle\Authorization;

use OAuth\Common\Token\TokenInterface;

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

}
