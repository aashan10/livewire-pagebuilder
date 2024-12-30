<div class="w-full flex flex-col gap-4">
    <div class="w-full flex bg-white shadow dark:bg-neutral-800 flex-col">
        <div class="max-w-7xl w-full mx-auto px-4 py-4 sm:px-6 lg:px-8 flex flex-row justify-between items-start">
            <div class="">
                <h2 class="text-neutral-900 dark:text-white text-2xl">{{ Str::limit($this->page->title, 50) }}</h2>
            </div>
            <div class="gap-2 flex flex-row justify-end">
                <x-livewire-pagebuilder::button type="link"
                    href="{{ route('livewire-pagebuilder.page.preview', $this->page->id) }}" target="_blank"
                    icon="heroicon-o-arrow-up-right">
                    {{ __('Preview') }}
                </x-livewire-pagebuilder::button>
                <x-livewire-pagebuilder::button wire:click="togglePublishedStatus" icon="heroicon-o-globe-alt">
                    {{ $this->page->published ? __('Unublish') : __('Publish') }}
                </x-livewire-pagebuilder::button>
                <x-livewire-pagebuilder::button wire:click="save" variant="primary" icon="heroicon-o-rectangle-stack">
                    {{ __('Save') }}
                </x-livewire-pagebuilder::button>
            </div>
        </div>
    </div>
    <div class="flex flex-row gap-8 px-8">
        <div class="flex w-1/3 flex-col">
            <div class="w-full flex flex-col rounded-xl p-6 bg-white shadow dark:bg-neutral-800">
                <x-livewire-pagebuilder::block-fields :fields="$this->fields" />
            </div>

        </div>

        <div class="flex w-2/3 flex-col gap-6">

            @foreach ($this->page->blocks as $block)
                <livewire:dynamic-component :is="$block->class::component()" :editmode="true" :fields="$block->class::configure()" :block="$block"
                    :wire:key="$block->page_id . '_' . $block->id" />
            @endforeach
        </div>
    </div>
</div>
