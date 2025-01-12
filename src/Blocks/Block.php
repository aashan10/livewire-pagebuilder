<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Blocks;

use Aashan\LivewirePageBuilder\Concerns\MountsFields;
use Aashan\LivewirePageBuilder\Models\Block as BlockModel;
use Aashan\LivewirePageBuilder\UI\LayoutDefinition;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

class Block extends Component implements BlockInterface
{
    use MountsFields;
    use WithFileUploads;

    public BlockModel $block;
    public bool $editmode = false;

    public function mount(): void
    {
        $data = json_decode($this->block->data, true);

        $this->mountFrom($data);
    }

    public static function name(): string
    {
        return collect(explode('\\', static::class))->last();
    }

    public static function configure(): LayoutDefinition
    {
        return LayoutDefinition::make([]);
    }

    public static function component(): string
    {
        $prefix = config('livewire-pagebuilder.block_path', 'blocks');

        $file = Str::of(self::name())->kebab()->lower()->toString();

        return sprintf('%s.%s', $prefix, $file);
    }

    protected function rules(): array
    {
        $fields = static::fields();

        $rules = [];

        foreach ($fields as $field) {
            $rules[$field->name] = $field->rules;
        }

        return $rules;
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->block);
        $this->block->delete();
        session()->flash('message', __('Block deleted successfully.'));
        $this->dispatch('block-deleted');
    }

    #[On('page-saved')]
    public function save(): void
    {
        $this->authorize('update', $this->block);

        $fields = static::fields();

        if (!empty($fields)) {
            $this->validate();
        }

        $data = json_decode($this->block->data, true);

        foreach ($fields as $field) {
            $data[$field->name] = $this->{$field->name};
        }

        $this->block->update(['data' => json_encode($data)]);
    }

    public function duplicate(): void
    {
        $this->authorize('create', $this->block);

        BlockModel::create([
            'class' => static::class,
            'data' => $this->block->data,
            'page_id' => $this->block->page_id,
            'sort_order' => $this->block->sort_order,
        ]);

        $this->dispatch('post-updated');
    }

    public function publish(): void
    {
        $this->authorize('update', $this->block);

        $this->block->update([
            'published' => 1,
        ]);

        $this->block = BlockModel::findOrFail($this->block->id);
    }

    public function unpublish(): void
    {
        $this->authorize('update', $this->block);

        $this->block->update([
            'published' => 0,
        ]);

        $this->block = BlockModel::findOrFail($this->block->id);
    }

    public function moveUp(): void
    {
        $this->authorize('update', $this->block);

        $block = BlockModel::where('page_id', $this->block->page_id)
            ->where('sort_order', '<', $this->block->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();

        if ($block) {
            $previousSortOrder = $block->sort_order;
            $sortOrder = $block->sort_order === $this->block->sort_order ? $block->sort_order - 1 : $block->sort_order;

            $this->block->update([
                'sort_order' => $sortOrder,
            ]);
        }

        $this->dispatch('block-updated');
    }

    public function moveDown(): void
    {
        $this->authorize('update', $this->block);

        $block = BlockModel::where('page_id', $this->block->page_id)
            ->where('sort_order', '>', $this->block->sort_order)
            ->orderBy('sort_order', 'asc')
            ->first();

        if ($block) {
            $nextSortOrder = $block->sort_order;
            $sortOrder = $block->sort_order === $this->block->sort_order ? $block->sort_order + 1 : $block->sort_order;

            $this->block->update([
                'sort_order' => $sortOrder,
            ]);
        }

        $this->dispatch('block-updated');
    }
}
