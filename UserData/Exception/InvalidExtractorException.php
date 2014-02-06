<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\UserData\Exception;

use Oryzone\Bundle\OauthBundle\Exception\Exception;

/**
 * Class InvalidExtractorException
 * @package Oryzone\Bundle\OauthBundle\UserData\Exception
 */
class InvalidExtractorException extends \Exception implements Exception
{
    /**
     * @var string $serviceName
     */
    protected $serviceName;

    /**
     * Constructor
     *
     * @param string $serviceName
     */
    public function __construct($serviceName)
    {
        $this->serviceName = $serviceName;
        $message = sprintf('The service "%s" is not associated to an object implementing Oryzone\Bundle\OauthBundle\UserData\Extractor\ExtractorInterface', $serviceName);
        parent::__construct($message);
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
