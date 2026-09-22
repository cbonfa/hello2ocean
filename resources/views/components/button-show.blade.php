@props(['active'])

<a {{ $attributes->merge(['class' => 'w-full inline-block text-center border border-teal-500 text-teal-500 bg-teal-50 hover:bg-teal-100 px-2 py-1 no-underline rounded-sm']) }}>
    {{ $slot }}
</a>
