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
 * Interface UserDataInterface
 * @package Oryzone\Bundle\OauthBundle\UserData
 */
interface UserDataInterface
{

    /**
     * Get the unique id of the user
     *
     * @return string
     */
    public function getUniqueId();

    /**
     * Set the unique id of the user
     *
     * @param string $uniqueId
     */
    public function setUniqueId($uniqueId);

    /**
     * Get the username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set the username
     *
     * @param string $username
     */
    public function setUsername($username);

    /**
     * Get the first name
     *
     * @return string
     */
    public function getFirstName();

    /**
     * Set the first name
     *
     * @param string $firstName
     */
    public function setFirstName($firstName);

    /**
     * Get the last name
     *
     * @return string
     */
    public function getLastName();

    /**
     * Set the last name
     *
     * @param string $lastName
     */
    public function setLastName($lastName);

    /**
     * Get the full name
     *
     * @return string
     */
    public function getFullName();

    /**
     * Set the full name
     *
     * @param string $fullName
     */
    public function setFullName($fullName);

    /**
     * Get the email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set the email
     *
     * @param string $email
     */
    public function setEmail($email);

    /**
     * Get the location
     *
     * @return string
     */
    public function getLocation();

    /**
     * Set the location
     *
     * @param string $location
     */
    public function setLocation($location);

    /**
     * Get the description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set the description
     *
     * @param string $description
     */
    public function setDescription($description);

    /**
     * Get the image url
     *
     * @return string
     */
    public function getImageUrl();

    /**
     * Set the image url
     *
     * @param string $imageUrl
     */
    public function setImageUrl($imageUrl);

    /**
     * Get the profile url
     *
     * @return string
     */
    public function getProfileUrl();

    /**
     * Set the profile url
     *
     * @param string $profileUrl
     */
    public function setProfileUrl($profileUrl);

    /**
     * Get the extra attributes
     *
     * @param  string $key
     * @return array
     */
    public function getExtra($key);

    /**
     * Set the extra attributes array
     *
     * @param array $extra
     */
    public function setExtra($extra);

    /**
     * Adds a single extra attribute
     *
     * @param string $key
     * @param mixed  $value
     */
    public function addExtra($key, $value);

}
