@props(['trigger'])
<div 
    x-cloak
    class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full"
    x-show="{{ $trigger }}"
    x-on:click.self="{{ $trigger }} = false"
    x-on:keydown.escape.window="{{ $trigger }} = false"
    x-trap="open"
>
        <div {{ $attributes->merge(['class' => 'm-auto md:align-middle md:w-96 shadow-2xl rounded-xl p-8']) }}>
            {{ $slot }}
        </div>
</div>


