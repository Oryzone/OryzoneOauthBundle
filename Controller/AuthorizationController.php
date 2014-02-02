<?php

namespace Oryzone\Bundle\OauthBundle\Controller;

use Oryzone\Bundle\OauthBundle\Authorization\AuthorizationProcedure;
use Oryzone\Bundle\OauthBundle\Authorization\Exception\AuthorizationException;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class AuthorizationController extends Controller
{
    /**
     * @param  string                                                        $provider
     * @param  Request                                                       $request
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException if an non-existent provider has been given
     * @return array|RedirectResponse
     */
    public function authorizeAction($provider, Request $request)
    {
        $providerManager = $this->get('oryzone_oauth.provider_manager');

        if (!$providerManager->has($provider)) {
            throw $this->createNotFoundException(sprintf('Invalid oauth provider "%s"', $provider));
        }

        $authorizationHandler = $this->get('oryzone_oauth.authorization_handler');
        $authorizationProcedure = new AuthorizationProcedure($provider);
        try {
            $authorizationHandler->handle($authorizationProcedure, $request);
            if ($authorizationProcedure->mustRedirect()) {
                return new RedirectResponse($authorizationProcedure->getRedirectUrl());
            }
        } catch (AuthorizationException $e) {
            // TODO decide how to handle this kind of exceptions
        }
    }
}
