<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Blocks\Concerns;

use Aashan\LivewirePageBuilder\UI\Forms\Field;
use Aashan\LivewirePageBuilder\UI\Forms\Repeater;
use Aashan\LivewirePageBuilder\UI\LayoutDefinition;
use Aashan\LivewirePageBuilder\UI\Layouts\Layout;

trait MountsFields
{
    use HasRepeatedFields;

    public array $repeaterData = [];

    /**
     * @return Field[]
     */
    public static function fields(): array
    {
        $fields = [];

        foreach (static::configure() as $ui) {
            if ($ui instanceof Layout) {
                $fields = array_merge($fields, self::collectFields($ui));
            } else {
                $fields[] = $ui;
            }
        }

        return $fields;
    }

    /**
     * @return Field[]
     */
    private static function collectFields(Layout $layout): array
    {
        $fields = [];
        foreach ($layout->children as $child) {
            if ($child instanceof Layout) {
                $fields = array_merge($fields, self::collectFields($child));
            } else {
                $fields[] = $child;
            }
        }

        return $fields;
    }

    public function mountFrom(object|array $target): void
    {
        $this->mountNormalFields($target);
        $this->mountRepeatedFields($target);
    }

    protected function mountNormalFields(array|object $target): void
    {
        foreach (static::getNormalFields() as $field) {
            if (is_array($target) && !array_key_exists($field->name, $target)) {
                continue;
            }

            $data = is_array($target) ? $target[$field->name] : $target->{$field->name};

            $this->{$field->name} = $data;
        }
    }

    protected function mountRepeatedFields(array|object $target): void
    {
        foreach (static::repeatedFields() as $repeater) {
            if (
                (is_array($target) && !array_key_exists($repeater->name, $target))
                || (is_object($target) && !property_exists($target, $repeater->name))
            ) {
                $this->repeatedFieldsData[$repeater->name] = [];
                continue;
            }

            if (is_array($target)) {
                $data = $target[$repeater->name];
            } else {
                $data = $target->{$repeater->name};
            }

            $this->repeatedFieldsData[$repeater->name] = is_array($data) ? $data : [];
        }
    }

    protected static function getNormalFields(): array
    {
        return collect(static::fields())->filter(fn (Field $f) => !$f instanceof Repeater)->toArray();
    }

    protected static function getRepeatedField(string $field): ?Field
    {
        return collect(static::repeatedFields())->first(fn (Field $f) => $f->name === $field && $f instanceof Repeater);
    }

    /**
     * @return Repeater[]
     */
    protected static function repeatedFields(): array
    {
        return collect(static::fields())->filter(fn (Field $f) => $f instanceof Repeater)->toArray();
    }

    protected function getDefaultRepeatedFieldValue(string $field): array
    {
        $repeater = static::getRepeatedField($field);

        $data = [];
        foreach ($repeater->children as $field) {
            $data[$field->name] = $field->default;
        }

        return $data;
    }

    abstract public static function configure(): LayoutDefinition;
}
