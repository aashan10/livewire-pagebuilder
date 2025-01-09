<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Livewire\Synthesizers;

use Aashan\LivewirePageBuilder\UI\Component;
use Aashan\LivewirePageBuilder\UI\LayoutDefinition;
use Illuminate\Support\Arr;
use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class LayoutDefinitionSynthesizer extends Synth
{
    public static $key = 'layoutdefinition';

    public static function match($target)
    {
        return $target instanceof LayoutDefinition;
    }

    public function hydrate(array $value): LayoutDefinition
    {
        return LayoutDefinition::make(Arr::map($value, fn ($field) => Component::from($field)));
    }

    public function dehydrate(LayoutDefinition $target): array
    {
        return [$target->toArray(), []];
    }
}
