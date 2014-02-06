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
     * @param  AuthorizationProcedure $procedure
     * @param  Request                $request
     * @return bool                   true if the procedure is going fine, false otherwise
     */
    public function handle(AuthorizationProcedure $procedure, Request $request);

}
