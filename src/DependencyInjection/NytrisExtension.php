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

use Nytris\Bundle\Boost\Initialiser;
use Symfony\Component\Config\FileLocator;
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
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $cachePoolServiceId = $config['boost']['cache_pool_service'];
        $cachePrefix = $config['boost']['cache_prefix'];

        $fileLocator = new FileLocator(__DIR__ . '/../Resources/config');
        $loader = new DirectoryLoader($container, $fileLocator);
        $yamlFileLoader = new YamlFileLoader($container, $fileLocator);
        $loader->setResolver(new LoaderResolver([
            $yamlFileLoader,
            $loader,
        ]));
        $loader->load('services/');

        $definition = $container->findDefinition(Initialiser::class);
        $definition->replaceArgument(0, new Reference($cachePoolServiceId));
        $definition->replaceArgument(1, $cachePrefix);
    }
}
