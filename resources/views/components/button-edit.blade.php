@props(['active'])

<a {{ $attributes->merge(['class' => 'w-full inline-block border border-blue-500 text-blue-500 bg-blue-50 hover:bg-blue-100 px-2 py-1 no-underline rounded']) }}>
    {{ $slot }}
</a>
