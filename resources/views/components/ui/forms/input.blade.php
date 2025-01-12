@props(['ui'])

<div class="w-full">
    @if ($ui->label)
        <label for="{{ $ui->id() }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $ui->label }}
        </label>
    @endif

    <div class="relative">
        <input id="{{ $ui->id() }}" type="{{ $ui->type ?? 'text' }}"
            wire:model="{{ $ui->attributes()->get('wire:model') }}"
            {{ $ui->attributes()->merge([
                'class' =>
                    'block w-full rounded-md border-0 py-1.5 px-3
                                                              bg-white dark:bg-neutral-900
                                                              text-neutral-900 dark:text-neutral-100
                                                              ring-1 ring-inset ' .
                    ($errors->has($ui->attributes()->get('wire:model'))
                        ? 'ring-red-500 dark:ring-red-500 focus:ring-red-500 dark:focus:ring-red-500'
                        : 'ring-neutral-200 dark:ring-neutral-700 focus:ring-neutral-500 dark:focus:ring-neutral-400') .
                    '
                                                              placeholder:text-neutral-400 dark:placeholder:text-neutral-500
                                                              focus:ring-2 focus:ring-inset
                                                              text-sm leading-6',
            ]) }}>

        @error($ui->attributes()->get('wire:model'))
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        @enderror
    </div>

    @error($ui->attributes()->get('wire:model'))
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror

    @if ($ui->hint && !$errors->has($ui->attributes()->get('wire:model')))
        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">{{ $ui->hint }}</p>
    @endif
</div>
