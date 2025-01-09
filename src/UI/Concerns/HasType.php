<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Concerns;

trait HasType
{
    public string $type;

    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
