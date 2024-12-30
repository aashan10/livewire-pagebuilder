<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\Blocks;

use Aashan\LivewirePageBuilder\Blocks\Fields\FieldCollection;
use Aashan\LivewirePageBuilder\Models\Block as BlockModel;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

class Block extends Component implements BlockInterface
{
    public BlockModel $block;
    public bool $editmode = false;

    public function mount(): void
    {
        $data = json_decode($this->block->data, true);

        $fields = static::configure()->toArray();

        foreach ($fields as $field) {
            if (!isset($field['name'])) {
                continue;
            }

            $this->{$field['name']} = $data[$field['name']] ?? '';
        }
    }

    public static function name(): string
    {
        return collect(explode('\\', static::class))->last();
    }

    public static function configure(): FieldCollection
    {
        return FieldCollection::from([
        ]);
    }

    public static function component(): string
    {
        $prefix = config('livewire-pagebuilder.block_path', 'blocks');

        $file = Str::of(self::name())->kebab()->lower()->toString();

        return sprintf('%s.%s', $prefix, $file);
    }

    protected function rules(): array
    {
        $fields = static::configure();

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
        $this->dispatch('block-deleted');
    }

    #[On('page-saved')]
    public function save(): void
    {
        /* $this->authorize('update', $this->block); */

        $fields = static::configure();

        if (!$fields->isEmpty()) {
            $this->validate();
        }

        $data = json_decode($this->block->data, true);

        foreach ($fields as $field) {
            $data[$field->name] = $this->{$field->name};
        }

        $this->block->update(['data' => json_encode($data)]);
    }

    public function duplicate()
    {
        $this->authorize('create', $this->block);

        BlockModel::create([
            'class' => static::class,
            'data' => $this->block->data,
            'page_id' => $this->block->page_id,
            'sort_order' => $this->block->sort_order,
        ]);

        $this->dispatch('update-post');
    }

    public function togglePublished()
    {
        $this->authorize('update', $this->block);

        $this->block->update([
            'published' => !$this->block->published ? 0 : 1,
        ]);

        $this->block = BlockModel::findOrFail($this->block->id);
    }
}
