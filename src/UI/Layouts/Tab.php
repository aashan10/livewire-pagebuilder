<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Layouts;

use Aashan\LivewirePageBuilder\UI\Concerns\HasHeading;
use Aashan\LivewirePageBuilder\UI\Concerns\HasIcon;
use Aashan\LivewirePageBuilder\UI\Concerns\HasName;

class Tab extends Layout
{
    use HasHeading;
    use HasIcon;
    use HasName;

    protected $serializable = ['heading', 'icon', 'name', 'children'];

    public function component(): string
    {
        return 'livewire-pagebuilder::ui.layouts.tab';
    }
}
