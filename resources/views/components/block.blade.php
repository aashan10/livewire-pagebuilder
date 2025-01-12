@props([
    'editmode' => false,
])


<section id="block_{{ $this->block->page_id }}_{{ $this->block->id }}">
    @if ($this->editmode)

        @php
            $fields = $this->configure();
        @endphp
        <div class="w-full group bg-white dark:bg-neutral-800 rounded-xl shadow" x-data="{ show: true }">
            <div class="flex justify-between items-center z-[49] relative p-4">
                <!-- Name -->
                <div class="flex flex-row gap-2 items-center">
                    <button x-on:click.prevent="show = !show" class="flex font-bold flex-row items-center gap-2">
                        @svg('heroicon-s-chevron-down', 'h-4 w-4 fill-neutral-900 dark:fill-white', ['x-show' => '!show'])
                        @svg('heroicon-s-chevron-up', 'h-4 w-4 fill-neutral-900 dark:fill-white', ['x-show' => 'show'])
                        <span class="text-neutral-900 dark:text-white">{{ $this->name() }}
                            ({{ $this->block->id }})</span>
                    </button>
                </div>
                <!-- Toolbar -->
                <div class="flex space-x-2 min-h-[38px]">

                    @if (isset($buttons) && !$buttons->isEmpty())
                        {{ $buttons }}
                    @endif

                    <x-livewire-pagebuilder::button title="{{ __('Meta Information') }}"
                        wire:click="$dispatch('open-modal', 'block-meta-info-modal-{{ $this->block->id }}')"
                        class="hidden group-hover:flex items-center justify-center flex-row w-[36px] h-[36px] !px-0"
                        icon="heroicon-o-exclamation-circle">

                    </x-livewire-pagebuilder::button>
                    @if ($this->block->published)
                        <x-livewire-pagebuilder::button title="{{ __('Unpublish') }}" wire:click="unpublish"
                            class="hidden group-hover:flex items-center justify-center flex-row w-[36px] h-[36px] !px-0"
                            icon="heroicon-o-eye-slash">

                        </x-livewire-pagebuilder::button>
                    @else
                        <x-livewire-pagebuilder::button title="{{ __('Publish') }}" wire:click="publish"
                            class="hidden group-hover:flex items-center justify-center flex-row w-[36px] h-[36px] !px-0"
                            icon="heroicon-o-eye">

                        </x-livewire-pagebuilder::button>
                    @endif
                    @if (!$fields->isEmpty())
                        <x-modal class="rounded-xl" focusable name="edit-block-{{ $this->block->id }}">
                            <div class="flex flex-col gap-4 p-6">
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
                            class="hidden group-hover:flex items-center justify-center flex-row w-[36px] h-[36px] !px-0"
                            icon="heroicon-o-cog">

                        </x-livewire-pagebuilder::button>
                    @endif

                    <x-livewire-pagebuilder::button title="{{ __('Duplicate') }}" wire:click="duplicate"
                        class="hidden group-hover:flex items-center justify-center flex-row w-[36px] h-[36px] !px-0"
                        icon="heroicon-o-square-2-stack">

                    </x-livewire-pagebuilder::button>
                    <x-livewire-pagebuilder::button title="{{ __('Move up') }}" wire:click="moveUp"
                        class="hidden group-hover:flex items-center justify-center flex-row w-[36px] h-[36px] !px-0"
                        icon="heroicon-o-arrow-up">

                    </x-livewire-pagebuilder::button>

                    <x-livewire-pagebuilder::button title="{{ __('Move down') }}" wire:click="moveDown"
                        class="hidden group-hover:flex items-center justify-center flex-row w-[36px] h-[36px] !px-0"
                        icon="heroicon-o-arrow-down">

                    </x-livewire-pagebuilder::button>


                    <x-livewire-pagebuilder::button title="{{ __('Delete') }}" variant="danger" wire:click="delete"
                        x-on:click="$wire.$refresh()"
                        class="hidden group-hover:flex items-center justify-center flex-row w-[36px] h-[36px] !px-0"
                        icon="heroicon-o-trash">

                    </x-livewire-pagebuilder::button>
                </div>
                <x-livewire-pagebuilder::modal name="block-meta-info-modal-{{ $this->block->id }}">
                    <div class="w-full p-6">
                        <table class="table-fixed p-6 w-full text-neutral-900 dark:text-white">
                            <thead>
                                <tr>
                                    <th class="text-left">{{ __('Key') }}</th>
                                    <th class="text-left">{{ __('Value') }}</th>
                                </tr>
                            </thead>
                            @php
                                $rows = [
                                    __('ID') => $this->block->id,
                                    __('Created At') => $this->block->created_at,
                                    __('Updated At') => $this->block->updated_at,
                                    __('Published') => $this->block->published ? __('Yes') : __('No'),
                                    __('Sort Order') => $this->block->sort_order,
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
