@php
    $actions = [
        [
            'route' => 'hydrosphere.fishers.all',
            'title' => 'Fishers',
            'description' => 'Manage registered fishers and their profiles.',
            'count' => $counts['fishers'],
            'color' => 'bg-sky-100 text-sky-600 group-hover:bg-sky-600',
            'icon' => 'M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z',
        ],
        [
            'route' => 'hydrosphere.waves.index',
            'title' => 'Waves',
            'description' => 'Create and organize waves and their content.',
            'count' => $counts['waves'],
            'color' => 'bg-cyan-100 text-cyan-600 group-hover:bg-cyan-600',
            'icon' => 'M2.25 15c1.5 0 1.5-1.5 3.375-1.5S7.5 15 9.375 15s1.875-1.5 3.375-1.5S14.625 15 16.5 15s1.875-1.5 3.375-1.5S21.75 15 21.75 15M2.25 19.5c1.5 0 1.5-1.5 3.375-1.5S7.5 19.5 9.375 19.5s1.875-1.5 3.375-1.5 1.875 1.5 3.75 1.5 1.875-1.5 3.375-1.5 1.875 1.5 1.875 1.5M2.25 10.5c1.5 0 1.5-1.5 3.375-1.5S7.5 10.5 9.375 10.5s1.875-1.5 3.375-1.5 1.875 1.5 3.75 1.5 1.875-1.5 3.375-1.5 1.875 1.5 1.875 1.5',
        ],
        [
            'route' => 'hydrosphere.languages.index',
            'title' => 'Languages',
            'description' => 'Configure the languages available on the site.',
            'count' => $counts['languages'],
            'color' => 'bg-teal-100 text-teal-600 group-hover:bg-teal-600',
            'icon' => 'm10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802',
        ],
        [
            'route' => 'hydrosphere.countries.index',
            'title' => 'Countries',
            'description' => 'Maintain the list of countries and their codes.',
            'count' => $counts['countries'],
            'color' => 'bg-indigo-100 text-indigo-600 group-hover:bg-indigo-600',
            'icon' => 'M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418',
        ],
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('hydrosphere') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-800">Actions</h3>
                <p class="mt-1 text-gray-500">Welcome back, {{ Auth::user()->name }}. What would you like to manage today?</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($actions as $action)
                    <a href="{{ route($action['route']) }}"
                       class="group relative flex flex-col rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200 transition duration-200 hover:-translate-y-1 hover:shadow-lg hover:ring-sky-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500">
                        <div class="flex items-start justify-between">
                            <span class="inline-flex h-12 w-12 items-center justify-center rounded-lg transition-colors duration-200 group-hover:text-white {{ $action['color'] }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $action['icon'] }}" />
                                </svg>
                            </span>
                            <span class="text-3xl font-bold text-gray-800 tabular-nums">{{ number_format($action['count']) }}</span>
                        </div>

                        <h4 class="mt-5 text-lg font-semibold text-gray-800">{{ $action['title'] }}</h4>
                        <p class="mt-1 flex-1 text-sm text-gray-500">{{ $action['description'] }}</p>

                        <span class="mt-5 inline-flex items-center text-sm font-semibold text-sky-600">
                            Manage
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="ml-1 h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" aria-hidden="true">
                                <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
