@props(['ui'])

<div class="w-full flex flex-col gap-4">
    @if ($ui->label)
    @endif

    <div class="flex flex-row justify-between items-center">

        <h3 class="text-neutral-900 dark:text-white">{{ $ui->label }}</h3>
        <x-livewire-pagebuilder::buttons.primary-button wire:click.prevent="addRepeaterItem('{{ $ui->name }}')"
            icon="heroicon-o-plus"
            class="h-[36px] w-[36px] !px-0 items-center justify-center"></x-livewire-pagebuilder::buttons.primary-button>
    </div>


    @foreach ($this->getRepeatedFieldData($ui->name, []) as $index => $repeaterData)
        <div class="flex flex-row gap-4 relative group/repeater-item pt-6">

            <div class="w-full flex flex-col">
                @foreach ($ui->children as $field)
                    @php
                        $field->attr(
                            'wire:model',
                            'repeatedFieldsData.' . $ui->name . '.' . $index . '.' . $field->name,
                        );
                    @endphp

                    <x-dynamic-component :component="$field->component()" :ui="$field" />
                @endforeach
            </div>

            <x-livewire-pagebuilder::ui.forms.repeater.toolbar :index="$index" :field="$ui" />
        </div>
    @endforeach
</div>
