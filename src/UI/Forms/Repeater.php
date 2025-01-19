<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Forms;

use Aashan\LivewirePageBuilder\UI\Concerns\HasChildren;
use Aashan\LivewirePageBuilder\UI\Concerns\HasDefaultValue;

class Repeater extends Field
{
    use HasChildren;
    use HasDefaultValue;

    public function component(): string
    {
        return 'livewire-pagebuilder::ui.forms.repeater';
    }
}
