<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Concerns;

trait HasName
{
    public string $name = '';

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
