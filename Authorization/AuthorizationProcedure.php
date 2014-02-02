<?php

namespace Oryzone\Bundle\OauthBundle\Authorization;

class AuthorizationProcedure implements AuthorizationProcedureInterface
{
    protected $provider;

    protected $redirectUrl;

    protected $accessToken;

    public function __construct($provider)
    {
        $this->provider = $provider;
    }

    public function getProvider()
    {
        return $this->provider;
    }

    public function mustRedirect()
    {
        return ($this->redirectUrl !== null);
    }

    public function setRedirectUrl($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
    }

    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    public function hasAccessToken()
    {
        return ($this->accessToken !== null);
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

}
