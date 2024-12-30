@props([
    'variant' => 'secondary', // Default variant
    'type' => 'button', // Default button type
    'icon' => null, // Optional icon
])

@php
    $component = sprintf(
        'livewire-pagebuilder::components.buttons.%s%s-button',
        $variant,
        $type === 'link' ? '-link' : '',
    );
@endphp

@component($component, array_merge(['type' => $type, 'icon' => $icon, 'attributes' => $attributes]))
    {{ $slot }}
@endcomponent
