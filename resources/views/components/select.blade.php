@props(['list', 'selected', 'includeBlank', 'labelMethod' => null, 'label' => false])

@error($attributes['name'])
    @php
        $class = 'rounded-md shadow-xs border-red-500';
        $class_label = 'block font-medium text-sm text-gray-700 mt-3 text-red-600';
    @endphp
@else
    @php
        $class = 'rounded-md shadow-xs';
        $class_label = 'block font-medium text-sm text-gray-700 mt-3';
    @endphp
@enderror

@if($label !== false)
<label for="{{ $attributes['name'] }}" class="{{ $class_label }}">
    {{ $label ?? $slot }}
</label>
@endif
<select name="{{$attributes['name']}}" id="{{$attributes['name']}}" {!! $attributes->merge(['class' => $class]) !!}">
 {{ $slot }}
 @if (isset($includeBlank))
 <option value="">{{$includeBlank}}</option> 
 @endif
 @if (isset($labelMethod) && isset($list))
 @foreach($list as $value)
 <option value="{{$value->id}}" {{ $selected == $value->id ? "selected" : "" }}>{{$value[$labelMethod]}}</option>
 @endforeach
 @elseif (isset($list))
 @foreach($list as $key => $value)
 <option value="{{$key}}" {{ $selected == $key ? "selected" : "" }}>{{$value}}</option>
 @endforeach
 @endif
</select>
@error($attributes['name'])
<div class="text-sm text-red-600">{{ $message }}</div>
@enderror