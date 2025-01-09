<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Layouts;

use Aashan\LivewirePageBuilder\UI\Component;
use Aashan\LivewirePageBuilder\UI\Concerns\Arrayable;
use Aashan\LivewirePageBuilder\UI\Concerns\HasChildren;

abstract class Layout extends Component
{
    use HasChildren;
    use Arrayable { fromArray as fromArrayWithoutChildren; }

    public static function make(): static
    {
        return new static();
    }

    public function fields(): array
    {
        return $this->extractFieldsFromLayout($this);
    }

    private function extractFieldsFromLayout(Layout $layout): array
    {
        $fields = [];
        foreach ($this->children as $child) {
            if ($child instanceof Layout) {
                $fields = array_merge($fields, $this->extractFieldsFromLayout($child));
            } else {
                $fields[] = $child;
            }
        }

        return $fields;
    }

    public static function fromArray(array $data): static
    {
        $instance = static::fromArrayWithoutChildren($data);

        $instance->children = array_map(fn ($child) => Component::from($child), $data['children']);

        return $instance;
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'children' => array_map(fn ($child) => $child->toArray(), $this->children),
        ]);
    }
}
