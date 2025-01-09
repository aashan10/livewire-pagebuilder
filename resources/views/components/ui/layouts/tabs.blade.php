@props(['ui'])

<div class="max-w-full mx-auto gap-2 flex flex-col" x-data="{
    activeTab: '{{ $ui->active }}',
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
    @if ($ui->heading)
        <h2 class="text-lg font-semibold text-neutral-900 dark:text-white">{{ $ui->heading }}</h2>
    @endif
    <div
        class="flex bg-gray-100 text-neutral-900 overflow-x-auto scrollbar-hidden dark:text-white gap-2 dark:bg-neutral-700 p-1.5 rounded-md">


        @foreach ($ui->tabs() as $tab)
            <button x-on:click.prevent="setActiveTab($event)" data-tab="{{ $tab->name }}"
                class="px-4 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-neutral-600 dark:hover:text-white"
                :class="{ 'bg-gray-200 dark:bg-neutral-600 dark:text-white': activeTab === '{{ $tab->name }}' }">
                {{ $tab->heading }}
            </button>
        @endforeach
    </div>

    <!-- Content -->
    <div class="w-full">
        @foreach ($ui->tabs() as $tab)
            <x-dynamic-component :component="$tab->component()" :ui="$tab" />
        @endforeach
    </div>
</div>
