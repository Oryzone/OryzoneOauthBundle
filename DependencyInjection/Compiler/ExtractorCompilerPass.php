<?php

/*
 * This file is part of the OryzoneOauthBundle package <https://github.com/Oryzone/OryzoneOauthBundle>.
 *
 * (c) Oryzone, developed by Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oryzone\Bundle\OauthBundle\DependencyInjection\Compiler;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ExtractorCompilerPass
 * @package Oryzone\Bundle\OauthBundle\DependencyInjection\Compiler
 */
class ExtractorCompilerPass implements CompilerPassInterface
{
    const EXTRACTOR_SERVICE_TAG = 'oryzone_oauth_extractor';

    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('oryzone_oauth.extractor_factory')) {
            $definition = $container->getDefinition('oryzone_oauth.extractor_factory');

            $extractorsMap = array();
            foreach ($container->findTaggedServiceIds(self::EXTRACTOR_SERVICE_TAG) as $id => $attributes) {
                if (!isset($attributes[0]['service'])) {
                    throw new InvalidConfigurationException(sprintf('Service "%s" needs mandatory "service" attribute for services tagged as "%s"', $id, self::EXTRACTOR_SERVICE_TAG));
                }
                $extractorsMap[$attributes[0]['service']] = $id;
            }

            $definition->replaceArgument(1, $extractorsMap);
        }
    }
}
