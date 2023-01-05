<div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
    @foreach($available_locales as $locale_name => $available_locale)
        @if($available_locale === $current_locale)
        {{-- <span>{{ $locale_name }}</span> --}}
            <x-dynamic-component component="flag-language-{{ strtolower(str_replace('_', '-', $available_locale)) }}" class="w-6 h-6" />
        @else
            <a class="ml-1 underline ml-2 mr-2" href="language/{{ $available_locale }}">
                <x-dynamic-component component="flag-language-{{ strtolower(str_replace('_', '-', $available_locale)) }}" class="w-6 h-6" />
            </a>
        @endif
    @endforeach
</div>