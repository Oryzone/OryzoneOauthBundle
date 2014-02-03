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

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Exception\TokenResponseException;
use OAuth\ServiceFactory;

use Oryzone\Bundle\OauthBundle\Authorization\Exception\AuthorizationException;
use Oryzone\Bundle\OauthBundle\ProviderManager\ProviderManagerInterface;
use Oryzone\Bundle\OauthBundle\Storage\StorageFactoryInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class AuthorizationHandler
 * @package Oryzone\Bundle\OauthBundle\Authorization
 *
 * Handles the whole authorization process for both Oauth 1 and 2
 */
class AuthorizationHandler implements AuthorizationHandlerInterface
{
    /**
     * @var \Oryzone\Bundle\OauthBundle\ProviderManager\ProviderManagerInterface $providerManager
     */
    protected $providerManager;

    /**
     * @var \Oryzone\Bundle\OauthBundle\Storage\StorageFactoryInterface $storageFactory
     */
    protected $storageFactory;

    /**
     * @var \Symfony\Component\Routing\RouterInterface $router
     */
    protected $router;

    /**
     * @var string $defaultRedirectPath
     */
    protected $defaultRedirectPath;

    /**
     * Constructor
     *
     * @param ProviderManagerInterface $providerManager
     * @param StorageFactoryInterface  $storageFactory
     * @param RouterInterface          $router
     * @param string                   $defaultRedirectPath
     */
    public function __construct(ProviderManagerInterface $providerManager, StorageFactoryInterface $storageFactory, RouterInterface $router, $defaultRedirectPath)
    {
        $this->providerManager = $providerManager;
        $this->storageFactory = $storageFactory;
        $this->router = $router;
        $this->defaultRedirectPath = $defaultRedirectPath;
    }

    /**
     * {@inheritDoc}
     */
    public function handle(AuthorizationProcedure $authorizationProcedure, Request $request)
    {
        $provider = $authorizationProcedure->getProvider();
        $storage = $this->storageFactory->get($this->providerManager->getStorageService($provider));

        $providerType = $this->providerManager->getType($provider);

        $redirectUrl = $request->query->get('redirect', $this->defaultRedirectPath);
        $callbackRoute = $request->get('_route');
        $callbackRouteParams = array_merge($request->get('_route_params'), array('provider' => $providerType, 'redirect' => $redirectUrl));
        $callBackUrl = $this->router->generate($callbackRoute, $callbackRouteParams, UrlGeneratorInterface::ABSOLUTE_URL);

        $credentials = new Credentials(
            $this->providerManager->getAppKey($provider),
            $this->providerManager->getAppSecret($provider),
            $callBackUrl
        );

        $serviceFactory = new ServiceFactory();

        /**
         * @var \OAuth\OAuth2\Service\ServiceInterface|\OAuth\OAuth1\Service\ServiceInterface $service
         */
        $service = $serviceFactory->createService($providerType, $credentials, $storage, $this->providerManager->getScopes($provider));

        $oauthVersion = $service::OAUTH_VERSION;

        if ($oauthVersion == 1) {
            // OAUTH 1

            if ($request->query->has('denied')) {

                // user refused to give permissions

                $error = 'denied';
                $errorReason = 'denied';
                $message = sprintf('User denied the request token "%s"!', $request->query->get('denied'));
                throw new AuthorizationException($error, $errorReason, $provider, $redirectUrl, $message);

            } elseif ($request->query->has('oauth_token')) {

                // user gave permission

                $requestToken = $storage->retrieveAccessToken(ucfirst($provider));

                try {
                    $accessToken = $service->requestAccessToken(
                        $request->query->get('oauth_token'),
                        $request->query->get('oauth_verifier'),
                        $requestToken->getRequestTokenSecret()
                    );
                } catch (TokenResponseException $e) {
                    $error = 'Cannot parse token';
                    $errorReason = 'TokenResponseException';
                    throw new AuthorizationException($error, $errorReason, $provider, $redirectUrl, $e->getMessage(), $e->getCode(), $e);
                }

                $authorizationProcedure->setAccessToken($accessToken);
                // Access token obtained and stored, can redirect
                $authorizationProcedure->setRedirectUrl($redirectUrl);

            } else {

                // needs to prompt the user to authorize the app

                try {
                    // in oauth1 we need a request token to build the authorization uri for the user
                    $token = $service->requestRequestToken();
                } catch (TokenResponseException $e) {
                    $error = 'Cannot parse request token';
                    $errorReason = 'TokenResponseException';
                    throw new AuthorizationException($error, $errorReason, $provider, $redirectUrl, $e->getMessage(), $e->getCode(), $e);
                }

                $authorizationProcedure->setRedirectUrl($service->getAuthorizationUri(array('oauth_token' => $token->getRequestToken()))->getAbsoluteUri());
            }

        } else {
            // OAUTH 2

            if ($request->query->has('error')) {

                // user refused to give permissions or some other error

                $error = $request->query->get('error');
                $errorReason = $request->query->get('error_reason');
                $message = $request->query->get('error_description');
                $errorCode = $request->query->get('error_code', 500);
                throw new AuthorizationException($error, $errorReason, $provider, $redirectUrl, $message, $errorCode);

            } elseif ($request->query->has('code')) {

                // user gave permission, trying to retrieve the access token
                try {
                    $accessToken = $service->requestAccessToken($request->query->get('code'));
                } catch (TokenResponseException $e) {
                    $error = 'Cannot parse token';
                    $errorReason = 'TokenResponseException';
                    throw new AuthorizationException($error, $errorReason, $provider, $redirectUrl, $e->getMessage(), $e->getCode(), $e);
                }

                $authorizationProcedure->setAccessToken($accessToken);

                // Access token obtained and stored, can redirect
                $authorizationProcedure->setRedirectUrl($redirectUrl);

            } else {

                // needs to prompt the user to authorize the app
                $authorizationProcedure->setRedirectUrl($service->getAuthorizationUri()->getAbsoluteUri());
            }

        }
    }
}
