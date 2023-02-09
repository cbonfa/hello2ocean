<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('all.hydrosphere') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <x-hydrosphere-title
                    title="{{ __('waves.create') }}"
                    subtitle="{{ __('waves.explanation') }}"
                />

                @include('hydrosphere.waves._form')

                <div class="mt-5"><hr></div>
                <div class="mt-5 text-center">
                    <x-button-link class="bg-gray-500 hover:bg-gray-800" :href="route('hydrosphere.waves.index')">
                        {{ __('waves.see_all') }}
                    </x-button-link>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>