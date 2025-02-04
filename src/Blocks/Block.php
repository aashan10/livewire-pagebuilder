<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Blocks;

use Aashan\LivewirePageBuilder\Blocks\Concerns\HasValidation;
use Aashan\LivewirePageBuilder\Jobs\RenderStaticPage;
use Aashan\LivewirePageBuilder\Models\Block as BlockModel;
use Aashan\LivewirePageBuilder\UI\Forms\Repeater;
use Aashan\LivewirePageBuilder\UI\LayoutDefinition;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

class Block extends Component implements BlockInterface
{
    use Concerns\MountsFields;
    use WithFileUploads;
    use HasValidation;

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

    public function moveRepeaterItem(string $field, string|int $index, string $direction): void
    {
        $repeatedFieldsData = $this->repeatedFieldsData[$field];

        if (!array_key_exists($index, $repeatedFieldsData)) {
            return;
        }

        $item = $repeatedFieldsData[$index];

        if ('up' === $direction) {
            $previousIndex = $index - 1;
            if (!array_key_exists($previousIndex, $repeatedFieldsData)) {
                return;
            }
            $previousItem = $repeatedFieldsData[$index - 1];

            $repeatedFieldsData[$index - 1] = $item;
            $repeatedFieldsData[$index] = $previousItem;
        } else {
            $nextIndex = $index + 1;
            if (!array_key_exists($nextIndex, $repeatedFieldsData)) {
                return;
            }
            $nextItem = $repeatedFieldsData[$index + 1];

            $repeatedFieldsData[$index + 1] = $item;
            $repeatedFieldsData[$index] = $nextItem;
        }

        $this->repeatedFieldsData[$field] = $repeatedFieldsData;
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

        if (!empty($this->rules())) {
            $this->validate();
        }

        $data = json_decode($this->block->data, true);

        foreach ($fields as $field) {
            if ($field instanceof Repeater) {
                $data[$field->name] = $this->repeatedFieldsData[$field->name] ?? [];
            } else {
                $data[$field->name] = $this->{$field->name};
            }
        }

        $this->block->update(['data' => json_encode($data)]);

        dispatch(new RenderStaticPage($this->block->page()->first(), []));
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

    public function addRepeaterItem(string $field): void
    {
        $this->repeatedFieldsData[$field][] = static::getDefaultRepeatedFieldValue($field);
    }

    public function removeRepeaterItem(string $field, int $index): void
    {
        $this->repeatedFieldsData[$field] = array_filter($this->repeatedFieldsData[$field], function ($key) use ($index) {
            return $key !== $index;
        }, ARRAY_FILTER_USE_KEY);
    }
}
