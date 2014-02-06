<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\UserData\ProviderExtractor;

use Oryzone\Bundle\OauthBundle\UserData\UserData;

/**
 * Class Facebook
 * @package Oryzone\Bundle\OauthBundle\UserData\ProviderExtractor
 */
class Facebook extends AbstractProviderExtractor
{

    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        $propertiesMap = array(
            'id'            => 'uniqueId',
            'username'      => 'username',
            'first_name'    => 'firstName',
            'last_name'     => 'lastName',
            'name'          => 'fullName',
            'email'         => 'email',
            'bio'           => 'description',
            'link'          => 'profileUrl'
        );

        $userData = new UserData();
        $raw = json_decode($this->service->request('/me'));

        $this->applyPropertiesMap($userData, $propertiesMap, $raw);

        // location
        if (isset($raw->location) && isset($raw->location->name)) {
            $userData->setLocation($raw->location->name);
            unset($raw->location);
        }

        // profile picture
        $rawPicture = json_decode($this->service->request('/me/picture?type=large&redirect=false'));
        if (isset($rawPicture->data) && isset($rawPicture->data->url)) {
            $userData->setImageUrl($rawPicture->data->url);
        }
        $this->addDataAsExtra($userData, $raw);

        return $userData;
    }

}
