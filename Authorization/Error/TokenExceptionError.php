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

use OAuth\Common\Http\Exception\TokenResponseException;

/**
 * Class TokenExceptionError
 * @package Oryzone\Bundle\OauthBundle\Authorization\Error
 */
class TokenExceptionError extends AbstractError
{
    /**
     * @var TokenResponseException $exception
     */
    protected $exception;

    /**
     * Constructor
     *
     * @param string                 $provider
     * @param string                 $targetPath
     * @param TokenResponseException $exception
     */
    public function __construct($provider, $targetPath, TokenResponseException $exception)
    {
        $this->exception = $exception;
        $description = 'Cannot retrieve or parse the auth token';
        parent::__construct($provider, $description, $targetPath);
    }

    /**
     * Get the related exception
     *
     * @return TokenResponseException
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {
        return ErrorInterface::TYPE_TOKEN_EXCEPTION;
    }

}
