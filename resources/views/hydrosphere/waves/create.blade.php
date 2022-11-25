<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('hydrosphere') }}
        </h2>
    </x-slot>

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
                <h1>Create a Wave</h1> 

                {{ Form::open(array('url' => route  ('hydrosphere.waves.store'))) }}
                    <div>
                        <x-label for="name" :value="__('name')" />
                        <x-input id="name" class="block mt-1 w-full"
                                        type="text"
                                        name="name"
                                        value="{{ old('name') }}" />
                    </div>
                    <div>
                        <x-label for="description" :value="__('description')" />
                        <x-textarea 
                        class="w-full flex-auto" 
                        rows="4" 
                        name="description" 
                        >{{ old('description') }}</x-textarea>
                    </div>
                    
                    <div>
                        <x-label for="description" :value="__('language')" />
                        <x-select
                        name="language_id"
                        class="w-full"
                        includeBlank="{{__('escolha_a_linguagem')}}"
                        labelMethod="description"
                        :list="$languages"
                        :selected="old('language_id')" />                        
                    </div>
                    {{--  {{ array('0'=>'SelectaLevel','1'=>'SeesSunlight','2'=>'FoosballFanatic','3'=>'BasementDweller'),old('Wave_level') }} /> --}}
                    <div>
                        <hr>
                    </div>
                    <div class="mt-5">
                        <x-button 
                        class="w-full bg-blue-500  hover:bg-blue-700"

                        >
                            Create a Wave
                        </x-button>
                    </div>
                    {{-- {{ Form::submit('Create the Wave!', array('class' => 'btn btn-primary')) }} --}}

                {{ Form::close() }}
                <div class="mt-5">
                    <x-button-link class="bg-gray-500 hover:bg-gray-800" :href="route('hydrosphere.waves.index')">
                        {{ __('waves_see_all') }}
                    </x-button-link>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>