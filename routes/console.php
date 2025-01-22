<?php

use Aashan\LivewirePageBuilder\Jobs\RenderStaticPage;
use Aashan\LivewirePageBuilder\LivewirePageBuilderServiceProvider;
use Aashan\LivewirePageBuilder\Models\Page;
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

Artisan::command('livewire-pagebuilder:static-pages:generate', function () {
    $pages = Page::where('published', true)->get();

    $pages->each(function (Page $page) {
        dispatch(new RenderStaticPage($page));

        $this->info("Page {$page->title} has been queued for rendering.");
    });

    $this->info('All pages have been queued for rendering.');
    $this->info('Please run `php artisan queue:work` to start rendering the pages.');
});
