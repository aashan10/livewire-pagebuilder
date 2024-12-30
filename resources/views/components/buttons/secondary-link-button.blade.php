<a
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex gap-2 items-center px-4 py-2 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-gray-500 rounded-3xl font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-neutral-50 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    @if (isset($icon))
        @svg($icon, 'h-4 w-4')
    @endif
    {{ $slot }}
</a>
