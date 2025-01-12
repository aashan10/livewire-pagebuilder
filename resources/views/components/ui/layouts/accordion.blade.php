@props(['ui'])

<?php

use Aashan\LivewirePageBuilder\UI\Layouts\Accordion;

/** @var Accordion $ui **/

?>

<div class="w-full" x-data="{ open: {{ $ui->opened() ? 'true' : 'false' }} }">

    <div x-on:click="open = !open" :aria-expanded="open" aria-role="button"
        class="w-full cursor-pointer flex flex-row gap-2 items-center text-neutral-900 dark:text-white">

        <div class="w-full flex flex-row gap-2 items-center">
            @if ($ui->icon)
                @svg($ui->icon, 'w-6 h-6')
            @endif

            <span class="">{{ $ui->heading }}</span>
        </div>

        @svg('heroicon-o-chevron-right', 'w-6 h-6', ['x-show' => '!open'])
        @svg('heroicon-o-chevron-down', 'w-6 h-6', ['x-show' => 'open'])
    </div>


    <div x-transition x-show="open" class="w-full flex flex-col gap-4 mt-4">
        @foreach ($ui->children as $child)
            <x-dynamic-component :component="$child->component()" :ui="$child" />
        @endforeach
    </div>
</div>
