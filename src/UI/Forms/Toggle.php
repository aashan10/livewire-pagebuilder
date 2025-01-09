<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Forms;

class Toggle extends Checkbox
{
    public function component(): string
    {
        return 'livewire-pagebuilder::components.toggle';
    }
}
