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
 * Class DeniedError
 * @package Oryzone\Bundle\OauthBundle\Authorization\Error
 *
 * Error raised when the user denied the authorization process
 */
class DeniedError extends AbstractError
{

    /**
     * Constructor
     *
     * @param string $provider
     * @param string $targetPath
     */
    public function __construct($provider, $targetPath)
    {
        $description = sprintf('User denied access to %s', ucfirst($provider));
        parent::__construct($provider, $description, $targetPath);
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {
        return ErrorInterface::TYPE_DENIED;
    }

}
