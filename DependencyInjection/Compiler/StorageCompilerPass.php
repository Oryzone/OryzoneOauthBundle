<?php

namespace Oryzone\Bundle\OauthBundle\DependencyInjection\Compiler;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class StorageCompilerPass implements CompilerPassInterface
{
    const STORAGE_SERVICE_TAG = 'oryzone_oauth_storage';

    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('oryzone_oauth.storage_factory')) {
            $definition = $container->getDefinition('oryzone_oauth.storage_factory');

            $services = array();
            foreach ($container->findTaggedServiceIds(self::STORAGE_SERVICE_TAG) as $id => $attributes) {
                if (!isset($attributes[0]['alias'])) {
                    throw new InvalidConfigurationException(sprintf('Service "%s" needs mandatory "alias" attribute for service tagged as "%s"', $id, self::STORAGE_SERVICE_TAG));
                }
                $services[$attributes[0]['alias']] = $id;
            }

            $definition->replaceArgument(0, $services);
        }
    }
}
