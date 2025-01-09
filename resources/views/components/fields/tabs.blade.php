@php
    $active = array_key_first($field->options['tabs']);
@endphp
<x-livewire-pagebuilder::tabs :active="$active">
    <x-slot:buttons>
        @foreach ($field->options['tabs'] as $id => $tab)
            <x-livewire-pagebuilder::tabs.tab-button :id="$id">{{ $tab['label'] }}
            </x-livewire-pagebuilder::tabs.tab-button>
        @endforeach
    </x-slot>


    @foreach ($field->options['tabs'] as $id => $tab)
        <x-livewire-pagebuilder::tabs.tab :id="$id">
            @foreach ($tab['fields'] as $field)
                <x-livewire-pagebuilder::block.fields :field="$field" />
            @endforeach
        </x-livewire-pagebuilder::tabs.tab>
    @endforeach

</x-livewire-pagebuilder::tabs>
