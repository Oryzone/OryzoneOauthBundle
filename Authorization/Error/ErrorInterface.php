<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\Authorization\Error;

/**
 * Interface ErrorInterface
 * @package Oryzone\Bundle\OauthBundle\Authorization\Error
 *
 * Interface used to store error information that may raise during the authorization process
 */
interface ErrorInterface
{
    /**
     * Error type denied
     */
    const TYPE_DENIED = 'denied';

    /**
     * Error type token exception
     */
    const TYPE_TOKEN_EXCEPTION = 'token_exception';

    /**
     * Error type generic
     */
    const TYPE_GENERIC = 'generic';

    /**
     * Get the type of the error
     *
     * @return string
     */
    public function getType();

    /**
     * Get the name of provider
     *
     * @return string
     */
    public function getProvider();

    /**
     * Get a descriptive message for the error
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the target path that should have been reached upon success
     *
     * @return string
     */
    public function getTargetPath();

}
