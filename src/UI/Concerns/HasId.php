<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Concerns;

trait HasId
{
    public string $id = '';

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function id(): string
    {
        if (empty($this->id)) {
            $this->id = uniqid();
        }

        return $this->id;
    }
}
