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

namespace Nytris\Bundle\Tests\Functional\Util\Plugin;

use Nytris\Bundle\Plugin\PluginInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class TestPlugin.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class TestPlugin implements PluginInterface
{
    private bool $booted = false;
    private bool $built = false;

    /**
     * @inheritDoc
     */
    public function boot(ContainerInterface $container): void
    {
        $this->booted = true;
    }

    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container): void
    {
        $this->built = true;
    }

    /**
     * @inheritDoc
     */
    public function getPackageFqcn(): string
    {
        return TestPackage::class;
    }

    public function hasBooted(): bool
    {
        return $this->booted;
    }

    public function hasBuilt(): bool
    {
        return $this->built;
    }
}
