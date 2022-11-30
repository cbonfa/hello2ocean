
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('hydrosphere') }}
        </h2>
    </x-slot>
    <!-- will be used to show any messages -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                @if(session('success'))
                    <div class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                <div class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3">
                    {{ session('error') }}
                </div>
                @endif

                <h1>Show the Wave</h1>

                <div>
                    <div>
                        <div>
                            <strong>Name:</strong>
                            {{ $wave->name }}
                        </div>
                    </div>
                    <div>
                        <div>
                            <strong>Description:</strong>
                            {{ to_nc($wave->description) }}
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Language:</strong>
                        {{ $wave->language->description }}
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <x-button-link class="bg-gray-500 hover:bg-gray-800" :href="route('hydrosphere.waves.index')">
                    {{ __('waves_see_all') }}
                </x-button-link>
                <x-button-link class="ml-4 bg-gray-500 hover:bg-gray-800" :href="route('hydrosphere.waves.edit', compact('wave'))">
                    {{ __('waves_edit') }}
                </x-button-link>
            </div>
        </div>

        </div>

</x-app-layout>