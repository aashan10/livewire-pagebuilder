<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Concerns;

trait HasHeading
{
    public string $heading = '';

    public function heading(string $heading): static
    {
        $this->heading = $heading;

        return $this;
    }
}
