    @isset($waves->id)
        {{ Form::open(array('url' => route  ('hydrosphere.waves.update', $wave->id))) }}
        @csrf
        @method('PUT')
    @else
        {{ Form::open(array('url' => route  ('hydrosphere.waves.store'))) }}
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