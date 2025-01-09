<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Contracts;

interface Configurable
{
    public static function configure(): iterable;
}
