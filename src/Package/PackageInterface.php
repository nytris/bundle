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
 * Interface PackageInterface.
 *
 * Implemented for each supported Nytris package.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
interface PackageInterface
{
    /**
     * Initialises the package.
     */
    public function initialise(): void;
}
