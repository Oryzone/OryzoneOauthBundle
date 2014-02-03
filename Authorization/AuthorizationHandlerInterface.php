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
