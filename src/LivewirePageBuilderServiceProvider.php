<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder;

use Aashan\LivewirePageBuilder\Livewire\Synthesizers\FieldCollectionSynthesizer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewirePageBuilderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadPublishables();
        $this->registerViewComponents();
        $this->registerLivewireComponents();
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/livewire-pagebuilder.php', 'livewire-pagebuilder');
    }

    private function registerViewComponents(): void
    {
        Blade::componentNamespace('Aashan\\LivewirePageBuilder\\View\\Components', 'livewire-pagebuilder');
    }

    private function loadPublishables(): void
    {
        $this->publishes([
            __DIR__.'/../config/livewire-pagebuilder.php' => config_path('livewire-pagebuilder.php'),
        ], 'livewire-pagebuilder:configs');

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'livewire-pagebuilder:migrations');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-pagebuilder');
    }

    private function registerLivewireComponents(): void
    {
        Livewire::discover(
            'livewire-pagebuilder',
            'Aashan\\LivewirePageBuilder\\Livewire\\Components'
        );

        Livewire::propertySynthesizer(FieldCollectionSynthesizer::class);
    }
}
