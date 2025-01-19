<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Http\Controllers;

use Aashan\LivewirePageBuilder\Models\Page;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PagePreviewController
{
    public function preview(string $id): View
    {
        $page = Page::with('publishedBlocks')->findOrFail($id);

        return view('livewire-pagebuilder::pages.preview', ['page' => $page]);
    }

    public function previewImage(string $id): Response
    {
        return response();
    }
}
