<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\Utils;

/**
 * Class StringUtils
 * @package Oryzone\Bundle\OauthBundle\Utils
 */
class StringUtils
{

    /**
     * Extract urls from a string
     *
     * @param string $string
     * @return array
     */
    public static function extractUrls($string)
    {
        preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|(?:[^[:punct:]\s]|/))#', $string, $match);
        return isset($match[0]) ? $match[0] : array();
    }

} 