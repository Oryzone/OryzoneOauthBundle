<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class OryzoneOauthExtension
 * @package Oryzone\Bundle\OauthBundle\DependencyInjection
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

        if ($config['enabled']) {
            $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
            $loader->load('services.xml');

            // set parameter for the provider manager from config
            $providerManagerDefinition = $container->getDefinition('oryzone_oauth.provider_manager');
            $providerManagerDefinition->replaceArgument(0, $config['providers']);
        }
    }
}
