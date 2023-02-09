<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('all.hydrosphere') }}
        </h2>
    </x-slot>
    <!-- will be used to show any messages -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm p-8">
                @if(session('success'))
                    <div class="bg-green-100 py-5 px-6 text-base text-green-700 mb-3">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                <div class="bg-red-100 py-5 px-6 text-base text-red-700 mb-3">
                    {{ session('error') }}
                </div>
                @endif

                <div class="flex flex-col md:flex-row">
                    <div class="flex-auto">
                        <p class="text-2xl text-gray-600 font-bold underline">
                            {{ __('countries.index') }}
                        </p>
                        <p class="">{{ __('countries.explanation') }}</p>
                    </div>
                    <div class="flex-auto lg:w-1/4 md:w-auto">
                        <x-search-form
                            route="{{ route('hydrosphere.countries.index') }}"
                            placeholder="{{ __('countries.search_placeholder') }}"
                            value="{{request()->input('search')}}"
                        >
                            {{ __('all.search') }}
                        </x-search-form>
                    </div>
                </div>

                <div class="inline-flex justify-center items-center w-full">
                    <hr class="mb-6 w-full h-1 border-t border-dashed border-gray-800">
                </div>
                
                
                <table class="tablemobile w-full flex-row flex-no-wrap overflow-hidden my-5">
                    <thead class="border-gray-300 text-indigo-600">
                        @foreach($countries as $country)
                            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                                <td>{{ __('all.id') }}</td>
                                <td>{{ __('all.name') }}</td>
                                <td>{{ __('all.country.code') }}</td>
                                <td class="actions">{{ __('all.actions') }}</td>
                            </tr>
                        @endforeach   
                    </thead>
                    
                    <tbody class="bg-white sm:flex-none">
                        @foreach($countries as $key => $value)
                            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                                <td class="text-sm text-indigo-900 border-b border-gray-400">{{ $value->id }}</td>
                                <td class="text-sm text-indigo-900 border-b border-gray-400">{{ $value->name }}</td>
                                <td class="text-sm text-indigo-900 border-b border-gray-400">{{ $value->code }}</td>
                                <td class="text-sm text-indigo-900 border-b border-gray-400">
                                    <form action="{{ route('hydrosphere.countries.destroy',$value->id) }}" method="POST">
                                        <div class="flex flex-row">
                                            <div class="flex-1 px-1">
                                                <x-button-show :href="route('hydrosphere.countries.show',$value->id)">
                                                    {{ __('all.show') }}
                                                </x-button-show>
                                            </div>
                                            <div class="flex-1 px-1">
                                                <x-button-edit :href="route('hydrosphere.countries.edit',$value->id)">
                                                    {{ __('all.edit') }}
                                                </x-button-edit>
                                            </div>
                                            <div class="flex-1 px-1">
                                                <x-button-delete confirm="{{ __('all.are_you_sure_delete') }}" >{{ __('all.delete') }}</x-button>
                                                @csrf
                                                @method('DELETE')
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                </table>

                {!! $countries->links() !!} 
                </div>
                <div class="mt-5 px-2">
                    <x-button-link class="bg-blue-500 hover:bg-blue-800 block" :href="route('hydrosphere.countries.create')">
                        {{ __('countries.create') }}
                    </x-button-link>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>