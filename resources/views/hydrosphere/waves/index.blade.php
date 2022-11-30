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

                <h1>All the waves</h1>

                
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full border text-center">
                                    <thead class="border-b">
                                        <tr>
                                            <td>ID</td>
                                            <td>Name</td>
                                            <td>Description</td>
                                            <td>Language</td>
                                            <td>Actions</td>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white border-b">
                                    @foreach($waves as $key => $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->description }}</td>
                                            <td>{{ $value->language->description }}</td>

                                            
                                            <td>
                                                <form action="{{ route('hydrosphere.waves.destroy',$value->id) }}" method="POST">
                                                    <x-button-link :href="route('hydrosphere.waves.show',$value->id)">
                                                        {{ __('waves_show') }}
                                                    </x-button-link>

                                                    <x-button-link class="ml-3" :href="route('hydrosphere.waves.edit',$value->id)">
                                                        {{ __('waves_edit') }}
                                                    </x-button-link>

                                                    @csrf
                                                    @method('DELETE')
                                                    <x-button class="ml-3 bg-blue-500  hover:bg-blue-700">{{ __('waves_delete') }}</x-button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $waves->links() !!} 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <x-button-link class="bg-gray-500 hover:bg-gray-800 w-full flex-auto" :href="route('hydrosphere.waves.create')">
                        {{ __('waves_create') }}
                    </x-button-link>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>