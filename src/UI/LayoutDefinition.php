<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI;

use Illuminate\Support\Collection;

class LayoutDefinition extends Collection
{
    public static function make($fields = []): LayoutDefinition
    {
        return new static($fields);
    }
}
