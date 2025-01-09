<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Concerns;

use Illuminate\View\ComponentAttributeBag;

trait HasAttributes
{
    protected array $attributes = [];

    public function attr(string $key, string $value): static
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function attributes(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->attributes);
    }
}
