<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\Authorization\ErrorHandler;

use Oryzone\Bundle\OauthBundle\Authorization\Error\ErrorInterface;

/**
 * Interface ErrorHandlerInterface
 * @package Oryzone\Bundle\OauthBundle\Authorization\ErrorHandler
 */
interface ErrorHandlerInterface
{

    /**
     * Handles the error and returns a response
     *
     * @param  ErrorInterface                             $error
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(ErrorInterface $error);

}
