<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Blocks\Concerns;

trait HasRepeatedFields
{
    public array $repeatedFieldsData = [];

    protected array $fieldTransformers = [];

    public function getRepeatedFieldData(string $field, mixed $default = null): mixed
    {
        $data = $this->repeatedFieldsData[$field] ?? $default;
        $transformer = $this->getFieldTransformer($field);

        return $transformer($data);
    }

    public function setRepeatedFieldData(string $field, mixed $data): self
    {
        $this->repeatedFieldsData[$field] = $data;

        return $this;
    }

    public function addFieldTransformer(string $field, callable $transformer): self
    {
        $this->fieldTransformers[$field] = $transformer;

        return $this;
    }

    public function getFieldTransformer(string $field): callable
    {
        return $this->fieldTransformers[$field] ?? fn ($data) => $data;
    }
}
