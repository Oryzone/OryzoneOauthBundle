<?php

namespace Oryzone\Bundle\OauthBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Oryzone\Bundle\OauthBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('oryzone_oauth');
        $rootNode
            ->children()
                ->booleanNode('enabled')->defaultFalse()->end()
            ->end();

        $this->addProvidersConfiguration($rootNode);

        return $treeBuilder;
    }

    private function addProvidersConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->fixXmlConfig('provider')
            ->children()
                ->arrayNode('providers')
                    ->isRequired()
                    ->useAttributeAsKey('name')
                    ->requiresAtLeastOneElement()
                    ->prototype('array')
                        ->children()
                            ->scalarNode('type')->cannotBeEmpty()->end()
                            ->scalarNode('key')->cannotBeEmpty()->end()
                            ->scalarNode('secret')->cannotBeEmpty()->end()
                            ->arrayNode('scopes')
                                ->prototype('scalar')->end()
                            ->end()
                            ->scalarNode('storageService')
                                ->defaultValue('session')
                                ->cannotBeEmpty()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
