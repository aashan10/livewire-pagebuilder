@props(['ui'])

<div class="flex flex-col gap-2">
    @if ($ui->label)
        <label for="{{ $ui->id() }}"
            class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $ui->label }}</label>
    @endif
    <input id="{{ $ui->id() }}"
        {{ $ui->attributes()->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded shadow-sm']) }}>

    @if ($ui->name)
        @error($ui->name)
            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    @endif
</div>
