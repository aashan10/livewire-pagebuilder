@props(['name'])

@error($name)
    <p class="mt-1 text-sm text-red-500 error">{{ $message }}</p>
@enderror
