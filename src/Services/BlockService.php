<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Services;

use Aashan\LivewirePageBuilder\UI\Component;
use Aashan\LivewirePageBuilder\UI\Forms\Field;
use Aashan\LivewirePageBuilder\UI\Forms\Repeater;
use Aashan\LivewirePageBuilder\UI\LayoutDefinition;
use Aashan\LivewirePageBuilder\UI\Layouts\Layout;

class BlockService
{
    /**
     * @return Field[]
     */
    public static function getDataFields(LayoutDefinition|Component|array $layout): array
    {
        $dataFields = [];

        foreach (self::getFields($layout) as $field) {
            if ($field instanceof Field && !$field instanceof Repeater) {
                $dataFields[] = $field;
            } elseif ($field instanceof Layout) {
                $dataFields = array_merge($dataFields, self::getDataFields($field));
            }
        }

        return $dataFields;
    }

    /**
     * @return Repeater[]
     */
    public static function getRepeatedFields(LayoutDefinition|Component|array $layout): array
    {
        $repeatedFields = [];

        foreach (self::getFields($layout) as $field) {
            if ($field instanceof Repeater) {
                $repeatedFields[] = $field;
            } elseif ($field instanceof Layout) {
                $repeatedFields = array_merge($repeatedFields, self::getRepeatedFields($field));
            }
        }

        return $repeatedFields;
    }

    private static function getFields(LayoutDefinition|Component|array $layout): array
    {
        $fields = [];

        if ($layout instanceof LayoutDefinition) {
            $fields = $layout->toArray();
        } elseif (is_array($layout)) {
            $fields = $layout;
        } else {
            $fields = $layout->children;
        }

        return $fields;
    }
}
