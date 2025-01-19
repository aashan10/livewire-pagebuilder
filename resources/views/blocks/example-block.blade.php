<x-livewire-pagebuilder::block>

    <x-slot:content>
        <div class="bg-white relative">

            <div class="relative isolate px-6 pt-14 lg:px-8">
                <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                    aria-hidden="true">
                    <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                        style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                    </div>
                </div>
                <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                    @if ($this->show_announcement)
                        <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                            <div
                                class="relative rounded-full px-3 py-1 text-sm/6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                                {{ $this->announcement }}

                                @if (!empty($this->announcement_url))
                                    <a href="{{ $this->announcement_url }}" class="font-semibold text-indigo-600"><span
                                            class="absolute inset-0"
                                            aria-hidden="true"></span>{{ $this->announcement_link_text }}<span
                                            aria-hidden="true">&rarr;</span></a>
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="text-center">
                        <h1 class="text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">
                            {{ $this->heading }}</h1>
                        @if ($this->show_subheading)
                            <p class="mt-8 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">
                                {{ $this->subheading }}
                            </p>
                        @endif
                        <div class="mt-10 flex items-center justify-center gap-x-6">
                            @if ($this->show_primary_button)
                                <a href="{{ $this->primary_button_url }}"
                                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $this->primary_button_text }}</a>
                            @endif
                            @if ($this->show_secondary_button)
                                <a href="{{ $this->secondary_button_url }}"
                                    class="text-sm/6 font-semibold text-gray-900">{{ $this->secondary_button_text }}<span
                                        aria-hidden="true">→</span></a>
                            @endif
                        </div>
                    </div>

                    <div class="w-full mt-16 space-y-4">
                        <h2 class="text-3xl  font-semibold text-gray-900">Repeated Fields</h2>
                        <p>You can add repeated fields to this block. The repeated fields are displayed below.</p>
                        <table class="table-fixed w-full">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($this->getRepeatedFieldData('repeated_fields', []) as $field)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $field['title'] }}</td>
                                        <td>{{ $field['description'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                    aria-hidden="true">
                    <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                        style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-livewire-pagebuilder::block>
