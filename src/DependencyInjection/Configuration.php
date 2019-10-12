<?php


namespace MonologCloudWatch\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('monolog_cloud_watch');
        $root = method_exists(TreeBuilder::class, 'getRootNode') ? $treeBuilder->getRootNode() : $treeBuilder->root('monolog_cloud_watch');

        $root
            ->addDefaultsIfNotSet()
            ->children()
                ->booleanNode('enabled')->defaultTrue()->end()
                ->scalarNode('region')->defaultValue('eu-west-1')->cannotBeEmpty()->end()
                ->scalarNode('version')->defaultValue('latest')->cannotBeEmpty()->end()
                ->arrayNode('credentials')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('access_key')->defaultNull()->cannotBeEmpty()->end()
                        ->scalarNode('secret_key')->defaultNull()->cannotBeEmpty()->end()
                    ->end()
                ->end()
                ->arrayNode('handler')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('group_name')->defaultNull()->cannotBeEmpty()->end()
                        ->scalarNode('stream_name')->defaultNull()->cannotBeEmpty()->end()
                        ->integerNode('retention_days')->defaultValue(14)->end()
                        ->integerNode('batch_size')->defaultValue(10000)->end()
                        ->arrayNode('tags')
                            ->scalarPrototype()->end()
                        ->end()
                        ->scalarNode('log_level')->defaultValue('warning')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}