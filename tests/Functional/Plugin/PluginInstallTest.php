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

namespace Nytris\Bundle\Tests\Functional\Plugin;

use Nytris\Boot\BootConfig;
use Nytris\Boot\PlatformConfig;
use Nytris\Bundle\Plugin\PluginRepository;
use Nytris\Bundle\Tests\Functional\AbstractKernelTestCase;
use Nytris\Bundle\Tests\Functional\Util\Plugin\TestPackage;
use Nytris\Bundle\Tests\Functional\Util\Plugin\TestPackageFacade;
use Nytris\Bundle\Tests\Functional\Util\Plugin\TestPlugin;
use Nytris\Nytris;

/**
 * Class PluginInstallTest.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class PluginInstallTest extends AbstractKernelTestCase
{
    public function setUp(): void
    {
        Nytris::initialise();
    }

    public function tearDown(): void
    {
        parent::tearDown();

        Nytris::uninitialise();
        TestPackageFacade::reset();
    }

    public function testPluginIsBootedWhenPackageInstalled(): void
    {
        $platformConfig = new PlatformConfig(dirname(__DIR__) . '/Fixtures/nytris');
        $bootConfig = new BootConfig($platformConfig);
        $bootConfig->installPackage(new TestPackage());
        Nytris::boot($bootConfig);
        $plugin = new TestPlugin();
        PluginRepository::installPlugin($plugin);

        static::bootKernel(['environment' => 'test']);

        static::assertTrue($plugin->hasBooted());
    }

    public function testPluginIsNotBootedWhenPackageIsNotInstalled(): void
    {
        $platformConfig = new PlatformConfig(dirname(__DIR__) . '/Fixtures/nytris');
        $bootConfig = new BootConfig($platformConfig);
        Nytris::boot($bootConfig);
        $plugin = new TestPlugin();
        PluginRepository::installPlugin($plugin);

        static::bootKernel(['environment' => 'test']);

        static::assertFalse($plugin->hasBooted());
    }
}
