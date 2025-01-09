<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @section('title')
        <title>{{ $page->title }}</title>
    @endsection

    @yield('title')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-neutral-100 dark:bg-neutral-900">
        <!-- Page Content -->
        <main>

            @foreach ($page->publishedBlocks as $block)
                <livewire:dynamic-component :is="$block->class::component()" :fields="$block->class::configure()" :block="$block"
                    :wire:key="$block->page_id . '_' . $block->id" />
            @endforeach
        </main>
    </div>
</body>

</html>
