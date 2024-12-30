<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Blocks\Fields;

class Field
{
    public function __construct(
        public string $type = 'text',
        public string $name = '',
        public string $label = '',
        public mixed $value = null,
        public ?string $component = null,
        public ?string $default = null,
        public array $options = [],
        public array $attributes = [],
        public array $rules = [],
    ) {
    }

    public function default(?string $default = null): self
    {
        $this->default = $default;

        return $this;
    }

    public static function make(string $type = 'text'): self
    {
        return new self($type);
    }

    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function value(mixed $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function attr(string $key, mixed $value): self
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function attrs(array $attributes): self
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    public function component(string $component): self
    {
        $this->component = $component;

        return $this;
    }

    public function rules(array|string $rules): self
    {
        if (is_string($rules)) {
            $rules = explode('|', $rules);
        }
        $this->rules = $rules;

        return $this;
    }

    public function rule(string $rule): self
    {
        if (!in_array($rule, $this->rules, true)) {
            $this->rules[] = $rule;
        }

        return $this;
    }

    public function options(array $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'name' => $this->name,
            'label' => $this->label,
            'value' => $this->value,
            'component' => $this->component,
            'default' => $this->default,
            'options' => $this->options,
            'attributes' => $this->attributes,
            'rules' => $this->rules,
        ];
    }

    public static function from(array $data): self
    {
        return new self(
            $data['type'] ?? 'text',
            $data['name'] ?? '',
            $data['label'] ?? '',
            $data['value'] ?? null,
            $data['component'] ?? null,
            $data['default'] ?? null,
            $data['options'] ?? [],
            $data['attributes'] ?? [],
            $data['rules'] ?? [],
        );
    }
}
