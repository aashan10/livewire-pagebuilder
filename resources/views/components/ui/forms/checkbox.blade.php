@props(['ui'])

<div class="flex flex-row gap-2">
    <div class="flex flex-row items-center gap-2">

        <input type="checkbox" id="{{ $ui->id() }}"
            {{ $ui->attributes()->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded shadow-sm']) }}>

        @if ($ui->label)
            <label for="{{ $ui->id() }}"
                class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $ui->label }}</label>
        @endif
    </div>

    @if ($ui->name)
        <x-livewire-pagebuilder::ui.partials.error-messages :name="$ui->name" />
    @endif
</div>
