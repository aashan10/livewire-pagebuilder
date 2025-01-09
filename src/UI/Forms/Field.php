<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Forms;

use Aashan\LivewirePageBuilder\UI\Component;
use Aashan\LivewirePageBuilder\UI\Concerns\HasAttributes;
use Aashan\LivewirePageBuilder\UI\Concerns\HasDefaultValue;
use Aashan\LivewirePageBuilder\UI\Concerns\HasName;
use Aashan\LivewirePageBuilder\UI\Concerns\HasRules;

abstract class Field extends Component
{
    use HasName;
    use HasDefaultValue;
    use HasRules;
    use HasAttributes;

    public static function make(string $name): static
    {
        $instance = new static();

        return $instance->name($name);
    }

    abstract public function component(): string;

    public function bind(): static
    {
        return $this->attr('wire:model', $this->name);
    }
}