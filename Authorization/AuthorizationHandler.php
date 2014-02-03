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

use Oryzone\Bundle\OauthBundle\Authorization\Error\DeniedError;
use Oryzone\Bundle\OauthBundle\Authorization\Error\GenericError;
use Oryzone\Bundle\OauthBundle\Authorization\Error\TokenExceptionError;
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
     * Redirect path parameter name
     */
    const REDIRECT_PATH_PARAMETER = '_target_path';

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
     * @var string $defaultTargetPath
     */
    protected $defaultTargetPath;

    /**
     * Constructor
     *
     * @param ProviderManagerInterface $providerManager
     * @param StorageFactoryInterface  $storageFactory
     * @param RouterInterface          $router
     * @param string                   $defaultTargetPath
     */
    public function __construct(ProviderManagerInterface $providerManager, StorageFactoryInterface $storageFactory, RouterInterface $router, $defaultTargetPath)
    {
        $this->providerManager = $providerManager;
        $this->storageFactory = $storageFactory;
        $this->router = $router;
        $this->defaultTargetPath = $defaultTargetPath;
    }

    /**
     * {@inheritDoc}
     */
    public function handle(AuthorizationProcedure $procedure, Request $request)
    {
        $provider = $procedure->getProvider();
        $storage = $this->storageFactory->get($this->providerManager->getStorageService($provider));

        $providerType = $this->providerManager->getType($provider);

        $targetPath = $request->query->get(self::REDIRECT_PATH_PARAMETER, $this->defaultTargetPath);
        $callbackRoute = $request->get('_route');
        $callbackRouteParams = array_merge($request->get('_route_params'), array('provider' => $providerType, self::REDIRECT_PATH_PARAMETER => $targetPath));
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
                $error = new DeniedError($provider, $targetPath);
                $procedure->setError($error);

                return false;

            } elseif ($request->query->has('oauth_token')) {

                // user gave permission
                try {
                    $requestToken = $storage->retrieveAccessToken(ucfirst($provider));
                    $accessToken = $service->requestAccessToken(
                        $request->query->get('oauth_token'),
                        $request->query->get('oauth_verifier'),
                        $requestToken->getRequestTokenSecret()
                    );
                } catch (TokenResponseException $e) {
                    $error = new TokenExceptionError($provider, $targetPath, $e);
                    $procedure->setError($error);

                    return false;
                }

                // Access token obtained can store it and redirect
                $procedure->setAccessToken($accessToken);
                $procedure->setRedirectUrl($targetPath);
                $procedure->setSuccess(true);

                return true;

            } else {

                // needs to prompt the user to authorize the app

                try {
                    // in oauth1 we need a request token to build the authorization uri for the user
                    $token = $service->requestRequestToken();
                } catch (TokenResponseException $e) {
                    $error = new TokenExceptionError($provider, $targetPath, $e);
                    $procedure->setError($error);

                    return false;
                }

                $procedure->setRedirectUrl($service->getAuthorizationUri(array('oauth_token' => $token->getRequestToken()))->getAbsoluteUri());
            }

        } else {
            // OAUTH 2

            if ($request->query->has('error')) {

                // user refused to give permissions or some other error
                $errorType = $request->query->get('error');
                if ($errorType == 'access_denied') {
                    $error = new DeniedError($provider, $targetPath);
                } else {
                    $error = new GenericError($provider, $request->query->get('error_description', 'No description for this error'), $targetPath);
                }
                $procedure->setError($error);

                return false;

            } elseif ($request->query->has('code')) {

                // user gave permission, trying to retrieve the access token
                try {
                    $accessToken = $service->requestAccessToken($request->query->get('code'));
                } catch (TokenResponseException $e) {
                    $error = new TokenExceptionError($provider, $targetPath, $e);
                    $procedure->setError($error);

                    return false;
                }

                // Access token obtained, can store it and redirect
                $procedure->setAccessToken($accessToken);
                $procedure->setRedirectUrl($targetPath);
                $procedure->setSuccess(true);

                return true;

            } else {

                // needs to prompt the user to authorize the app
                $procedure->setRedirectUrl($service->getAuthorizationUri()->getAbsoluteUri());
            }

        }

        return true;
    }
}
