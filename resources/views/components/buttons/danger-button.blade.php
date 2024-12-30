<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex gap-2 items-center px-4 py-2 bg-red-600 border border-transparent rounded-3xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    @if (isset($icon))
        @svg($icon, 'h-4 w-4')
    @endif

    {{ $slot }}
</button>
