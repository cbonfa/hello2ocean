    @isset($wave->id)  
        <form method="POST" action="{{ route('hydrosphere.waves.update', $wave->id) }}" accept-charset="UTF-8">
        @csrf
        @method('PUT')
    @else
        <form method="POST" action="{{ route('hydrosphere.waves.store') }}" accept-charset="UTF-8">
        @csrf
    @endisset
    <div>
        <x-input 
            :label="__('all.name')"
            id="name" class="block mt-1 w-full"
            type="text"
            name="name"
            :value="old('name', $wave->name ?? '')" />
    </div>
    <div>
        <x-textarea 
        :label="__('all.description')"
        class="w-full flex-auto" 
        rows="4" 
        name="description" 
        >{{ old('description', $wave->description ?? '')}}</x-textarea>
    </div>

    <div>
        <x-select
        name="language_id"
        :label="__('all.language')"
        class="w-full"
        includeBlank="{{__('all.choose_your_language')}}"
        labelMethod="description"
        :list="$languages"
        :selected="old('language_id', $wave->language_id ?? '')" />                        
    </div>
    <div>
        <x-tom-select
            id="wave_id_main"
            name="wave_id_main"
            label="Selecione a Onda Superior"
            :options="[
                [
                    'id' => 1,
                    'title' => 'John Doe',
                    'subtitle' => 'hello@test.test'
                ],
                [
                    'id' => 2,
                    'title' => 'Winter Doe',
                    'subtitle' => 'winter@test.test'
                ],
                [
                    'id' => 3,
                    'title' => 'Summer Doe',
                    'subtitle' => 'summer@test.test'
                ]
            ]"
            placeholder="Escolha a Onda Superior"
            items="{{ '1' }}"
        />
    </div>
    <div>
        <hr>
    </div>
    <div class="mt-5">
        <x-button 
        class="w-full bg-blue-500 hover:bg-blue-700"
        >
        {{ __('waves.save') }}
        </x-button>
    </div>
    </form>