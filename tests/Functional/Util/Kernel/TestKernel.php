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

namespace Nytris\Bundle\Tests\Functional\Util\Kernel;

use Nytris\Bundle\NytrisBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Class TestKernel.
 *
 * Kernel that is solely used for functional testing of the bundle.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class TestKernel extends Kernel
{
    /**
     * @inheritDoc
     */
    public function registerBundles(): iterable
    {
        return [
            new FrameworkBundle(),
            new NytrisBundle(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function getProjectDir(): string
    {
        return __DIR__;
    }

    /**
     * @inheritDoc
     */
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load($this->getProjectDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }

    /**
     * @inheritDoc
     */
    public function getCacheDir(): string
    {
        return realpath(__DIR__ . '/../../../../') . '/var/' . $this->environment . '/cache';
    }

    /**
     * @inheritDoc
     */
    public function getLogDir(): string
    {
        return realpath(__DIR__ . '/../../../../') . '/var/' . $this->environment . '/logs';
    }
}