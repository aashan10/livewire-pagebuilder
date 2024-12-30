<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Blocks\Fields;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * @extends Collection<array-key,mixed>
 */
class FieldCollection extends Collection
{
    public function __construct(array $fields = [])
    {
        parent::__construct($fields);
    }

    public static function from(array $fields): self
    {
        return new self($fields);
    }

    public function toArray(): array
    {
        return Arr::map($this->items, fn ($field) => $field->toArray());
    }
}
