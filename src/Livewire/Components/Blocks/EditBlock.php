<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Livewire\Components\Blocks;

use Aashan\LivewirePageBuilder\Models\Block;
use Illuminate\View\View;
use Livewire\Volt\Component;

class EditBlock extends Component
{
    public Block $block;

    public function render(): View
    {
        return view($this->block->class::component());
    }
}
