<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Blocks;

use Aashan\LivewirePageBuilder\Blocks\Fields\FieldCollection;

interface BlockInterface
{
    public static function name(): string;

    public static function configure(): FieldCollection;

    public static function component(): string;
}
