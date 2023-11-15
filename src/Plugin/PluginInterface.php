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

namespace Nytris\Bundle\Plugin;

use Nytris\Core\Package\PackageInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Interface PluginInterface.
 *
 * A Nytris plugin integrates a Nytris package with Symfony.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
interface PluginInterface
{
    /**
     * Called when the Symfony kernel is booted.
     */
    public function boot(ContainerInterface $container): void;

    /**
     * Called when the Symfony cache is built.
     */
    public function build(ContainerBuilder $container): void;

    /**
     * Fetches the FQCN of the Nytris package this plugin is for.
     *
     * @return class-string<PackageInterface>
     */
    public function getPackageFqcn(): string;
}
