<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Layouts;

use Aashan\LivewirePageBuilder\UI\Component;
use Aashan\LivewirePageBuilder\UI\Concerns\HasHeading;

class Tabs extends Layout
{
    use HasHeading;

    public string $active = 'default';

    protected $serializable = ['heading', 'icon', 'name', 'children', 'active'];

    public function component(): string
    {
        return 'livewire-pagebuilder::ui.layouts.tabs';
    }

    public function add(Component|Tab $component): static
    {
        throw new \RuntimeException('Use the tab() method to add tabs.');
    }

    public function tab(string $name, Tab $tab): static
    {
        $this->children[$name] = $tab->name($name);

        if ('default' === $this->active) {
            $this->active = $name;
        }

        return $this;
    }

    public function active(string $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function tabs(): array
    {
        return $this->children;
    }
}
