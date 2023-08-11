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

use Nytris\Bundle\Package\Initialiser;
use Nytris\Bundle\Package\Package\BoostPackage;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\DirectoryLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class NytrisExtension.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class NytrisExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Import common configuration.
        $fileLocator = new FileLocator(__DIR__ . '/../Resources/config');
        $loader = new DirectoryLoader($container, $fileLocator);
        $yamlFileLoader = new YamlFileLoader($container, $fileLocator);
        $loader->setResolver(new LoaderResolver([
            $yamlFileLoader,
            $loader,
        ]));
        $loader->load('services/');

        // Configure Nytris Boost, if enabled.
        $this->configureBoost($container, $loader, $config);
    }

    /**
     * Configures Nytris Boost, if it is enabled.
     */
    private function configureBoost(ContainerBuilder $container, LoaderInterface $loader, array $config): void
    {
        $boostConfig = $config['boost'] ?? null;

        if ($boostConfig === null) {
            // Boost is not configured, therefore it is disabled.
            return;
        }

        $realpathCachePoolServiceId = $boostConfig['realpath_cache_pool_service'] ?? null;
        $realpathCacheKey = $boostConfig['realpath_cache_key'] ?? null;
        $statCachePoolServiceId = $boostConfig['stat_cache_pool_service'] ?? null;
        $statCacheKey = $boostConfig['stat_cache_key'] ?? null;
        $hookBuiltinFunctions = $boostConfig['hook_builtin_functions'] ?? true;

        $loader->load('packages/boost/');

        $packageDefinition = $container->findDefinition(BoostPackage::class);

        if ($realpathCachePoolServiceId !== null) {
            $packageDefinition->setArgument(0, new Reference($realpathCachePoolServiceId));
        }

        if ($statCachePoolServiceId !== null) {
            $packageDefinition->setArgument(1, new Reference($statCachePoolServiceId));
        }

        if ($realpathCacheKey !== null) {
            $packageDefinition->setArgument(2, $realpathCacheKey);
        }

        if ($statCacheKey !== null) {
            $packageDefinition->setArgument(3, $statCacheKey);
        }

        $packageDefinition->setArgument(4, $hookBuiltinFunctions);

        $initialiserDefinition = $container->findDefinition(Initialiser::class);
        $initialiserDefinition->addMethodCall('registerPackage', [new Reference(BoostPackage::class)]);
    }
}
