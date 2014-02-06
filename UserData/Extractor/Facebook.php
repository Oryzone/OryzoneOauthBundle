<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\UserData\Extractor;

use Oryzone\Bundle\OauthBundle\Utils\ArrayUtils;

/**
 * Class Facebook
 * @package Oryzone\Bundle\OauthBundle\UserData\Extractor
 */
class Facebook extends LazyExtractor
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct($this->getLoadersMap(), $this->getNormalizersMap(), $this->getAllFields());
    }

    protected function getLoadersMap()
    {
        return array_merge($this->getDefaultLoadersMap(), array(
            self::FIELD_IMAGE_URL => 'image',
        ));
    }

    public function getNormalizersMap()
    {
        return array_merge($this->getDefaultNormalizersMap(), array(
            self::FIELD_IMAGE_URL => null,
        ));
    }

    protected function profileLoader()
    {
        return ArrayUtils::objectToArray(json_decode($this->service->request('/me')));
    }

    protected function imageLoader()
    {
        $rawPicture = json_decode($this->service->request('/me/picture?type=large&redirect=false'));
        if (isset($rawPicture->data) && isset($rawPicture->data->url)) {
            return $rawPicture->data->url;
        }

        return null;
    }

    protected function loadProfile()
    {
        return ArrayUtils::objectToArray(json_decode($this->service->request('/me')));
    }

    protected function loadImageUrl()
    {
        $rawPicture = json_decode($this->service->request('/me/picture?type=large&redirect=false'));
        if (isset($rawPicture->data) && isset($rawPicture->data->url)) {
            return $rawPicture->data->url;
        }

        return null;
    }

    protected function uniqueIdNormalizer($data)
    {
        return $data['id'];
    }

    protected function usernameNormalizer($data)
    {
        return $data['username'];
    }

    protected function firstNameNormalizer($data)
    {
        return $data['first_name'];
    }

    protected function lastNameNormalizer($data)
    {
        return $data['last_name'];
    }

    protected function fullNameNormalizer($data)
    {
        return $data['name'];
    }

    protected function emailNormalizer($data)
    {
        return $data['email'];
    }

    protected function descriptionNormalizer($data)
    {
        return $data['bio'];
    }

    protected function profileUrlNormalizer($data)
    {
        return $data['link'];
    }

    protected function locationNormalizer($data)
    {
        return isset($data['location']['name']) ? $data['location']['name'] : null;
    }

    protected function extraNormalizer($data)
    {
        return ArrayUtils::removeKeys($data, array(
            'id',
            'username',
            'first_name',
            'last_name',
            'name',
            'email',
            'bio',
            'link',
            'location'
        ));
    }

}
