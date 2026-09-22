@props(['disabled' => false, 'label' => false, 'checked' => false, 'value' => '1'])

@error($attributes['name'])
    @php
        $class = 'w-4 rounded-sm border-gray-300 text-indigo-600 shadow-xs focus:border-indigo-300 focus:ring-3 focus:ring-indigo-200/50 border-red-500';
        $class_label = 'inline-flex items-center text-red-600';
    @endphp
@else
    @php
        $class = 'w-4 rounded-sm border-gray-300 text-indigo-600 shadow-xs focus:border-indigo-300 focus:ring-3 focus:ring-indigo-200/50';
        $class_label = 'inline-flex items-center';
    @endphp
@enderror
<div class="pt-3 pb-2">
@if($label !== false)
<label for="{{ $attributes['name'] }}" class="{{ $class_label }}">
@endif
<input type="hidden" name="{{ $attributes['name'] }}" value="{{ $value == '1' ? '0' : '' }}">
<input type="checkbox" 
        value="{{ $value }}"
        {{ $disabled ? 'disabled' : '' }}  
        {!! $attributes->merge(['class' => $class ]) !!}
 @if($checked)
 checked="checked"
 @endif
 >
@error($attributes['name'])
<div class="text-sm text-red-600">{{ $message }}</div>
@enderror
    
@if($label !== false)    
    <span class="ml-2 text-sm text-gray-600">{{ $label ?? $slot }}</span>
</label>
@endif
</div>