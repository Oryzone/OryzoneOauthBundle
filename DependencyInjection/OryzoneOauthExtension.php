<?php

namespace Oryzone\Bundle\OauthBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class OryzoneOauthExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if($config['enabled'])
        {
            $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
            $loader->load('services.xml');

            // set parameter for the symfony session storage
            $symfonySessionStorageDefinition = $container->getDefinition('oryzone_oauth.storage.symfony_session');
            $symfonySessionStorageDefinition->replaceArgument(0, new Reference('session'));

            // set parameter for the provider manager from config
            $providerManagerDefinition = $container->getDefinition('oryzone_oauth.provider_manager');
            $providerManagerDefinition->replaceArgument(0, $config['providers']);
        }
    }
}
