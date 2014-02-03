<?php

namespace Oryzone\Bundle\OauthBundle\Authorization;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface AuthorizationHandlerInterface
 * @package Oryzone\Bundle\OauthBundle\Authorization
 */
interface AuthorizationHandlerInterface
{
    /**
     * Handles a given request
     *
     * @param  AuthorizationProcedure           $authorizationProcedure
     * @param  Request                          $request
     * @throws Exception\AuthorizationException
     */
    public function handle(AuthorizationProcedure $authorizationProcedure, Request $request);

}
