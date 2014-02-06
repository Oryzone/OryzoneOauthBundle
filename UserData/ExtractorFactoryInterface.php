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

/**
 * Interface ExtractorFactoryInterface
 * @package Oryzone\Bundle\OauthBundle\UserData
 */
interface ExtractorFactoryInterface
{
    /**
     * Get the extractor for a given service
     *
     * @param  \OAuth\Common\Service\ServiceInterface $service
     * @throws Exception\InvalidExtractorException    if the retrieved instance is not a valid Extractor (not implement ExtractorInterface)
     * @throws Exception\UnmatchedExtractorException  if can't find an extractor associated to the given service
     * @return Extractor\ExtractorInterface
     */
    public function get($service);

}
