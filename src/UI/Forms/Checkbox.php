<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Forms;

class Checkbox extends Input
{
    protected $serializable = ['label', 'icon', 'attributes', 'type'];

    public function __construct()
    {
        $this->type = 'checkbox';
        $this->default = false;
    }

    public function component(): string
    {
        return 'livewire-pagebuilder::ui.forms.checkbox';
    }
}
