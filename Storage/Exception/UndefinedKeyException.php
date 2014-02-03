<?php

namespace Oryzone\Bundle\OauthBundle\Storage\Exception;

use Oryzone\Bundle\OauthBundle\DependencyInjection\Compiler\StorageCompilerPass;
use Oryzone\Bundle\OauthBundle\Exception\Exception;

/**
 * Class UndefinedKeyException
 * @package Oryzone\Bundle\OauthBundle\Storage\Exception
 */
class UndefinedKeyException extends \Exception implements Exception
{
    /**
     * @var string $key
     */
    protected $key;

    /**
     * @var array $definedKeys
     */
    protected $definedKeys;

    /**
     * Constructor
     *
     * @param string $key
     * @param array  $definedKeys
     */
    public function __construct($key, $definedKeys = array())
    {
        $this->key = $key;
        $this->definedKeys = $definedKeys;
        $message = sprintf('There is no service tagged as "%s" with the alias "%s". Available Oauth storage aliases: %s',
            StorageCompilerPass::STORAGE_SERVICE_TAG, $key, json_encode($this->$definedKeys));
        parent::__construct($message);
    }

    /**
     * Get the key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the defined keys
     *
     * @return array
     */
    public function getDefinedKeys()
    {
        return $this->definedKeys;
    }

}
