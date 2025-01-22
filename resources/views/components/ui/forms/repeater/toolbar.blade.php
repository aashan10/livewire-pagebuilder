@props(['field', 'index'])

<div class="flex flex-row gap-2 justify-end">
    <x-livewire-pagebuilder::buttons.danger-button
        wire:click.prevent="removeRepeaterItem('{{ $field->name }}', {{ $index }})"
        class="h-[36px] w-[36px] !px-0 items-center justify-center"
        icon="heroicon-o-trash"></x-livewire-pagebuilder::buttons.danger-button>
</div>
