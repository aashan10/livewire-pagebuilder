<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Concerns;

use Aashan\LivewirePageBuilder\UI\Component;

trait HasChildren
{
    public array $children = [];

    public function add(Component $component): static
    {
        $this->children[] = $component;

        return $this;
    }
}
