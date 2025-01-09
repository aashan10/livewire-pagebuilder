@props(['active'])

<div class="max-w-full mx-auto" x-data="{
    activeTab: '{{ $active }}',
    setActiveTab(e) {
        const target = e.target;
        const tab = target.getAttribute('data-tab');

        this.activeTab = tab;

        target.scrollIntoView({
            behavior: 'smooth',
            block: 'nearest',
            inline: 'center',
        })
    }
}">
    <!-- Tabs -->
    <div
        class="flex bg-gray-100 text-neutral-900 overflow-x-auto scrollbar-hidden dark:text-white gap-2 dark:bg-neutral-700 p-1.5 rounded-md">

        {{ $buttons }}
    </div>

    <!-- Content -->
    <div class="w-full mt-4">
        {{ $slot }}
    </div>
</div>
