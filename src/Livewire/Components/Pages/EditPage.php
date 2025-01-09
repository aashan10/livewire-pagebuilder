<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Livewire\Components\Pages;

use Aashan\LivewirePageBuilder\Concerns\MountsFields;
use Aashan\LivewirePageBuilder\Models\Block;
use Aashan\LivewirePageBuilder\Models\Page;
use Aashan\LivewirePageBuilder\UI\Forms\Input;
use Aashan\LivewirePageBuilder\UI\LayoutDefinition;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

class EditPage extends Component
{
    use MountsFields;

    public Page $page;
    public $title = '';
    public $slug = '';

    #[On('add-block')]
    public function addBlock(string $blockClass): void
    {
        $this->authorize('update', $this->page);

        if (!class_exists($blockClass)) {
            throw new \RuntimeException('Unknown block class '.$blockClass);
        }

        $fields = $blockClass::fields();
        $data = [];

        foreach ($fields as $field) {
            $data[$field->name] = $field->default;
        }

        Block::create([
            'page_id' => $this->page->id,
            'class' => $blockClass,
            'sort_order' => 0,
            'data' => json_encode($data),
        ]);
    }

    #[On('block-deleted')]
    #[On('post-updated')]
    #[On('block-updated')]
    public function onChange(): void
    {
        $this->authorize('update', $this->page);

        $this->page = Page::with('blocks')->find($this->page->id);
    }

    public function mount(Page $page): void
    {
        $this->page = Page::with('blocks')->find($page->id);

        $this->mountFrom($this->page);
    }

    public static function configure(): LayoutDefinition
    {
        $layout = LayoutDefinition::make()
            ->add(Input::make('title')->label('Title')->attr('wire:model', 'title'))
            ->add(Input::make('slug')->label('Slug')->attr('wire:model', 'slug'));

        return $layout;
    }

    public function save(): void
    {
        $data = [];
        if (!empty($this->rules())) {
            $this->validate();
        }
        foreach ($this->fields() as $field) {
            $data[$field->name] = $this->{$field->name} ?? $field->default;
        }
        $this->page->update($data);
        $this->dispatch('page-saved');
    }

    public function rules(): array
    {
        $rules = [];
        foreach ($this->fields() as $field) {
            $rules[$field->name] = $field->rules;
        }

        return $rules;
    }

    public function render(): View
    {
        return view('livewire-pagebuilder::pages.edit');
    }

    public function publish(): void
    {
        $this->authorize('update', $this->page);

        $this->page->published = true;

        $this->page->save();
    }

    public function unpublish(): void
    {
        $this->authorize('update', $this->page);

        $this->page->published = false;

        $this->page->save();
    }
}
