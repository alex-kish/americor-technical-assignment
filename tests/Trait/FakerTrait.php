<?php

declare(strict_types=1);

namespace Trait;

use Faker\Factory;
use Faker\Generator;

trait FakerTrait
{
    public function getFaker(): Generator
    {
        return Factory::create();
    }
}
