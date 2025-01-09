<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Forms;

use Aashan\LivewirePageBuilder\UI\Concerns\HasIcon;
use Aashan\LivewirePageBuilder\UI\Concerns\HasLabel;
use Aashan\LivewirePageBuilder\UI\Concerns\HasName;
use Aashan\LivewirePageBuilder\UI\Concerns\HasType;

class Input extends Field
{
    use HasIcon;
    use HasType;
    use HasLabel;
    use HasName;

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
