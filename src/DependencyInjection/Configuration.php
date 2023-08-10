<?php

/*
 * Nytris Bundle
 * Copyright (c) Dan Phillimore (asmblah)
 * https://github.com/nytris/bundle/
 *
 * Released under the MIT license.
 * https://github.com/nytris/bundle/raw/main/MIT-LICENSE.txt
 */

declare(strict_types=1);

namespace Nytris\Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('nytris');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('boost')
                    ->children()
                        ->scalarNode('realpath_cache_pool_service')->end()
                        ->scalarNode('realpath_cache_key')->end()
                        ->scalarNode('stat_cache_pool_service')->end()
                        ->scalarNode('stat_cache_key')->end()
                        ->booleanNode('hook_builtin_functions')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
