<?php

use Aashan\LivewirePageBuilder\Http\Controllers\PagePreviewController;
use Illuminate\Support\Facades\Route;

Route::get('/_pagebuilder/preview-page/{id}', [PagePreviewController::class, 'preview'])
    ->name('livewire-pagebuilder.page.preview');

Route::get('/_pagebuilder/preview/image/{id}', [PagePreviewController::class, 'previewImage'])
    ->name('livewire-pagebuilder.image.preview');
