
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('hydrosphere') }}
        </h2>
    </x-slot>
    <!-- will be used to show any messages -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg p-8">
                <x-hydrosphere-title
                    title="{{ __('waves.show') }}"
                    subtitle="{{ __('waves.explanation') }}"
                    showDiv="false"
                />

                <div class="mt-6 overflow-hidden shadow-sm ring-1 ring-black/5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr class="divide-x divide-gray-200">
                                <th scope="col" class="w-1/4 py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 bg-gray-50 sm:pl-6">
                                    {{ __('all.name') }}
                                </th>
                                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-6">
                                    {{ $wave->name }}
                                </td>
                            </tr>
                            <tr class="divide-x divide-gray-200">
                                <th scope="col" class="w-1/4 py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 bg-gray-50 sm:pl-6">
                                    {{ __('all.description') }}
                                </th>
                                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-6">
                                    {!! nl2br(e($wave->description)) !!}
                                </td>
                            </tr>
                            <tr class="divide-x divide-gray-200">
                                <th scope="col" class="w-1/4 py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 bg-gray-50 sm:pl-6">
                                    {{ __('all.language') }}
                                </th>
                                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-6">
                                    {{ $wave->language->description }}
                                </td>
                            </tr>
                            <tr class="divide-x divide-gray-200">
                                <th scope="col" class="w-1/4 py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 bg-gray-50 sm:pl-6">
                                    {{ __('waves.main_wave') }}
                                </th>
                                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-6">
                                    {{ $wave->main_wave->description ?? '* ' . __('waves.main_wave') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-5 text-center">
                <x-button-link class="bg-gray-500 hover:bg-gray-800" :href="route('hydrosphere.waves.index')">
                    {{ __('waves.see_all') }}
                </x-button-link>
                <x-button-link class="ml-4 bg-blue-500 hover:bg-blue-800" :href="route('hydrosphere.waves.edit', compact('wave'))">
                    {{ __('waves.edit') }}
                </x-button-link>
            </div>
        </div>

        </div>

</x-app-layout>