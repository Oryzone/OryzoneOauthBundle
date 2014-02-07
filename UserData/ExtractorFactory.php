<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\UserData;

use Symfony\Component\DependencyInjection\ContainerInterface;

use OAuth\Common\Service\ServiceInterface;

use OAuth\UserData\ExtractorFactoryInterface;

use OAuth\UserData\Exception\InvalidExtractorException;
use OAuth\UserData\Exception\UndefinedExtractorException;
use OAuth\UserData\Extractor\ExtractorInterface;

/**
 * Class ExtractorFactory
 * @package Oryzone\Bundle\OauthBundle\UserData
 */
class ExtractorFactory implements ExtractorFactoryInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    protected $container;

    /**
     * @var array $providerExtractorsMap
     */
    protected $extractorsMap;

    /**
     * Constructor
     *
     * @param ContainerInterface $container
     * @param array              $extractorsMap
     */
    public function __construct(ContainerInterface $container, $extractorsMap = array())
    {
        $this->container = $container;
        $this->extractorsMap = $extractorsMap;
    }

    /**
     * {@inheritDoc}
     */
    public function get(ServiceInterface $service)
    {
        return $this->buildExtractor($service);
    }

    /**
     * Adds a given extractor to the extractors map
     *
     * @param string $oAuthServiceFullyQualifiedClassName
     * @param string $extractorServiceName
     */
    public function addExtractor($oAuthServiceFullyQualifiedClassName, $extractorServiceName)
    {
        $this->extractorsMap[$oAuthServiceFullyQualifiedClassName] = $extractorServiceName;
    }

    /**
     * Build the extractor for a given service
     *
     * @param  \OAuth\Common\Service\ServiceInterface $service
     * @throws \OAuth\UserData\Exception\InvalidExtractorException
     * @throws \OAuth\UserData\Exception\UndefinedExtractorException
     * @return \OAuth\UserData\Extractor\ExtractorInterface
     */
    protected function buildExtractor($service)
    {
        $serviceFullyQualifiedClassName = get_class($service);

        if (!isset($this->extractorsMap[$serviceFullyQualifiedClassName])) {
            throw new UndefinedExtractorException($service, array_keys($this->extractorsMap));
        }

        $serviceName = $this->extractorsMap[$serviceFullyQualifiedClassName];
        $extractor = $this->container->get($serviceName);

        if (! $extractor instanceof ExtractorInterface) {
            $extractorClass = get_class($extractor);
            $message = sprintf(
                'The service "%s" (%s) does not implement the interface \OAuth\UserData\Extractor\ExtractorInterface',
                $serviceName, $extractorClass
            );
            throw new InvalidExtractorException($extractorClass, $message);
        }

        $extractor->setService($service);

        return $extractor;
    }

}
