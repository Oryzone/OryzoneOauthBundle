<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\Authorization\Error;

/**
 * Class AbstractError
 * @package Oryzone\Bundle\OauthBundle\Authorization\Error
 */
abstract class AbstractError implements ErrorInterface
{
    /**
     * @var string $provider
     */
    protected $provider;

    /**
     * @var string description
     */
    protected $description;

    /**
     * @var string $targetPath
     */
    protected $targetPath;

    /**
     * Constructor
     *
     * @param string $provider
     * @param string $description
     * @param string $targetPath
     */
    public function __construct($provider, $description, $targetPath)
    {
        $this->provider = $provider;
        $this->description = $description;
        $this->targetPath = $targetPath;
    }

    /**
     * {@inheritDoc}
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritDoc}
     */
    public function getTargetPath()
    {
        return $this->targetPath;
    }

}
