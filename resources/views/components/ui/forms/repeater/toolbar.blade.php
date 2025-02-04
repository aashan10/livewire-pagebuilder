@props(['field', 'index'])

<div class="flex flex-row gap-2 justify-end absolute top-0 invisible group-hover/repeater-item:visible right-0">
    <x-livewire-pagebuilder::buttons.danger-button
        wire:click.prevent="removeRepeaterItem('{{ $field->name }}', {{ $index }})"
        class="h-[30px] w-[30px] !px-0 items-center justify-center"
        icon="heroicon-o-trash"></x-livewire-pagebuilder::buttons.danger-button>
    <x-livewire-pagebuilder::buttons.primary-button
        wire:click.prevent="moveRepeaterItem('{{ $field->name }}', {{ $index }}, 'up')"
        class="h-[30px] w-[30px] !px-0 items-center justify-center"
        icon="heroicon-o-chevron-up"></x-livewire-pagebuilder::buttons.primary-button>

    <x-livewire-pagebuilder::buttons.primary-button
        wire:click.prevent="moveRepeaterItem('{{ $field->name }}', {{ $index }}, 'down')"
        class="h-[30px] w-[30px] !px-0 items-center justify-center"
        icon="heroicon-o-chevron-down"></x-livewire-pagebuilder::buttons.primary-button>
</div>
