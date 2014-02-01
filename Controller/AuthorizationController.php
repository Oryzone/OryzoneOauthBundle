<?php

namespace Oryzone\Bundle\OauthBundle\Controller;

use OAuth\Common\Consumer\Credentials;
use OAuth\ServiceFactory;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use Oryzone\Bundle\OauthBundle\Controller\Exception\AuthorizationException;

class AuthorizationController extends Controller
{
    /**
     * @param  string                                                        $provider
     * @param  Request                                                       $request
     * @throws Exception\AuthorizationException                              if the user does not authorize the access
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException if an unexistent provider has been given
     * @return array|RedirectResponse
     */
    public function authorizeAction($provider, Request $request)
    {
        $router = $this->get('router');
        $providerManager = $this->get('oryzone_oauth.provider_manager');

        if (!$providerManager->has($provider)) {
            throw $this->createNotFoundException(sprintf('Invalid oauth provider "%s"', $provider));
        }

        /**
         * @var \OAuth\Common\Storage\TokenStorageInterface $storage
         */
        $storage = $this->get($providerManager->getStorageService($provider));

        $providerType = $providerManager->getType($provider);

        $redirectUrl = $request->query->get('redirect', $this->container->getParameter('oryzone_oauth.redirect.default_path'));
        $callBackUrl = $router->generate('oryzone_oauth_authorize',
            array('provider' => $providerType, 'redirect' => $redirectUrl), UrlGeneratorInterface::ABSOLUTE_URL);

        $credentials = new Credentials(
            $providerManager->getConsumerId($provider),
            $providerManager->getConsumerSecret($provider),
            $callBackUrl
        );

        $serviceFactory = new ServiceFactory();

        /**
         * @var \OAuth\OAuth2\Service\ServiceInterface $service
         */
        $service = $serviceFactory->createService($providerType, $credentials, $storage, $providerManager->getScopes($provider));

        // TODO act according OAuth version than can be read with $service::OAUTH_VERSION;

        if ($request->query->has('error')) {
            $error = $request->query->get('error');
            $errorReason = $request->query->get('error_reason');
            $message = $request->query->get('error_description');
            $errorCode = $request->query->get('error_code', 500);
            throw new AuthorizationException($error, $errorReason, $provider, $redirectUrl, $message, $errorCode);
        } elseif ($request->query->has('code')) {
            $service->requestAccessToken($request->query->get('code'));
            // TODO handle invalid code
            return new RedirectResponse($redirectUrl);
        }

        return new RedirectResponse($service->getAuthorizationUri()->getAbsoluteUri());
    }
}
