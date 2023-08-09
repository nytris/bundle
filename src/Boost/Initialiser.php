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

use Asmblah\PhpCodeShift\CodeShift;
use Nytris\Boost\Shift\FsCache\FsCacheShiftSpec;
use Nytris\Boost\Shift\FsCache\FsCacheShiftType;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Class Initialiser.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class Initialiser
{
    public function __construct(
        private readonly ?CacheItemPoolInterface $cachePool,
        private readonly string $cachePrefix = '__nytris_boost_'
    ) {
    }

    /**
     * Initialises Nytris Boost.
     */
    public function initialise(): void
    {
        $codeShift = new CodeShift();
        $codeShift->registerShiftType(new FsCacheShiftType());

        $codeShift->shift(
            new FsCacheShiftSpec(
                $codeShift,
                $this->cachePool,
                $this->cachePrefix
            )
        );
    }
}
