<?php

namespace Oryzone\Bundle\OauthBundle\Authorization;

use OAuth\Common\Token\TokenInterface;

/**
 * Class AuthorizationProcedure
 * @package Oryzone\Bundle\OauthBundle\Authorization
 *
 * Holds data during the authorization process
 */
class AuthorizationProcedure implements AuthorizationProcedureInterface
{
    /**
     * @var string $provider
     */
    protected $provider;

    /**
     * @var string $redirectUrl
     */
    protected $redirectUrl;

    /**
     * @var \OAuth\Common\Token\TokenInterface $accessToken
     */
    protected $accessToken;

    /**
     * Constructor
     *
     * @param string $provider
     */
    public function __construct($provider)
    {
        $this->provider = $provider;
    }

    /**
     * {@inheritDoc}
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * {@inheritDoc}
     */
    public function mustRedirect()
    {
        return ($this->redirectUrl !== null);
    }

    /**
     * {@inheritDoc}
     */
    public function setRedirectUrl($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function hasAccessToken()
    {
        return ($this->accessToken !== null);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * {@inheritDoc}
     */
    public function setAccessToken(TokenInterface $accessToken)
    {
        $this->accessToken = $accessToken;
    }

}
