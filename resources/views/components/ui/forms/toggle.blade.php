@props(['ui'])

<div class="flex flex-col -mb-[10px]">
    <div class="flex items-center justify-between space-x-2"
        @if ($ui->attributes()->has('wire:model')) x-data="{ isOn: $wire.$entangle('{{ $ui->attributes()->get('wire:model') }}') }"
    @else
        x-data="{ isOn: false }" @endif>
        @if ($ui->label)
            <label for="{{ $ui->id() }}" class="text-sm flex flex-1 font-medium text-gray-700 dark:text-gray-300">
                {{ $ui->label }}
            </label>
        @endif

        {{-- Hidden checkbox for form submission --}}
        <input type="checkbox" id="{{ $ui->id() }}" wire:model="{{ $ui->attributes()->get('wire:model') }}"
            {{ $ui->attributes()->merge(['class' => 'sr-only']) }}>

        {{-- Toggle button --}}
        <button type="button" aria-labelledby="{{ $ui->id() }}-label"
            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2
               border-transparent transition-colors duration-200 ease-in-out focus:outline-none
               focus:ring-2 focus:ring-neutral-500 dark:focus:ring-neutral-400 focus:ring-offset-2
               focus:ring-offset-white dark:focus:ring-offset-neutral-800"
            :class="{ 'bg-neutral-900 dark:bg-neutral-200': isOn, 'bg-neutral-200 dark:bg-neutral-700': !isOn }"
            role="switch" :aria-checked="isOn" @click="isOn = !isOn" @keydown.space.prevent="isOn = !isOn">
            <span
                class="pointer-events-none inline-block h-5 w-5 transform rounded-full shadow ring-0
                   transition duration-200 ease-in-out"
                :class="{
                    'translate-x-5 bg-white dark:bg-neutral-900': isOn,
                    'translate-x-0 bg-white dark:bg-neutral-900': !isOn
                }"
                aria-hidden="true"></span>
        </button>
    </div>
    @error($ui->name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
