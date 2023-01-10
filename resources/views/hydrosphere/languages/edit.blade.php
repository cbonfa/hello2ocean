
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('all.hydrosphere') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                @if(session('success'))
                    <div class="bg-green-100 rounded-lg py-5 px-6 text-base text-green-700 mb-3">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                <div class="bg-red-100 rounded-lg py-5 px-6 text-base text-red-700 mb-3">
                    {{ session('error') }}
                </div>
                @endif

                <p class="text-2xl text-gray-600 font-bold underline">
                    {{ __('languages.edit') }}
                </p>
                <p class="">{{ __('languages.explanation') }}</p>
                
                <div class="inline-flex justify-center items-center w-full">
                        <hr class="mb-6 w-full h-1 border-t border-dashed border-gray-800">
                </div>
                @include('hydrosphere.languages._form')

                <div class="mt-5"><hr></div>
                <div class="mt-5 text-center">
                    <x-button-link class="bg-gray-500 hover:bg-gray-800" :href="route('hydrosphere.languages.index')">
                        {{ __('languages.see_all') }}
                    </x-button-link>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>