<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Forms;

class Image extends Field
{
    public function component(): string
    {
        return 'livewire-pagebuilder::ui.forms.image';
    }
}
