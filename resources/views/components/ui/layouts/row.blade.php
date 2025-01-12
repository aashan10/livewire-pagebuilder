@props(['ui'])

<div class="flex flex-row gap-4">
    @foreach ($ui->children as $field)
        <div class="flex flex-1">
            <x-dynamic-component :component="$field->component()" :ui="$field" />
        </div>
    @endforeach
</div>
