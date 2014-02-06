<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\UserData\ProviderExtractor;

use Oryzone\Bundle\OauthBundle\UserData\UserDataInterface;

/**
 * Class AbstractProviderExtractor
 * @package Oryzone\Bundle\OauthBundle\UserData\ProviderExtractor
 *
 * Base abstract implementation for a provider extractor
 */
abstract class AbstractProviderExtractor implements ProviderExtractorInterface
{
    /**
     * @var \OAuth\Common\Service\ServiceInterface $service
     */
    protected $service;

    /**
     * @param \OAuth\Common\Service\ServiceInterface $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * Moves data from a raw object to the user data following a given property map
     *
     * @param UserDataInterface $data
     * @param array             $propertyMap
     * @param object            $raw
     */
    protected function applyPropertiesMap(UserDataInterface $data, $propertyMap, $raw)
    {
        foreach ($propertyMap as $original => $standard) {
            if (isset($raw->$original)) {
                $setter = sprintf('set%s', ucfirst($standard));
                $data->$setter($raw->$original);
                unset($raw->$original);
            }
        }
    }

    /**
     * Adds data from an iterable array/object to the user data
     *
     * @param UserDataInterface $data
     * @param array|object      $raw
     */
    protected function addDataAsExtra(UserDataInterface $data, $raw)
    {
        foreach ($raw as $key => $value) {
            $data->addExtra($key, $value);
        }
    }

}
