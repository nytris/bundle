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

namespace Nytris\Bundle\Tests\Functional\Util\Plugin;

use Nytris\Core\Package\PackageInterface;

/**
 * Class TestPackage.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class TestPackage implements PackageInterface
{
    /**
     * @inheritDoc
     */
    public function getPackageFacadeFqcn(): string
    {
        return TestPackageFacade::class;
    }
}
