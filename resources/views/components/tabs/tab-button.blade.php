@props(['id'])



@php
    $attributes = $attributes->merge([
        'type' => 'button',
        'class' => 'px-4 py-2 font-medium text-xs rounded-md transition-all duration-200 uppercase tracking-widest',
    ]);
@endphp

<button {{ $attributes }} data-tab="{{ $id }}" x-on:click.prevent="() => setActiveTab($event)"
    :class="{
        'dark:bg-neutral-800 bg-white text-neutral-900 dark:text-white shadow-sm font-bold': activeTab === '{{ $id }}',
        'hover:bg-white dark:hover:bg-neutral-800': activeTab !== '{{ $id }}'
    }">
    {{ $slot }}
</button>
