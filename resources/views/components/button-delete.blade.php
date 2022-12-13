@props(['confirm' => null])

@php
    if (!empty($confirm)){
        $confirm = 'onclick="return confirm(' . "'" . $confirm . "'" . ');"';
    }
@endphp

<button {!! $confirm !!} {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full inline-block text-center border border-red-500 text-red-500 bg-red-50 hover:bg-red-100 px-2 py-1 no-underline rounded']) }}>
    {{ $slot }}
</button>
