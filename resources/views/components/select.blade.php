@props(['name', 'list', 'selected', 'includeBlank', 'labelMethod'])

<select name="{{$name}}" id="{{$name}}" {!! $attributes->merge(['class' => 'rounded-md shadow-sm']) !!}"}}>
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