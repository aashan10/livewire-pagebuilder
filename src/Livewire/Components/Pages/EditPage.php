<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Livewire\Components\Pages;

use Aashan\LivewirePageBuilder\Blocks\Fields\Field;
use Aashan\LivewirePageBuilder\Blocks\Fields\FieldCollection;
use Aashan\LivewirePageBuilder\Models\Block;
use Aashan\LivewirePageBuilder\Models\Page;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

class EditPage extends Component
{
    public Page $page;
    public FieldCollection $fields;
    public $title = '';
    public $slug = '';

    public function addBlock(string $blockClass): void
    {
        $this->authorize('update', $this->page);

        if (!class_exists($blockClass)) {
            throw new \RuntimeException('Unknown block class '.$blockClass);
        }

        $fields = $blockClass::configure();

        Block::create([
            'page_id' => $this->page->id,
            'class' => $blockClass,
            'sort_order' => 0,
            'data' => json_encode(Arr::mapWithKeys(fn ($key, $field) => $field->default, $fields)),
        ]);
    }

    #[On('block-deleted')]
    #[On('update-post')]
    public function onChange(): void
    {
        $this->page = Page::with('blocks')->find($this->page->id);
    }

    public function mount(Page $page)
    {
        $this->page = Page::with('blocks')->find($page->id);

        $this->fields = self::configure();

        foreach ($this->fields as $field) {
            $this->{$field->name} = $this->page->{$field->name};
        }
    }

    public static function configure(): FieldCollection
    {
        return FieldCollection::from([
            Field::make('text')->name('title')->label('Title')->rules('required'),
            Field::make('text')->name('slug')->label('Slug')->rules('required'),
        ]);
    }

    public function save()
    {
        $this->dispatch('page-saved');
    }

    public function render(): View
    {
        return view('livewire-pagebuilder::pages.edit');
    }
}
