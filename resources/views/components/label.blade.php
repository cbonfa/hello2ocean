@props(['value'])

@error($attributes['for'])
    @php
        $class = 'block font-medium text-sm text-gray-700 mt-3 text-red-600';
    @endphp
@else
    @php
        $class = 'block font-medium text-sm text-gray-700 mt-3';
    @endphp
@enderror

<label {{ $attributes->merge(['class' => $class]) }}>
    {{ $value ?? $slot }}
</label>
