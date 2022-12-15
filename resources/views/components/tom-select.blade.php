@props([
	'options' => [],
	'items' => null,
    'label' => false
])

@error($attributes['name'])
    @php
        $class = 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 border-red-500';
        $class_label = 'block font-medium text-sm text-gray-700 mt-3 text-red-600';
    @endphp
@else
    @php
        $class = 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50';
        $class_label = 'block font-medium text-sm text-gray-700 mt-3';
    @endphp
@enderror

@if($label !== false)
<label for="{{ $attributes['name'] }}" class="{{ $class_label }}">
    {{ $label ?? $slot }}
</label>
@endif
{{-- // for multiselect edit eg. 1,2,3 comma separated ids
            // multiple // enable for multiple select --}}
<select
x-data="{
    tomSelectInstance: null,
    options: {{ collect($options) }},
    items: [{{ $items }}],
    loadAjax(query, callback) {
        var url = '{{ route('hydrosphere.waves.search') }}?q=' + encodeURIComponent(query);
        fetch(url)
            .then(response => response.json())
            .then(json => {
                callback(json);
            }).catch(()=>{
                callback();
            });
    },
    renderTemplate(data, escape) {
        return `<div class='flex items-center'>
            <span class='mr-3 w-8 h-8 rounded-full bg-gray-100'><img src='https://avatars.dicebear.com/api/initials/${escape(data.title)}.svg' class='w-8 h-8 rounded-full'/></span>
            <div><span class='block font-medium text-gray-700'>${escape(data.title)}</span>
            <span class='block text-gray-500'>${escape(data.subtitle)}</span></div>
        </div>`;
    },
    itemTemplate(data, escape) {
        return `<div>
            <span class='block font-medium text-gray-700'>${escape(data.title)}</span>
        </div>`;
    }
}" 
x-init="tomSelectInstance = new TomSelect($refs.input, {
    valueField: 'id',
    labelField: 'title',
    searchField: 'title',
    load: loadAjax,
    @if (! empty($items) && ! $attributes->has('multiple'))
        placeholder: undefined,
    @endif
    render: {
        option: renderTemplate,
        item: itemTemplate
    }
});"
x-ref="input" 
{!! $attributes->merge(['class' => $class]) !!}
placeholder="Pick some links..."></select>

{{--  

    options: options,
    items: items,

    Sample: https://gist.github.com/mithicher/9944232624cbad4b1cb5d3d2cac87a97 
    
--}}
{{--
@once
	@push('styles')
	<link href="https://cdn.jsdelivr.net/npm/tom-select@1.1/dist/css/tom-select.css" rel="stylesheet">
	<style>
		.ts-input {
            padding: 10px 8px;
			border-radius: 0.5rem;
			border-color: rgba(209, 213, 219, 1.0);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
		}
		.ts-input.focus {
			outline: 2px solid transparent;
            outline-offset: 2px;
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), 0 0 0 3px rgba(199, 210, 254, 0.5);
			border-color: rgba(165, 180, 252, 1.0); 
		}
		.ts-input.dropdown-active {
            border-radius: 0.5rem 0.5rem 0 0; 
		}
		.ts-dropdown {
			margin: -5px 0 0 0;
			border-radius: 0 0 0.5rem 0.5rem;
			padding-bottom: 4px;
		}
		.ts-control.single .ts-input:after {
			content:  url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='none' viewBox='0 0 24 24' stroke='%239CA3AF'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 9l4-4 4 4m0 6l-4 4-4-4' /%3E%3C/svg%3E");
			display: block;
			position: absolute;
			top: 10px;
			right: 8px;
			width: 24px;
			height: 24px;
			border: none;
		}
	</style>
	@endpush

	@push('scripts')
	<script src="https://cdn.jsdelivr.net/npm/tom-select@1.1/dist/js/tom-select.complete.min.js"></script>
	@endpush
@endonce
--}}