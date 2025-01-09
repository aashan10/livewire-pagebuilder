<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Concerns;

use Aashan\LivewirePageBuilder\UI\LayoutDefinition;
use Aashan\LivewirePageBuilder\UI\Layouts\Layout;

trait MountsFields
{
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
        $fields = static::fields();

        foreach ($fields as $field) {
            if (is_array($target) && !array_key_exists($field->name, $target)) {
                continue;
            }

            $this->{$field->name} = is_array($target) ? $target[$field->name] : $target->{$field->name};
        }
    }

    abstract public static function configure(): LayoutDefinition;
}
