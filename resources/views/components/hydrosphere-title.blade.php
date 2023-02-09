@props(['title', 'subtitle', 'showDiv' => 'true', 
        'showSearch' => 'false', 'searchRoute' => '', 
        'searchPlaceholder' => '', 'searchValue' => ''])

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
@if($showSearch == 'true')
<div class="flex flex-col md:flex-row">
    <div class="flex-auto">
@endif
        <p class="text-2xl text-gray-600 font-bold underline">
            {{ $title }}
        </p>
        <p class="">{{ $subtitle }}</p>   
@if($showSearch == 'true')
    </div>
        <div class="flex-auto lg:w-1/4 md:w-auto">
            <x-search-form
                route="{{ $searchRoute }}"
                placeholder="{{ $searchPlaceholder }}"
                value="{{ $searchValue }}"
            >
                {{ __('all.search') }}
            </x-search-form>
        </div>
    </div>
@endif
@if($showDiv == 'true')
<div class="inline-flex justify-center items-center w-full">
        <hr class="mb-6 w-full h-1 border-t border-dashed border-gray-800">
</div>
@endif