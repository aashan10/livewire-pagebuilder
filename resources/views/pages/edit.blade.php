<div class="w-full flex flex-col gap-4">

    <div class="w-full flex bg-white shadow dark:bg-neutral-800 flex-col">
        <div class="max-w-7xl w-full mx-auto px-4 py-4 sm:px-6 lg:px-8 flex flex-row justify-between items-start">
            <div class="">
                <h2 class="text-neutral-900 dark:text-white text-2xl">{{ Str::limit($this->page->title, 50) }}</h2>
            </div>
            <div class="gap-2 flex flex-row justify-end">
                <x-livewire-pagebuilder::button wire:click="$dispatch('open-modal', 'page-meta-info-modal')"
                    icon="heroicon-o-exclamation-circle">
                    {{ __('Meta Info') }}
                </x-livewire-pagebuilder::button>
                <x-livewire-pagebuilder::button type="link"
                    href="{{ route('livewire-pagebuilder.page.preview', $this->page->id) }}" target="_blank"
                    icon="heroicon-o-arrow-up-right">
                    {{ __('Preview') }}
                </x-livewire-pagebuilder::button>
                <x-livewire-pagebuilder::button :wire:click="$this->page->published ? 'unpublish' : 'publish'"
                    :icon="$this->page->published ? 'heroicon-o-eye-slash' : 'heroicon-o-eye'">
                    {{ $this->page->published ? __('Unublish') : __('Publish') }}
                </x-livewire-pagebuilder::button>

                <x-livewire-pagebuilder::button :title="__('Add Block')" icon="heroicon-o-plus" variant="dropdown">
                    @forelse (config('livewire-pagebuilder.blocks') as $name => $block)
                        <x-livewire-pagebuilder::dropdown.link :key="$name"
                            wire:click="addBlock('{{ str_replace('\\', '\\\\', $block) }}')">
                            {{ $block::name() }}
                        </x-livewire-pagebuilder::dropdown.link>
                    @empty

                        <x-livewire-pagebuilder::dropdown.link>
                            {{ __('There are no registered blocks. Please check your configuration') }}
                        </x-livewire-pagebuilder::dropdown.link>
                    @endforelse
                </x-livewire-pagebuilder::button>
            </div>
        </div>
    </div>
    <div class="flex flex-row gap-8 px-8">
        <div class="flex w-1/4 flex-col">
            <div class="w-full flex flex-col rounded-xl p-6 gap-6 bg-white shadow dark:bg-neutral-800">
                <x-livewire-pagebuilder::block-fields :fields="$this->configure()" />
            </div>

        </div>

        <div class="flex w-3/4 flex-col gap-6">
            <x-livewire-pagebuilder::modal name="page-meta-info-modal">
                <div class="p-6">
                    <table class="table-fixed w-full text-neutral-900 dark:text-white">
                        <thead>
                            <tr>
                                <th class="text-left">{{ __('Key') }}</th>
                                <th class="text-left">{{ __('Value') }}</th>
                            </tr>
                        </thead>
                        @php
                            $rows = [
                                __('ID') => $this->page->id,
                                __('Title') => $this->page->title,
                                __('Created At') => $this->page->created_at,
                                __('Updated At') => $this->page->updated_at,
                                __('Published') => $this->page->published ? __('Yes') : __('No'),
                            ];
                        @endphp
                        <tbody>
                            @foreach ($rows as $key => $row)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $row }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-livewire-pagebuilder::modal>

            @foreach ($this->page->blocks as $block)
                @if (!class_exists($block->class))
                    @continue
                @endif

                <livewire:dynamic-component :is="$block->class::component()" :editmode="true" :fields="$block->class::configure()" :block="$block"
                    :wire:key="$block->page_id . '_' . $block->id" />
            @endforeach
        </div>
    </div>
</div>
