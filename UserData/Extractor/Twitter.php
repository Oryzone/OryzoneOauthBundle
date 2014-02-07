<?php

namespace Oryzone\Bundle\OauthBundle\UserData\Extractor;

use Oryzone\Bundle\OauthBundle\Utils\ArrayUtils;

class Twitter extends LazyExtractor
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct($this->getDefaultLoadersMap(), $this->getDefaultNormalizersMap(), $this->getSupportedFields());
    }

    protected function getSupportedFields()
    {
        return array(
            self::FIELD_UNIQUE_ID,
            self::FIELD_USERNAME,
            self::FIELD_FULL_NAME,
            self::FIELD_FIRST_NAME,
            self::FIELD_LAST_NAME,
            self::FIELD_DESCRIPTION,
            self::FIELD_LOCATION,
            self::FIELD_PROFILE_URL,
            self::FIELD_IMAGE_URL,
            self::FIELD_WEBSITES,
            self::FIELD_EXTRA
        );
    }

    protected function profileLoader()
    {
        return ArrayUtils::objectToArray(json_decode($this->service->request('/account/verify_credentials.json')));
    }

    protected function uniqueIdNormalizer($data)
    {
        return $data['id'];
    }

    protected function usernameNormalizer($data)
    {
        return isset($data['screen_name']) ? $data['screen_name'] : null;
    }

    protected function fullNameNormalizer($data)
    {
        return isset($data['name']) ? $data['name'] : null;
    }

    protected function firstNameNormalizer($data)
    {
        $fullName = $this->getField(self::FIELD_FULL_NAME);
        if ($fullName){
            $names = explode(' ', $fullName);
            return $names[0];
        }

        return null;
    }

    protected function lastNameNormalizer($data)
    {
        $fullName = $this->getField(self::FIELD_FULL_NAME);
        if ($fullName){
            $names = explode(' ', $fullName);
            return $names[sizeof($names) - 1];
        }

        return null;
    }

    protected function descriptionNormalizer($data)
    {
        return isset($data['description']) ? $data['description'] : null;
    }

    protected function locationNormalizer($data)
    {
        return isset($data['location']) ? $data['location'] : null;
    }

    protected function imageUrlNormalizer($data)
    {
        return isset($data['profile_image_url']) ? $data['profile_image_url'] : null;
    }

    protected function websitesNormalizer($data)
    {
        $websites = array();
        if (isset($data['entities']['url']['urls'])){
            foreach($data['entities']['url']['urls'] as $urlData){
                $websites[] = $urlData['expanded_url'];
            }
        }

        return $websites;
    }

    protected function extraNormalizer($data)
    {
        return ArrayUtils::removeKeys($data, array(
            'id',
            'screen_name',
            'name',
            'description',
            'location',
            'profile_image_url',
        ));
    }

}
