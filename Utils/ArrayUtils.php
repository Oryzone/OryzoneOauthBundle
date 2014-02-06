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
 * Class ArrayUtils
 * @package Oryzone\Bundle\OauthBundle\Utils
 */
class ArrayUtils
{

    /**
     * Utility method to convert an object to an array
     *
     * @param  object $object
     * @return array
     */
    public static function objectToArray($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }

        return array_map('self::objectToArray', (array) $object);
    }

    /**
     * Utility method that allow to remove a list of keys from a given array.
     * This method does not modify the passed array but builds a new one.
     *
     * @param  array $array
     * @param  array $keys
     * @return array
     */
    public static function removeKeys($array, $keys)
    {
        $result = $array;
        foreach ($keys as $key) {
            unset($result[$key]);
        }

        return $result;
    }

}
