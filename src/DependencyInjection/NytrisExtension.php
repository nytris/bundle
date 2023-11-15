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

use Symfony\Component\DependencyInjection\ContainerBuilder;
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
     *
     * @param array<mixed> $configs
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
    }
}
