<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Concerns;

trait HasIcon
{
    public string $icon = '';

    public function icon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }
}
