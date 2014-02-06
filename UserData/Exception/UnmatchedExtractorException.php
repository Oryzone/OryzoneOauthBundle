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

use OAuth\Common\Service\ServiceInterface;

use Oryzone\Bundle\OauthBundle\Exception\Exception;

/**
 * Class UnmatchedExtractorException
 * @package Oryzone\Bundle\OauthBundle\UserData\Exception
 */
class UnmatchedExtractorException extends \Exception implements Exception
{
    /**
     * @var \OAuth\Common\Service\ServiceInterface $service
     */
    protected $service;

    /**
     * @var array $registeredExtractors
     */
    protected $registeredExtractors;

    /**
     * Constructor
     *
     * @param \OAuth\Common\Service\ServiceInterface $service
     * @param array                                         $registeredExtractors
     */
    public function __construct(ServiceInterface $service, $registeredExtractors = array())
    {
        $this->service = $service;
        $this->registeredExtractors = $registeredExtractors;
        $message = sprintf('Cannot match an extractor for the service "%s". Registered extractors: %s', get_class($service), json_encode($registeredExtractors));
        parent::__construct($message);
    }

    /**
     * Get the service
     *
     * @return ServiceInterface
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Get registered extractors
     *
     * @return array
     */
    public function getRegisteredExtractors()
    {
        return $this->registeredExtractors;
    }

}
