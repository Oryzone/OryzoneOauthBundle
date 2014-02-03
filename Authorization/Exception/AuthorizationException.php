<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\Authorization\Exception;

use Oryzone\Bundle\OauthBundle\Exception\Exception;

/**
 * Class AuthorizationException
 * @package Oryzone\Bundle\OauthBundle\Authorization\Exception
 *
 * Exception used to report problems during the authorization process
 */
class AuthorizationException extends \Exception implements Exception
{

    /**
     * @var string $error
     */
    protected $error;

    /**
     * @var string $reason
     */
    protected $reason;

    /**
     * @var string $provider
     */
    protected $provider;

    /**
     * @var string $redirect
     */
    protected $redirect;

    /**
     * Constructor
     *
     * @param string     $error
     * @param string     $reason
     * @param string     $provider
     * @param string     $redirect
     * @param string     $message
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct($error, $reason, $provider, $redirect, $message = null, $code = 0, \Exception $previous = null)
    {
        $this->error = $error;
        $this->reason = $reason;
        $this->provider = $provider;
        $this->redirect = $redirect;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the error
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Get the reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Get the provider name
     *
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Get the redirect url
     *
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

}
