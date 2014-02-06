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
 * Interface UserDataExtractorInterface
 * @package Oryzone\Bundle\OauthBundle\UserData
 */
interface UserDataExtractorInterface
{
    /**
     * Get the user data for a given service
     *
     * @param  \OAuth\Common\Service\ServiceInterface $service
     * @return UserDataInterface
     */
    public function getData($service);

}
