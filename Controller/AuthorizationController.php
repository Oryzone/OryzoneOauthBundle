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
     * @param  string                                                        $provider
     * @param  Request                                                       $request
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException if an non-existent provider has been given
     * @return Response
     */
    public function authorizeAction($provider, Request $request)
    {
        $enabled = $this->container->getParameter('oryzone_oauth.enabled');
        if (!$enabled) {
            throw $this->createNotFoundException('Oryzone OAuth Bundle is not enabled');
        }

        $providerManager = $this->get('oryzone_oauth.provider_manager');

        if (!$providerManager->has($provider)) {
            throw $this->createNotFoundException(sprintf('Invalid oauth provider "%s"', $provider));
        }

        $handler = $this->get('oryzone_oauth.authorization_handler');
        $procedure = new AuthorizationProcedure($provider);

        $handler->handle($procedure, $request);
        if ($procedure->hasError()) {
            return $this->handleAuthorizationError($procedure->getError());
        } elseif ($procedure->mustRedirect()) {
            return $procedure->generateRedirectResponse();
        }
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
