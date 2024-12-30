<form wire:submit="save">
    <div class="space-y-6">
        @foreach ($fields as $field)
            <div>
                {{-- Label --}}
                @if (!empty($field->label))
                    <label for="{{ $field->attributes['id'] ?? $field->name }}"
                        class="block text-sm font-medium text-gray-900 dark:text-white">
                        {{ $field->label }}
                    </label>
                @endif

                {{-- Input Field --}}
                @if ($field->type === 'select')
                    <select wire:model="{{ $field->name }}" id="{{ $field->attributes['id'] ?? $field->name }}"
                        name="{{ $field->name }}"
                        class="border-gray-300 w-full dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded shadow-sm
                        @error($field->name) border-red-500 @enderror"
                        @foreach ($field->attributes as $attribute => $value)
                        {{ $attribute }}="{{ $value }}" @endforeach>
                        <option value="">{{ __('-- Select an Option --') }}</option>
                        @foreach ($field->options as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                @elseif ($field->type === 'textarea')
                    <textarea wire:model="{{ $field->name }}" id="{{ $field->attributes['id'] ?? $field->name }}"
                        name="{{ $field->name }}"
                        class="border-gray-300 w-full dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded shadow-sm

                    @error($field->name) border-red-500 @enderror"
                        @foreach ($field->attributes as $attribute => $value)
                        {{ $attribute }}="{{ $value }}" @endforeach></textarea>
                @elseif ($field->type === 'component')
                    <x-dynamic-component :component="$field->component" :field="$field" />
                    {{-- Handle component type fields here --}}
                @else
                    <x-livewire-pagebuilder::fields.input class="w-full mt-1" name="{{ $field->name }}"
                        wire:model="{{ $field->name }}" />
                @endif
                {{-- Error Message --}}
                @error($field->name)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @endforeach

        <x-livewire-pagebuilder::button variant="primary"
            icon="heroicon-o-rectangle-stack">{{ __('Save') }}</x-livewire-pagebuilder::button>
    </div>
</form>
