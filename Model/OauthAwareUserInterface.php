<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\Model;

/**
 * Interface OauthAwareUserInterface
 * @package Oryzone\Bundle\OauthBundle\Model
 */
interface OauthAwareUserInterface
{

    /**
     * Get a collection of oauth connections
     *
     * @return mixed
     */
    public function getOauthConnections();

    /**
     * Check if the user has a given oauth connection
     *
     * @param  string $providerName
     * @return bool
     */
    public function hasOauthConnection($providerName);

    /**
     * Get a given oauth connection
     *
     * @param  string $providerName
     * @return mixed
     */
    public function getOauthConnection($providerName);

}
