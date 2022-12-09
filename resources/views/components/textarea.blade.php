@props(['disabled' => false, 'label' => false])

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

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $class]) !!}>{{ $slot }}</textarea>
@error($attributes['name'])
<div class="text-sm text-red-600">{{ $message }}</div>
@enderror