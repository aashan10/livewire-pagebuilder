<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Concerns;

trait HasHint
{
    public string $hint = '';

    public function hint(string $hint): static
    {
        $this->hint = $hint;

        return $this;
    }
}
