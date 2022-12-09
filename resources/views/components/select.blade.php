@props(['name', 'list', 'selected', 'includeBlank', 'labelMethod'])

@error($attributes['name'])
    @php
        $class = 'rounded-md shadow-sm border-red-500';
    @endphp
@else
    @php
        $class = 'rounded-md shadow-sm';
    @endphp
@enderror

<select name="{{$name}}" id="{{$name}}" {!! $attributes->merge(['class' => $class]) !!}"}}>
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