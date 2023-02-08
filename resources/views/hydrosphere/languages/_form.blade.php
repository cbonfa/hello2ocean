    @isset($language->id)  
        {{ Form::open(array('url' => route  ('hydrosphere.languages.update', $language->id))) }}
        @csrf
        @method('PUT')
    @else
        {{ Form::open(array('url' => route  ('hydrosphere.languages.store'))) }}
        @csrf
    @endisset
    <div>
        <x-input 
            :label="__('all.description')"
            id="description" class="block mt-1 w-full"
            type="text"
            name="description"
            :value="old('description', $language->description ?? '')" />
    </div>
    <div>
        <x-select
        name="country_id"
        :label="__('all.country')"
        class="w-full"
        includeBlank="{{__('all.choose_your_country')}}"
        labelMethod="name"
        :list="$countries"
        :selected="old('country_id', $language->country_id ?? '')" />                        
    </div>
    <div>
        <x-input 
            :label="__('all.locale')"
            id="locale" class="block mt-1 w-full"
            type="text"
            name="locale"
            :value="old('locale', $language->locale ?? '')" />
    </div>
    <div>
        <x-checkbox 
            :label="__('all.active')"
            id="active" class="block mt-1 w-full"
            name="active"
            :checked="old('active', $language->active ?? '')" />
    </div>

    <div>
        <hr>
    </div>
    <div class="mt-5">
        <x-button 
        class="w-full bg-blue-500  hover:bg-blue-700"
        >
            {{ __('languages.save') }}
        </x-button>
    </div>
    {{ Form::close() }}