<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Livewire\Synthesizers;

use Aashan\LivewirePageBuilder\Blocks\Fields\Field;
use Aashan\LivewirePageBuilder\Blocks\Fields\FieldCollection;
use Illuminate\Support\Arr;
use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class FieldCollectionSynthesizer extends Synth
{
    public static $key = 'fieldcollection';

    public static function match($target)
    {
        return $target instanceof FieldCollection;
    }

    public function hydrate(array $value): FieldCollection
    {
        return FieldCollection::from(Arr::map($value, fn ($field) => Field::from($field)));
    }

    public function dehydrate(FieldCollection $target): array
    {
        return [$target->toArray(), []];
    }
}
