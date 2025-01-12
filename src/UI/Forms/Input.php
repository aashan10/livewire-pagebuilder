<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Forms;

use Aashan\LivewirePageBuilder\UI\Concerns\HasIcon;
use Aashan\LivewirePageBuilder\UI\Concerns\HasType;

class Input extends Field
{
    use HasIcon;
    use HasType;

    protected $serializable = ['label', 'icon', 'attributes', 'type'];

    public function __construct()
    {
        $this->type = 'text';
    }

    public function component(): string
    {
        return 'livewire-pagebuilder::ui.forms.input';
    }
}
