<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\Controller;

use Oryzone\Bundle\OauthBundle\Authorization\AuthorizationProcedure;
use Oryzone\Bundle\OauthBundle\Authorization\Error\ErrorInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AuthorizationController
 * @package Oryzone\Bundle\OauthBundle\Controller
 *
 * Default controller to handle authorization
 */
class AuthorizationController extends Controller
{
    /**
     * @param  string   $provider
     * @param  Request  $request
     * @return Response
     */
    public function authorizeAction($provider, Request $request)
    {
        $this->validateProvider($provider);

        $handler = $this->getAuthorizationHandler();
        $procedure = new AuthorizationProcedure($provider);

        $handler->handle($procedure, $request);
        if ($procedure->hasError()) {
            return $this->handleAuthorizationError($procedure->getError());
        } elseif ($procedure->mustRedirect()) {
            return $procedure->generateRedirectResponse();
        }
    }

    /**
     * @param  string   $provider
     * @param  Request  $request
     * @return Response
     */
    public function connectAccountAction($provider, Request $request)
    {
        $this->validateProvider($provider);

        $handler = $this->getAuthorizationHandler();
        $procedure = new AuthorizationProcedure($provider);

        // TODO verify if the user already have a valid token in the storage and avoid re-authentication
        $token = null;

        $handler->handle($procedure, $request);
        if ($procedure->hasError()) {
            return $this->handleAuthorizationError($procedure->getError());
        } elseif ($procedure->succeeded()) {
            $token = $procedure->getAccessToken();
        } elseif ($procedure->mustRedirect()) {
            return $procedure->generateRedirectResponse();
        }

        if ($token) {
            // TODO 1. verifies if some other uses has this account connected
            // TODO 2. connect the account
        }

    }

    /**
     * Check if the bundle is enabled
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException if the bundle is not enabled
     */
    protected function validateProvider($provider)
    {
        $enabled = $this->container->getParameter('oryzone_oauth.enabled');
        if (!$enabled) {
            throw $this->createNotFoundException('Oryzone OAuth Bundle is not enabled');
        }

        $providerFactory = $this->get('oryzone_oauth.provider_factory');

        if (!$providerFactory->has($provider)) {
            throw $this->createNotFoundException(sprintf('Invalid oauth provider "%s"', $provider));
        }
    }

    /**
     * @return \Oryzone\Bundle\OauthBundle\Authorization\AuthorizationHandler
     */
    protected function getAuthorizationHandler()
    {
        return $this->get('oryzone_oauth.authorization_handler');
    }

    /**
     * @param  ErrorInterface $error
     * @return Response
     */
    protected function handleAuthorizationError(ErrorInterface $error)
    {
        $errorHandler = $this->get('oryzone_oauth.error_handler');

        return $errorHandler->handle($error);
    }
}
