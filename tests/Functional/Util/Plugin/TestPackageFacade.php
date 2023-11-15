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

use Nytris\Core\Package\PackageContextInterface;
use Nytris\Core\Package\PackageFacadeInterface;
use Nytris\Core\Package\PackageInterface;

/**
 * Class TestPackageFacade.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class TestPackageFacade implements PackageFacadeInterface
{
    private static bool $installed = false;

    /**
     * @inheritDoc
     */
    public static function getName(): string
    {
        return 'my_package';
    }

    /**
     * @inheritDoc
     */
    public static function getVendor(): string
    {
        return 'my_vendor';
    }

    public static function install(PackageContextInterface $packageContext, PackageInterface $package): void
    {
        self::$installed = true;
    }

    public static function isInstalled(): bool
    {
        return self::$installed;
    }

    public static function reset(): void
    {
        self::$installed = false;
    }

    public static function uninstall(): void
    {
        self::$installed = false;
    }
}
