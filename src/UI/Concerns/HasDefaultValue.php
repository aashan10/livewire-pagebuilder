<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Concerns;

trait HasDefaultValue
{
    public mixed $default = '';

    public function default(mixed $default): static
    {
        $this->default = $default;

        return $this;
    }
}
