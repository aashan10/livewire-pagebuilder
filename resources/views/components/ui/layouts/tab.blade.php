@props(['ui'])
<div id="panel-{{ $ui->name }}" role="tabpanel" aria-labelledby="tab-{{ $ui->name }}"
    x-show="activeTab === '{{ $ui->name }}'" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" tabindex="0"
    class="rounded-md focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
    <div class="flex flex-col gap-4">
        @foreach ($ui->children as $field)
            <x-dynamic-component :component="$field->component()" :ui="$field" />
        @endforeach
    </div>
</div>
