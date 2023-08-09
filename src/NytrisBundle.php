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

namespace Nytris\Bundle;

use Nytris\Bundle\Boost\Initialiser;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class NytrisBundle.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class NytrisBundle extends Bundle
{
    public function boot(): void
    {
        $initialiser = $this->container->get(Initialiser::class);

        $initialiser->initialise();
    }
}
