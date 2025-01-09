<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Layouts;

use Aashan\LivewirePageBuilder\UI\Concerns\HasHeading;
use Aashan\LivewirePageBuilder\UI\Concerns\HasIcon;

class Panel extends Layout
{
    use HasHeading;
    use HasIcon;

    protected $serializable = ['heading', 'icon', 'children'];

    public function component(): string
    {
        return 'livewire-pagebuilder::ui.layouts.panel';
    }
}
