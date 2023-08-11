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

namespace Nytris\Bundle\Package;

/**
 * Interface InitialiserInterface.
 *
 * Contains a registry of all enabled Nytris packages and initialises them.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
interface InitialiserInterface
{
    /**
     * Fetches all registered enabled packages.
     */
    public function getRegisteredPackages(): array;

    /**
     * Initialises all registered enabled packages.
     */
    public function initialise(): void;

    /**
     * Registers an enabled package.
     */
    public function registerPackage(PackageInterface $package): void;
}
