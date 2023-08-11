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

namespace Nytris\Bundle\Boost;

use Nytris\Boost\Boost;
use Nytris\Boost\FsCache\FsCacheInterface;
use Nytris\Bundle\Package\PackageInterface;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Class BoostPackage.
 *
 * Initialises the Nytris Boost package.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class BoostPackage implements PackageInterface
{
    public function __construct(
        private readonly ?CacheItemPoolInterface $realpathCachePool,
        private readonly ?CacheItemPoolInterface $statCachePool,
        private readonly string $realpathCacheKey = FsCacheInterface::DEFAULT_REALPATH_CACHE_KEY,
        private readonly string $statCacheKey = FsCacheInterface::DEFAULT_STAT_CACHE_KEY,
        private readonly bool $hookBuiltinFunctions = true
    ) {
    }

    /**
     * @inheritDoc
     */
    public function initialise(): void
    {
        $boost = new Boost(
            realpathCachePool: $this->realpathCachePool,
            statCachePool: $this->statCachePool,
            realpathCacheKey: $this->realpathCacheKey,
            statCacheKey: $this->statCacheKey,
            hookBuiltinFunctions: $this->hookBuiltinFunctions
        );

        $boost->install();
    }
}
