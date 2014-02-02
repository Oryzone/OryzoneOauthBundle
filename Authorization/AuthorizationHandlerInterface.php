<?php

namespace Oryzone\Bundle\OauthBundle\Authorization;

use Symfony\Component\HttpFoundation\Request;

interface AuthorizationHandlerInterface
{

    public function handle(AuthorizationProcedure $authorizationProcedure, Request $request);

}
