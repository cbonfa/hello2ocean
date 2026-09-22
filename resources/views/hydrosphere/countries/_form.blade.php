    @isset($country->id)  
        <form method="POST" action="{{ route('hydrosphere.countries.update', $country->id) }}" accept-charset="UTF-8">
        @csrf
        @method('PUT')
    @else
        <form method="POST" action="{{ route('hydrosphere.countries.store') }}" accept-charset="UTF-8">
        @csrf
    @endisset
    <div>
        <x-input 
            :label="__('all.name')"
            id="name" class="block mt-1 w-full"
            type="text"
            name="name"
            :value="old('name', $country->name ?? '')" />
    </div>
    <div>
        <x-input 
            :label="__('countries.code')"
            id="code" class="block mt-1 w-full"
            type="text"
            name="code"
            :value="old('code', $country->code ?? '')" />
    </div>

    <div>
        <hr>
    </div>
    <div class="mt-5">
        <x-button 
        class="w-full bg-blue-500 hover:bg-blue-700"
        >
            {{ __('countries.save') }}
        </x-button>
    </div>
    </form>