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

use Symfony\Component\HttpFoundation\RedirectResponse;

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
     * @var bool $success
     */
    protected $success;

    /**
     * @var null|Error\ErrorInterface $error
     */
    protected $error;

    /**
     * Constructor
     *
     * @param string $provider
     */
    public function __construct($provider)
    {
        $this->provider = $provider;
        $this->success = false;
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
    public function generateRedirectResponse()
    {
        return new RedirectResponse($this->redirectUrl);
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

    /**
     * {@inheritDoc}
     */
    public function succeeded()
    {
        return $this->success;
    }

    /**
     * {@inheritDoc}
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    /**
     * {@inheritDoc}
     */
    public function hasError()
    {
        return ($this->error !== null);
    }

    /**
     * {@inheritDoc}
     */
    public function setError(ErrorInterface $error)
    {
        $this->error = $error;
    }

    /**
     * {@inheritDoc}
     */
    public function getError()
    {
        return $this->error;
    }

}
