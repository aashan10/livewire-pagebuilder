@props(['ui'])

@php
    use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

    $file = $this->{$ui->attributes()->get('wire:model')};

    $previewUrl = null;

    if ($file instanceof TemporaryUploadedFile) {
        $previewUrl = $file->temporaryUrl();
    } elseif (is_string($file)) {
        $previewUrl = $file;
    }

    $removeImage = function () use ($ui) {
        $this->{$ui->attributes()->get('wire:model')} = null;
    };
@endphp

<div class="w-full">
    {{-- Hidden file input --}}
    <input type="file" multiple="false" {{ $ui->attributes()->except(['class', 'type', 'accept', 'id']) }}
        id="{{ $ui->id() }}" accept="image/*" class="hidden">

    {{-- Upload area --}}
    <div x-data="{
        dragOver: false,
        handleFiles(files) {
            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    document.getElementById('{{ $ui->id() }}').files = files;
                    const event = new Event('change');
                    document.getElementById('{{ $ui->id() }}').dispatchEvent(event);
                }
            }
        }
    }" @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
        @drop.prevent="dragOver = false; handleFiles($event.dataTransfer.files)">

        {{-- Upload area UI --}}
        <div @click="document.getElementById('{{ $ui->id() }}').click()"
            :class="{
                'border-neutral-500': !dragOver,
                'border-blue-500': dragOver
            }"
            class="cursor-pointer rounded-lg border-2 border-dashed p-6 text-center transition-colors duration-150">
            <div class="text-sm flex flex-col text-neutral-600 gap-6">
                @svg('heroicon-o-cloud-arrow-up', 'w-12 h-12 mx-auto text-neutral-400 dark:text-neutral-500')
                <div>
                    <span class="font-medium text-blue-600">Click to upload</span> or drag and drop
                </div>
            </div>
        </div>
    </div>

    <div class="relative flex flex-col mt-4">

        {{-- Remove button --}}
        @if ($file)
            <x-livewire-pagebuilder::button variant="danger" style="padding: 0"
                class="absolute top-5 right-5 w-8 h-8 rounded-full p-0 justify-center items-center"
                wire:click="removeImage">
                @svg('heroicon-o-trash', 'w-4 h-4')
            </x-livewire-pagebuilder::button>
        @endif
        {{-- Preview --}}
        @if ($previewUrl)
            <img src="{{ $previewUrl }}" alt="Preview" class="rounded-lg w-full h-48 object-cover">
        @endif

        {{-- File name --}}
        @if ($file)
            <div class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                {{-- TODO: Display the uploaded image --}}
            </div>
        @endif
    </div>
</div>
