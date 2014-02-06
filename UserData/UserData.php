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
 * Class UserData
 * @package Oryzone\Bundle\OauthBundle\UserData
 */
class UserData implements UserDataInterface
{

    /**
     * @var string $uniqueId
     */
    protected $uniqueId;

    /**
     * @var string $username
     */
    protected $username;

    /**
     * @var string firstName
     */
    protected $firstName;

    /**
     * @var string $lastName
     */
    protected $lastName;

    /**
     * @var string $fullName
     */
    protected $fullName;

    /**
     * @var string $email
     */
    protected $email;

    /**
     * @var string $location
     */
    protected $location;

    /**
     * @var string $description
     */
    protected $description;

    /**
     * @var string $imageUrl
     */
    protected $imageUrl;

    /**
     * @var string $profileUrl
     */
    protected $profileUrl;

    /**
     * @var array $extra
     */
    protected $extra;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->extra = array();
    }

    /**
     * {@inheritDoc}
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    /**
     * {@inheritDoc}
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritDoc}
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * {@inheritDoc}
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * {@inheritDoc}
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * {@inheritDoc}
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * {@inheritDoc}
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * {@inheritDoc}
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * {@inheritDoc}
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * {@inheritDoc}
     */
    public function setLocation($location)
    {
        $this->location = $location;
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
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * {@inheritDoc}
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function getProfileUrl()
    {
        return $this->profileUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function setProfileUrl($profileUrl)
    {
        $this->profileUrl = $profileUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function getExtra($key)
    {
        return (isset($this->extra[$key]) ? $this->extra[$key] : null);
    }

    /**
     * {@inheritDoc}
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }

    /**
     * {@inheritDoc}
     */
    public function addExtra($key, $value)
    {
        $this->extra[$key] = $value;
    }

}
