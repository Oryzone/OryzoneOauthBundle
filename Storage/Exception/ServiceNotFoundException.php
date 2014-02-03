<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\Storage\Exception;

use Oryzone\Bundle\OauthBundle\Exception\Exception;

/**
 * Class ServiceNotFoundException
 * @package Oryzone\Bundle\OauthBundle\Storage\Exception
 */
class ServiceNotFoundException extends \Exception implements Exception
{

    /**
     * @var string $key
     */
    protected $key;

    /**
     * @var string $serviceName
     */
    protected $serviceName;

    /**
     * Constructor
     *
     * @param string $key         the alias of the storage service
     * @param string $serviceName the associated service name
     */
    public function __construct($key, $serviceName)
    {
        $this->key = $key;
        $this->serviceName = $serviceName;
        $message = sprintf('The Oauth storage service "%s" is mapped to a non-existent service called "%s"', $this->key, $this->serviceName);
        parent::__construct($message);
    }

    /**
     * Get the key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the service name
     *
     * @return string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

}
