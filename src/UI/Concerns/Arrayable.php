<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Concerns;

trait Arrayable
{
    protected $serializable = [];
    protected $casts = [];

    public function toArray(): array
    {
        $data = [
            'class' => static::class,
        ];

        foreach ($this->serializable as $key) {
            $data[$key] = $this->{$key};
        }

        return $data;
    }

    public static function fromArray(array $data): static
    {
        $class = $data['class'];

        if ($class !== static::class) {
            throw new \Exception("Class `{$class}` does not match the expected class `".static::class.'`');
        }

        $instance = new static();

        foreach ($instance->serializable as $key) {
            $instance->{$key} = $data[$key];
        }

        return $instance;
    }
}
