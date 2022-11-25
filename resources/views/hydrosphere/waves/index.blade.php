<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('hydrosphere') }}
        </h2>
    </x-slot>
    <!-- will be used to show any messages -->
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
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
                                                <td>{{ $value->language_id }}</td>

                                                <!-- we will also add show, edit, and delete buttons -->
                                                <td>

                                                    <!-- delete the shark (uses the destroy method DESTROY /waves/{id} -->
                                                    <!-- we will add this later since its a little more complicated than the other two buttons -->

                                                    <!-- show the shark (uses the show method found at GET /waves/{id} -->
                                                    <a class="btn btn-small btn-success" href="{{ URL::to('hydrosphere/waves/' . $value->id) }}">Show this shark</a>

                                                    <!-- edit this shark (uses the edit method found at GET /waves/{id}/edit -->
                                                    <a class="btn btn-small btn-info" href="{{ URL::to('hydrosphere/waves/' . $value->id . '/edit') }}">Edit this shark</a>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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