@props(['disabled' => false])

@error($attributes['name'])
    @php
        $class = 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 border-red-500';
    @endphp
@else
    @php
        $class = 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50';
    @endphp
@enderror

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $class ]) !!}>
@error($attributes['name'])
<div class="text-sm text-red-600">{{ $message }}</div>
@enderror