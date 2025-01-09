<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Forms;

use Aashan\LivewirePageBuilder\UI\Concerns\HasLabel;
use Aashan\LivewirePageBuilder\UI\Forms\Fields\Field;

class Select extends Field
{
    use HasLabel;

    public array $options = [];

    protected $serializable = ['label', 'icon', 'attributes', 'options'];

    /**
     * @param array<int|string,string> $options
     */
    public function options(array $options): Select
    {
        $this->options = $options;

        return $this;
    }

    public function option(string $value, string $label): static
    {
        $this->options[$value] = $label;

        return $this;
    }

    public function component(): string
    {
        return 'livewire-pagebuilder::ui.forms.select';
    }
}
