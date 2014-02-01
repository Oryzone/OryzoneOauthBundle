<?php

namespace Oryzone\Bundle\OauthBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
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

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
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
                            ->scalarNode('id')->cannotBeEmpty()->end()
                            ->scalarNode('secret')->cannotBeEmpty()->end()
                            ->arrayNode('scopes')
                                ->prototype('scalar')->end()
                            ->end()
                            ->scalarNode('storageService')
                                ->defaultValue('oryzone_oauth.storage')
                                ->cannotBeEmpty()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
