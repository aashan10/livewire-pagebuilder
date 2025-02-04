<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Blocks\Concerns;

use Aashan\LivewirePageBuilder\Services\BlockService;
use Aashan\LivewirePageBuilder\UI\LayoutDefinition;

trait HasValidation
{
    abstract public static function configure(): LayoutDefinition;

    protected function rules(): array
    {
        $fields = BlockService::getDataFields(static::configure());

        $repeatedFields = BlockService::getRepeatedFields(static::configure());

        $rules = [];

        foreach ($fields as $field) {
            if (empty($field->rules)) {
                continue;
            }
            $rules[$field->name] = $field->rules;
        }

        foreach ($repeatedFields as $field) {
            foreach ($field->children as $f) {
                if (empty($f->rules)) {
                    continue;
                }
                $rules['repeatedFieldsData.'.$field->name.'.*.'.$f->name] = $f->rules;
            }
        }

        return $rules;
    }
}
