@props([
    'type' => 'button',
])
<li>
    @php
        $attributes = $attributes->merge([
            'class' =>
                'block w-full text-left px-4 py-2 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-neutral-800 py-2',
        ]);
    @endphp
    @if ($type === 'button')
        <button {{ $attributes }}>
            {{ $slot }}
        </button>
    @else
        <a {{ $attributes }}>
            {{ $slot }}
        </a>
    @endif
</li>
