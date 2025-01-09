<div x-data="{ isOpen: false }" class="relative">
    <!-- Dropdown Trigger -->
    <x-livewire-pagebuilder::button variant="primary" @click="isOpen = !isOpen" @keydown.escape.window="isOpen = false"
        aria-haspopup="true">
        @if ($icon)
            @svg($icon, 'h-4 w-4')
        @endif

        {{ $attributes['title'] }}
        @svg('heroicon-o-chevron-down', 'h-4 w-4')
    </x-livewire-pagebuilder::button>

    <!-- Dropdown Menu -->
    <div x-show="isOpen" x-cloak @click.away="isOpen = false" @keydown.escape.window="isOpen = false"
        class="absolute right-0 mt-2 w-48 bg-white dark:bg-neutral-900 z-50 text-neutral-900 dark:text-white rounded shadow-lg"
        role="menu" aria-label="Dropdown">
        <ul>
            {{ $slot }}
        </ul>
    </div>
</div>
