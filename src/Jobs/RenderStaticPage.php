<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Jobs;

use Aashan\LivewirePageBuilder\Http\Controllers\PagePreviewController;
use Aashan\LivewirePageBuilder\Models\Page;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Str;

class RenderStaticPage implements ShouldQueue
{
    use Queueable;
    use Dispatchable;

    public function __construct(private readonly Page $page, private readonly array $params = [])
    {
    }

    public function handle(): void
    {
        if (!$this->page->published) {
            return;
        }

        $controller = config('livewire-pagebuilder.page_controller', PagePreviewController::class);
        $action = config('livewire-pagebuilder.page_action', 'preview');

        $controller = app()->make($controller);

        /** @var \Illuminate\View\View $view */
        $view = app()->call([$controller, $action], ['id' => $this->page->id]);

        $content = $view->render();

        $filename = Str::slug($this->page->slug).'.html';

        if (!is_dir(public_path('pages'))) {
            mkdir(public_path('pages'));
        }

        $path = public_path('pages/'.$filename);

        file_put_contents($path, $content);
    }
}
