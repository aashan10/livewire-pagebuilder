<?php

use Aashan\LivewirePageBuilder\LivewirePageBuilderServiceProvider;
use Illuminate\Support\Facades\Artisan;

Artisan::command('livewire-pagebuilder:install', function () {
    Artisan::call('vendor:publish', [
        '--provider' => LivewirePageBuilderServiceProvider::class,
        '--tag' => 'livewire-pagebuilder:policies',
    ]);

    Artisan::call('vendor:publish', [
        '--provider' => LivewirePageBuilderServiceProvider::class,
        '--tag' => 'livewire-pagebuilder:configs',
    ]);
});
