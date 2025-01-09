<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI;

use Aashan\LivewirePageBuilder\UI\Concerns\Arrayable;
use Aashan\LivewirePageBuilder\UI\Concerns\HasId;

abstract class Component
{
    use Arrayable;
    use HasId;

    public string $name = '';

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    abstract public function component(): string;

    public static function from(array $field): static
    {
        if (!isset($field['class'])) {
            throw new \Exception('`class` key is missing');
        }

        $class = $field['class'];

        if (!class_exists($class)) {
            throw new \Exception("Class `{$class}` does not exist");
        }

        if (!is_subclass_of($class, Component::class)) {
            throw new \Exception("Class `{$class}` is not a subclass of `Component`");
        }

        return $class::fromArray($field);
    }
}
