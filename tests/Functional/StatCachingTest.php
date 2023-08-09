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

namespace Nytris\Bundle\Tests\Functional;

use Asmblah\PhpCodeShift\CodeShift;
use Mockery\MockInterface;
use Nytris\Bundle\Tests\Functional\Util\TestCachePool;
use Psr\Cache\CacheItemInterface;

/**
 * Class StatCachingTest.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class StatCachingTest extends AbstractKernelTestCase
{
    private ?CodeShift $codeShift;
    /**
     * @var (MockInterface&CacheItemInterface)|null
     */
    private $realpathCacheItem;
    /**
     * @var (MockInterface&CacheItemInterface)|null
     */
    private $statCacheItem;

    public function setUp(): void
    {
        parent::setUp();

        $this->realpathCacheItem = mock(CacheItemInterface::class, [
            'get' => [],
            'isHit' => true,
            'set' => null,
        ]);
        $this->statCacheItem = mock(CacheItemInterface::class, [
            'get' => [],
            'isHit' => true,
            'set' => null,
        ]);

        TestCachePool::stubItem(
            '__test_realpath_cache',
            $this->realpathCacheItem
        );
        TestCachePool::stubItem(
            '__test_stat_cache',
            $this->statCacheItem
        );
    }

    public function tearDown(): void
    {
        parent::tearDown();

        TestCachePool::resetStubs();
    }

    public function testStatCacheCanRepointAPathToADifferentInode(): void
    {
        $actualPath = __DIR__ . '/Fixtures/my_actual_file.php';
        $imaginaryPath = __DIR__ . '/Fixtures/my_imaginary_file.php';
        $actualPathStat = stat($actualPath);
        $this->realpathCacheItem->allows()
            ->get()
            ->andReturn([
                $imaginaryPath => [
                    // Unlike the test above, the realpath cache has the imaginary path as the target.
                    'realpath' => $imaginaryPath,
                ]
            ]);
        $this->statCacheItem->allows()
            ->get()
            ->andReturn([
                $imaginaryPath => $actualPathStat,
            ]);
        static::bootKernel();

        static::assertEquals(stat($imaginaryPath), $actualPathStat);
        static::assertTrue(file_exists($imaginaryPath));
        static::assertTrue(is_file($imaginaryPath));
        static::assertFalse(is_dir($imaginaryPath));
    }
}
