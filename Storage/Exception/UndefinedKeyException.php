<?php

namespace Oryzone\Bundle\OauthBundle\Storage\Exception;

use Oryzone\Bundle\OauthBundle\DependencyInjection\Compiler\StorageCompilerPass;
use Oryzone\Bundle\OauthBundle\Exception\Exception;

class UndefinedKeyException extends \Exception implements Exception
{
    protected $key;

    protected $definedKeys;

    public function __construct($key, $definedKeys = array())
    {
        $this->key = $key;
        $this->definedKeys = $definedKeys;
        $message = sprintf('There is no service tagged as "%s" with the alias "%s". Available Oauth storages: %s',
            StorageCompilerPass::STORAGE_SERVICE_TAG, $key, json_encode($this->$definedKeys));
        parent::__construct($message);
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getDefinedKeys()
    {
        return $this->definedKeys;
    }

}
