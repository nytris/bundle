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

namespace Nytris\Bundle\Tests\Functional\Util;

use BadMethodCallException;
use InvalidArgumentException;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Class TestRealpathCachePool.
 *
 * Cache pool that is solely used during functional testing of the bundle.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class TestRealpathCachePool implements CacheItemPoolInterface
{
    /**
     * @var array<string, CacheItemInterface>
     */
    private static array $itemsByKey = [];

    /**
     * @inheritDoc
     */
    public function clear()
    {
        throw new BadMethodCallException(__METHOD__ . '(): Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function commit()
    {
        throw new BadMethodCallException(__METHOD__ . '(): Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function deleteItem($key)
    {
        throw new BadMethodCallException(__METHOD__ . '(): Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function deleteItems(array $keys)
    {
        throw new BadMethodCallException(__METHOD__ . '(): Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function getItem($key)
    {
        if (!array_key_exists($key, static::$itemsByKey)) {
            throw new InvalidArgumentException(
                __METHOD__ . '(): No stub item defined for key "' . $key . '"'
            );
        }

        return static::$itemsByKey[$key];
    }

    /**
     * @inheritDoc
     */
    public function getItems(array $keys = array())
    {
        throw new BadMethodCallException(__METHOD__ . '(): Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function hasItem($key)
    {
        throw new BadMethodCallException(__METHOD__ . '(): Not implemented');
    }

    /**
     * Clears all stubbed cache items.
     */
    public static function resetStubs(): void
    {
        static::$itemsByKey = [];
    }

    /**
     * @inheritDoc
     */
    public function save(CacheItemInterface $item)
    {
        throw new BadMethodCallException(__METHOD__ . '(): Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function saveDeferred(CacheItemInterface $item)
    {
        return true;
    }

    /**
     * Stubs a cache item.
     */
    public static function stubItem(string $key, CacheItemInterface $item): void
    {
        static::$itemsByKey[$key] = $item;
    }
}
