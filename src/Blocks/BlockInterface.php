<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Blocks;

use Aashan\LivewirePageBuilder\UI\LayoutDefinition;

interface BlockInterface
{
    public static function name(): string;

    public static function configure(): LayoutDefinition;

    public static function component(): string;
}
