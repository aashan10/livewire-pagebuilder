<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Layouts;

use Aashan\LivewirePageBuilder\UI\Concerns\HasHeading;
use Aashan\LivewirePageBuilder\UI\Concerns\HasIcon;

class Accordion extends Layout
{
    use HasIcon;
    use HasHeading;

    protected $serializable = ['heading', 'icon', 'children'];

    private bool $open = false;

    public function component(): string
    {
        return 'livewire-pagebuilder::ui.layouts.accordion';
    }

    public function open(): static
    {
        $this->open = true;

        return $this;
    }

    public function opened(): bool
    {
        return $this->open;
    }

    public function close(): static
    {
        $this->open = false;

        return $this;
    }
}
