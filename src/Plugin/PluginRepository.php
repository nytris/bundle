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

use Nytris\Nytris;

/**
 * Class PluginRepository.
 *
 * Manages the set of installed Nytris Symfony plugins.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class PluginRepository
{
    /**
     * @var PluginInterface[]
     */
    private static array $plugins = [];

    /**
     * Fetches all installed Nytris Symfony plugins.
     *
     * @return PluginInterface[]
     */
    public static function getPlugins(): array
    {
        return self::$plugins;
    }

    /**
     * Installs a Nytris Symfony plugin, which integrates a Nytris package into a Symfony application.
     */
    public static function installPlugin(PluginInterface $plugin): void
    {
        if (!Nytris::hasBooted()) {
            // Nytris was not configured (e.g. missing `nytris.config.php`), nothing to do.
            return;
        }

        $platform = Nytris::getPlatform();

        if (!$platform->isPackageInstalled($plugin->getPackageFqcn())) {
            // The corresponding Nytris package for this Nytris Symfony plugin is not installed, nothing to do.
            return;
        }

        self::$plugins[] = $plugin;
    }
}
