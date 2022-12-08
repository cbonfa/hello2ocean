@props(['active'])

<a {{ $attributes->merge(['class' => 'px-2 py-1 text-blue-100 no-underline text-center hover:no-underline bg-blue-500 rounded hover:bg-blue-600 hover:underline hover:text-blue-200']) }}>
    {{ $slot }}
</a>
