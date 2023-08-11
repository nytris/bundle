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

namespace Nytris\Bundle\Tests\Functional\Boost;

use Nytris\Bundle\Boost\BoostPackage;
use Nytris\Bundle\Package\Initialiser;
use Nytris\Bundle\Tests\Functional\AbstractKernelTestCase;
use Nytris\Bundle\Tests\Functional\Util\TestRealpathCachePool;
use Nytris\Bundle\Tests\Functional\Util\TestStatCachePool;
use Psr\Cache\CacheItemInterface;

/**
 * Class BoostEnablementTest.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class BoostEnablementTest extends AbstractKernelTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        TestRealpathCachePool::stubItem(
            '__my_realpath_cache',
            mock(CacheItemInterface::class, [
                'get' => [],
                'isHit' => true,
                'set' => null,
            ])
        );
        TestStatCachePool::stubItem(
            '__my_stat_cache',
            mock(CacheItemInterface::class, [
                'get' => [],
                'isHit' => true,
                'set' => null,
            ])
        );
    }

    public function tearDown(): void
    {
        parent::tearDown();

        TestRealpathCachePool::resetStubs();
        TestStatCachePool::resetStubs();
    }

    public function testBoostIsInitialisedWhenEnabled(): void
    {
        static::bootKernel(['environment' => 'test']);
        /** @var Initialiser $initialiser */
        $initialiser = static::getContainer()->get(Initialiser::class);

        static::assertCount(1, $initialiser->getRegisteredPackages());
        static::assertInstanceOf(BoostPackage::class, $initialiser->getRegisteredPackages()[0]);
    }

    public function testBoostIsNotInitialisedWhenNotEnabled(): void
    {
        static::bootKernel(['environment' => 'boost_disabled']);
        /** @var Initialiser $initialiser */
        $initialiser = static::getContainer()->get(Initialiser::class);

        static::assertCount(0, $initialiser->getRegisteredPackages());
    }
}
