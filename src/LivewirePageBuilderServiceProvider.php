<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder;

use Aashan\LivewirePageBuilder\Livewire\Synthesizers\LayoutDefinitionSynthesizer;
use Aashan\LivewirePageBuilder\Models\Block;
use Aashan\LivewirePageBuilder\Models\Page;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
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
        $this->loadRoutesFrom(__DIR__.'/../routes/console.php');
        $this->registerPolicies();
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

        $this->publishes([
            __DIR__.'/../stubs/policies/BlockPolicy.php' => app_path('Policies/BlockPolicy.php'),
            __DIR__.'/../stubs/policies/PagePolicy.php' => app_path('Policies/PagePolicy.php'),
        ], 'livewire-pagebuilder:policies');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

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

        Livewire::propertySynthesizer(LayoutDefinitionSynthesizer::class);
    }

    private function registerPolicies(): void
    {
        $policies = [
            'App\\Policies\\BlockPolicy' => Block::class,
            'App\\Policies\\PagePolicy' => Page::class,
        ];

        foreach ($policies as $policy => $model) {
            if (class_exists($policy)) {
                Gate::policy($policy, $model);
            }
        }
    }
}
