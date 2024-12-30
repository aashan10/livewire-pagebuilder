@props([
    'editmode' => false,
])


<section id="block_{{ $this->block->page_id }}_{{ $this->block->id }}">
    @if ($this->editmode)

        @php
            $fields = $this->configure();
        @endphp
        <div class="w-full group bg-white dark:bg-neutral-800 rounded-xl shadow" x-data="{ show: false }">
            <div class="flex justify-between items-center p-4">
                <!-- Name -->
                <div class="flex flex-row gap-2 items-center">
                    <button x-on:click.prevent="show = !show" class="flex font-bold flex-row items-center gap-2">
                        @svg('heroicon-s-chevron-down', 'h-4 w-4 fill-neutral-900 dark:fill-white', ['x-show' => '!show'])
                        @svg('heroicon-s-chevron-up', 'h-4 w-4 fill-neutral-900 dark:fill-white', ['x-show' => 'show'])
                        <span class="text-neutral-900 dark:text-white">{{ $this->name() }}</span>
                    </button>
                </div>
                <!-- Toolbar -->
                <div class="flex space-x-2 min-h-[38px]">

                    @if (isset($buttons) && !$buttons->isEmpty())
                        {{ $buttons }}
                    @endif

                    <x-livewire-pagebuilder::button
                        title="{{ $this->block->published ? __('Unpublish') : __('Publish') }}"
                        wire:click="togglePublished"
                        class="hidden group-hover:flex items-center justify-center flex-row h-8 px-0 py-0 w-8"
                        :icon="$this->block->published ? 'heroicon-o-eye-shash' : 'heroicon-o-eye'">

                    </x-livewire-pagebuilder::button>
                    @if (!$fields->isEmpty())
                        <x-modal class="rounded-xl" focusable name="edit-block-{{ $this->block->id }}">
                            <div class="flex flex-col gap-6 p-6">
                                <div class="flex text-neutral-900 dark:text-white flex-row justify-between">
                                    <h2 class="text-xl font-bold">{{ __('Configure ') . $this->name() }}</h2>
                                    <div>
                                        {{ __('ID') }}: {{ $this->block->id }}
                                    </div>
                                </div>
                                <x-livewire-pagebuilder::block-fields :fields="$fields" />
                            </div>
                        </x-modal>

                        <x-livewire-pagebuilder::button title="{{ __('Configurations') }}"
                            wire:click="$dispatch('open-modal', 'edit-block-{{ $this->block->id }}')"
                            class="hidden group-hover:flex items-center justify-center flex-row h-8 px-0 py-0 w-8"
                            icon="heroicon-o-cog">

                        </x-livewire-pagebuilder::button>
                    @endif

                    <x-livewire-pagebuilder::button title="{{ __('Duplicate') }}" wire:click="duplicate"
                        class="hidden group-hover:flex items-center justify-center flex-row h-8 px-0 py-0 w-8"
                        icon="heroicon-o-square-2-stack">

                    </x-livewire-pagebuilder::button>
                    <x-livewire-pagebuilder::button title="{{ __('Move up') }}" wire:click="moveUp"
                        class="hidden group-hover:flex items-center justify-center flex-row h-8 px-0 py-0 w-8"
                        icon="heroicon-o-arrow-up">

                    </x-livewire-pagebuilder::button>

                    <x-livewire-pagebuilder::button title="{{ __('Move down') }}" wire:click="moveDown"
                        class="hidden group-hover:flex items-center justify-center flex-row h-8 px-0 py-0 w-8"
                        icon="heroicon-o-arrow-down">

                    </x-livewire-pagebuilder::button>


                    <x-livewire-pagebuilder::button title="{{ __('Delete') }}" variant="danger" wire:click="delete"
                        x-on:click="$wire.$refresh()"
                        class="hidden group-hover:flex items-center justify-center flex-row h-8 px-0 py-0 w-8"
                        icon="heroicon-o-trash">

                    </x-livewire-pagebuilder::button>
                </div>
            </div>

            <!-- Collapsible Body -->
            <div class="p-4" x-show="show" x-transition>
                <div>
                    @if (!$content->isEmpty())
                        {{ $content }}
                    @else
                        <p class="text-gray-700">Your block has no body. Make sure to define the body inside in your
                            block
                            template</p>
                    @endif
                </div>
            </div>
        </div>
    @else
        @if (!$content->isEmpty())
            {{ $content }}
        @endif
    @endif
</section>
