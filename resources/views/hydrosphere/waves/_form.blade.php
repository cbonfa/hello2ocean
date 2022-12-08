    @isset($waves->id)
        {{ Form::open(array('url' => route  ('hydrosphere.waves.update', $wave->id))) }}
        @csrf
        @method('PUT')
    @else
        {{ Form::open(array('url' => route  ('hydrosphere.waves.store'))) }}
        @csrf
    @endisset
    <div>
        <x-label for="name" :value="__('name')" />
        <x-input id="name" class="block mt-1 w-full"
                        type="text"
                        name="name"
                        :value="old('name', $wave->name ?? '')" />
    </div>
    <div>
        <x-label for="description" :value="__('description')" />
        <x-textarea 
        class="w-full flex-auto" 
        rows="4" 
        name="description" 
        >{{ old('description', $wave->description ?? '')}}</x-textarea>
    </div>

    <div>
        <x-label for="language_id" :value="__('language')" />
        <x-select
        name="language_id"
        class="w-full"
        includeBlank="{{__('all.choose_your_language')}}"
        labelMethod="description"
        :list="$languages"
        :selected="old('language_id', $wave->language_id ?? '')" />                        
    </div>
    <div>
        <hr>
    </div>
    <div class="mt-5">
        <x-button 
        class="w-full bg-blue-500  hover:bg-blue-700"
        >
            Save the Wave
        </x-button>
    </div>
    {{ Form::close() }}