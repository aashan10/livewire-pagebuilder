<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Concerns;

trait HasLabel
{
    public string $label = '';

    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }
}
