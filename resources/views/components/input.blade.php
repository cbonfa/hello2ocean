@props(['disabled' => false, 'label' => false])

@error($attributes['name'])
    @php
        $class = 'rounded-md shadow-xs border-gray-300 focus:border-indigo-300 focus:ring-3 focus:ring-indigo-200/50 border-red-500';
        $class_label = 'block font-medium text-sm text-gray-700 mt-3 text-red-600';
    @endphp
@else
    @php
        $class = 'rounded-md shadow-xs border-gray-300 focus:border-indigo-300 focus:ring-3 focus:ring-indigo-200/50';
        $class_label = 'block font-medium text-sm text-gray-700 mt-3';
    @endphp
@enderror

@if($label !== false)
<label for="{{ $attributes['name'] }}" class="{{ $class_label }}">
    {{ $label ?? $slot }}
</label>
@endif

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $class ]) !!}>
@error($attributes['name'])
<div class="text-sm text-red-600">{{ $message }}</div>
@enderror