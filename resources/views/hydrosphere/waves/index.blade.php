<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('all.hydrosphere') }}
        </h2>
    </x-slot>
    <!-- will be used to show any messages -->
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

                <p class="text-2xl text-gray-600 font-bold mb-6 underline">
                    All the Waves
                </p>

                <table class="w-full">
                    <thead class="norder border-b-2 border-gray-300 text-indigo-600">
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Description</td>
                            <td>Language</td>
                            <td width="200px;">Actions</td>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-white border-b">
                        @foreach($waves as $key => $value)
                            <tr>
                                <td class="text-sm text-indigo-900 border-b border-gray-400">{{ $value->id }}</td>
                                <td class="text-sm text-indigo-900 border-b border-gray-400">{{ $value->name }}</td>
                                <td class="text-sm text-indigo-900 border-b border-gray-400">{{ $value->description }}</td>
                                <td class="text-sm text-indigo-900 border-b border-gray-400">{{ $value->language->description }}</td>
                                <td class="text-sm text-indigo-900 border-b border-gray-400">
                                    <form action="{{ route('hydrosphere.waves.destroy',$value->id) }}" method="POST">
                                        <div class="flex flex-row">
                                            <div class="flex-1 p-1">
                                                <x-button-show :href="route('hydrosphere.waves.show',$value->id)">
                                                    {{ __('all.show') }}
                                                </x-button-show>
                                            </div>
                                            <div class="flex-1 p-1">
                                                <x-button-edit :href="route('hydrosphere.waves.edit',$value->id)">
                                                    {{ __('all.edit') }}
                                                </x-button-edit>
                                            </div>
                                            <div class="flex-1 p-1">
                                                <x-button-delete>{{ __('all.delete') }}</x-button>
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
                {!! $waves->links() !!} 
                </div>
                <div class="mt-5">
                    <x-button-link class="bg-gray-500 hover:bg-gray-800 w-full flex-auto" :href="route('hydrosphere.waves.create')">
                        {{ __('waves.create') }}
                    </x-button-link>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>