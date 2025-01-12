<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Layouts;

class Row extends Layout
{
    protected $serializable = ['children'];

    public function component(): string
    {
        return 'livewire-pagebuilder::ui.layouts.row';
    }
}
