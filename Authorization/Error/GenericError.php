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
 * Class GenericError
 * @package Oryzone\Bundle\OauthBundle\Authorization\Error
 */
class GenericError extends AbstractError
{

    /**
     * {@inheritDoc}
     */
    public function getType()
    {
        return ErrorInterface::TYPE_GENERIC;
    }

}
