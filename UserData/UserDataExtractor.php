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

/**
 * Class UserDataExtractor
 * @package Oryzone\Bundle\OauthBundle\UserData
 */
class UserDataExtractor implements UserDataExtractorInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    protected $container;

    /**
     * @var array $providerExtractorsMap
     */
    protected $providerExtractorsMap;

    /**
     * Constructor
     *
     * @param ContainerInterface $container
     * @param array              $providerExtractorsMap
     */
    public function __construct(ContainerInterface $container, $providerExtractorsMap = array())
    {
        $this->container = $container;
        $this->providerExtractorsMap = $providerExtractorsMap;
    }

    /**
     * {@inheritDoc}
     */
    public function getData($service)
    {
        $extractor = $this->buildProviderExtractor($service);

        return $extractor->getData();
    }

    /**
     * Adds a given extractor to the extractors map
     *
     * @param string $oAuthServiceFullyQualifiedClassName
     * @param string $extractorServiceName
     */
    public function addExtractor($oAuthServiceFullyQualifiedClassName, $extractorServiceName)
    {
        $this->providerExtractorsMap[$oAuthServiceFullyQualifiedClassName] = $extractorServiceName;
    }

    /**
     * VBuilds a given provider Extractor
     *
     * @param  string                                       $service
     * @return ProviderExtractor\ProviderExtractorInterface
     */
    protected function buildProviderExtractor($service)
    {
        $serviceFullyQualifiedClassName = get_class($service);

        if (!isset($this->providerExtractorsMap[$serviceFullyQualifiedClassName])) {
            // TODO throw exception
        }

        $extractor = $this->container->get($this->providerExtractorsMap[$serviceFullyQualifiedClassName]);

        // TODO check interface

        $extractor->setService($service);

        return $extractor;
    }

}
