<form wire:submit="save">
    <div class="space-y-6">

        @foreach ($fields as $field)
            <x-livewire-pagebuilder::ui.component :ui="$field" />
        @endforeach

        <x-livewire-pagebuilder::button variant="primary"
            icon="heroicon-o-rectangle-stack">{{ __('Save') }}</x-livewire-pagebuilder::button>
    </div>
</form>
