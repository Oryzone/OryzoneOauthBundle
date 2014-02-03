<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\Storage;

interface StorageFactoryInterface
{
    /**
     * Check if a storage with a given key is available
     *
     * @param  string $key
     * @return bool
     */
    public function has($key);

    /**
     * @param  string                                                                 $key
     * @throws \Oryzone\Bundle\OauthBundle\Storage\Exception\InvalidServiceException
     * @throws \Oryzone\Bundle\OauthBundle\Storage\Exception\ServiceNotFoundException
     * @throws \Oryzone\Bundle\OauthBundle\Storage\Exception\UndefinedKeyException
     * @return \OAuth\Common\Storage\TokenStorageInterface
     */
    public function get($key);

}
