<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\ProviderManager\Exception;

use Oryzone\Bundle\OauthBundle\Exception\Exception;

/**
 * Class UndefinedProviderException
 * @package Oryzone\Bundle\OauthBundle\ProviderManager\Exception
 *
 * Used to define undefined provider exception
 */
class UndefinedProviderException extends \Exception implements Exception
{

    /**
     * @var string $provider
     */
    protected $provider;

    /**
     * @var array $definedProviders
     */
    protected $definedProviders;

    /**
     * Constructor
     *
     * @param string $provider
     * @param array  $definedProviders
     */
    public function __construct($provider, $definedProviders = array())
    {
        $this->provider = $provider;
        $this->definedProviders = $definedProviders;
        $message = sprintf('Provider "%s" has not been defined. Defined providers: %s',
            $this->provider, json_encode($this->definedProviders));
        parent::__construct($message);
    }

    /**
     * Get the name of the provider
     *
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Get an array of all the defined providers
     *
     * @return array
     */
    public function getDefinedProviders()
    {
        return $this->definedProviders;
    }

}
