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
 * Class Initialiser.
 *
 * Contains a registry of all enabled Nytris packages and initialises them.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class Initialiser implements InitialiserInterface
{
    /**
     * @var PackageInterface[]
     */
    private array $packages = [];

    /**
     * @inheritDoc
     */
    public function getRegisteredPackages(): array
    {
        return $this->packages;
    }

    /**
     * @inheritDoc
     */
    public function initialise(): void
    {
        foreach ($this->packages as $package) {
            $package->initialise();
        }
    }

    /**
     * @inheritDoc
     */
    public function registerPackage(PackageInterface $package): void
    {
        $this->packages[] = $package;
    }
}
