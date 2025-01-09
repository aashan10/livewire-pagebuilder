@props(['ui'])

<div class="flex flex-col gap-2 p-2" :class="{ 'hidden': activeTab !== '{{ $ui->name }}' }"
    x-show="activeTab === '{{ $ui->name }}'">
    @foreach ($ui->children as $field)
        <x-dynamic-component :component="$field->component()" :ui="$field" />
    @endforeach
</div>
