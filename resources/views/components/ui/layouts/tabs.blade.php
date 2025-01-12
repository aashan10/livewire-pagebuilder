@props(['ui'])
<div class="max-w-full mx-auto flex flex-col" x-data="{
    activeTab: '{{ $ui->active }}',
    tabs: [],
    focusedTab: null,
    init() {
        // Get all tab buttons once the component is initialized
        this.tabs = Array.from(this.$el.querySelectorAll('[role=tab]'));

        this.$watch('activeTab', value => {
            this.$nextTick(() => {
                const activeButton = this.$el.querySelector(`[data-tab='${value}']`);
                if (activeButton) {
                    activeButton.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });
                }
            });
        });
    },
    handleKeydown(e) {
        const currentIndex = this.tabs.findIndex(tab => tab.getAttribute('data-tab') === this.activeTab);

        switch (e.key) {
            case 'ArrowRight':
            case 'ArrowLeft': {
                e.preventDefault();
                const direction = e.key === 'ArrowRight' ? 1 : -1;
                const nextIndex = (currentIndex + direction + this.tabs.length) % this.tabs.length;
                const nextTab = this.tabs[nextIndex];

                this.activeTab = nextTab.getAttribute('data-tab');
                nextTab.focus();
                break;
            }
            case 'Home':
                e.preventDefault();
                const firstTab = this.tabs[0];
                this.activeTab = firstTab.getAttribute('data-tab');
                firstTab.focus();
                break;
            case 'End':
                e.preventDefault();
                const lastTab = this.tabs[this.tabs.length - 1];
                this.activeTab = lastTab.getAttribute('data-tab');
                lastTab.focus();
                break;
        }
    }
}">
    @if ($ui->heading)
        <h2 id="tabs-title" class="text-lg font-semibold text-neutral-900 dark:text-white">{{ $ui->heading }}</h2>
    @endif

    <div role="tablist" aria-labelledby="tabs-title"
        class="flex bg-gray-100 gap-4 dark:bg-neutral-900 p-2 rounded-md overflow-x-auto scrollbar-hidden"
        @keydown="handleKeydown">
        @foreach ($ui->tabs() as $tab)
            <button x-on:click.prevent="activeTab = '{{ $tab->name }}'" data-tab="{{ $tab->name }}"
                id="tab-{{ $tab->name }}" role="tab" aria-controls="panel-{{ $tab->name }}"
                :aria-selected="activeTab === '{{ $tab->name }}'"
                :tabindex="activeTab === '{{ $tab->name }}' ? 0 : -1"
                class="px-4 py-1 antialiased rounded-md outline-none active:ring-2 active:ring-neutral-500 focus:ring-2 focus:ring-neutral-500"
                :class="{
                    'bg-white dark:bg-neutral-700 text-neutral-900 dark:text-white shadow-sm dark:shadow-xl': activeTab === '{{ $tab->name }}',
                    'text-neutral-600 dark:text-neutral-300 hover:bg-gray-200 dark:hover:bg-neutral-700': activeTab !== '{{ $tab->name }}'
                }">
                {{ $tab->heading }}
            </button>
        @endforeach
    </div>

    <div class="w-full mt-4">
        @foreach ($ui->tabs() as $tab)
            <x-dynamic-component :component="$tab->component()" :ui="$tab" />
        @endforeach
    </div>
</div>
