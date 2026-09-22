<div x-data="{
        showFisher: @entangle('showFisher'),
        showSuccess: @entangle('showSuccess'),
    }"
    class="flex flex-col w-full h-screen"   
    >
        
        <div class="header">
            <div class="flex flex-col space-y-2">
                <div class="md:h-96">
                    <nav class="flex pt-5 justify-between container mx-auto text-indigo-200">
                        <a class="text-4xl ml-4" href="/">
                            <x-application-logo class="w-16 h-16 fill-current"></x-application-logo>
                        </a>
                        <div class="flex justify-end">
                            @auth
                                {{-- {{ <a href="{{ route('hydrosphere.index') }}">Hydrosphere</a> }} --}}
                            @else
                                {{-- <a href="{{ route('login') }}">Login</a> --}}
                            @endauth
                        </div>
                    </nav>
                    <div class="flex container mx-auto">
                        <div class="flex flex-col m-4 md:w-1/3 items-start">
                            <h1 class="text-white font-bold text-5xl leading-tight mb-4">
                                Hello 2 Ocean
                            </h1>
                            <p class="text-indigo-200 text-xl mb-10">
                                {!! __('welcome.slogan') !!}
                            </p>
                            <x-button 
                                class="py-3 px-8 bg-red-500 hover:bg-red-600"
                                x-on:click="showFisher = true; $nextTick(() => { $refs.input.focus(); });"
                            >
                            {{ __('welcome.subscribe') }}
                            </x-button>
                        </div>
                    </div>
                </div>

                <!-- INI Content before waves-->
                <!-- Content before waves-->
            
                <!--Waves Container-->
                <div>
                    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                    </defs>
                    <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                    </g>
                    </svg>
                    </div>
                    <!--Waves end-->
                
                </div>
                <!--Header ends-->        
        </div>
        

        <!-- modal tailwind -->
        <x-model class="bg-pink-500" trigger="showFisher">
            <p class="text-white text-5xl mb-4 font-extrabold text-center">{{ __('welcome.modal.inscricao.title') }}</p>
            <p class="text-white text-1xl font-extrabold text-center">{{ __('welcome.modal.inscricao.subtitle') }}</p>
            <form 
                class="flex flex-col items-center pt-8 pb-5"
                wire:submit="subscribe"
            >
                <x-input 
                    class="px-5 py-3 border md:w-80 border-blue-400" 
                    type="email" 
                    name="email" 
                    placeholder="{{ __('Email Address') }}"
                    x-ref="input"
                    wire:model="email"
                >
                </x-input>
                <span class="text-gray-100 text-xs">
                    {{ 
                        $errors->has('email') 
                        ? $errors->first('email')
                        : __('welcome.modal.will_send_mail')
                    }}
                </span>
                <x-button class="px-5 py-3 mt-5 md:w-80 bg-blue-500 justify-center">
                    <span class="animate-spin mr-1" wire:loading wire:target="subscribe">
                        &#9696;
                    </span>
                    <span wire:loading.remove wire:target="subscribe">
                        {{ __('welcome.modal.button_subscribe') }}
                    </span>                    
                </x-button>
            </form>
        </x-model>

        <!-- modal tailwind -->
        <x-model class="bg-green-500" trigger="showSuccess">
            <p class="animate-pulse text-white text-8xl font-extrabold text-center">
                &check; 
            </p>
            <p class="text-white text-4xl font-extrabold text-center mt-2 mp-2">
                {{ __('welcome.modal.confirmation.title') }}
            </p>
            @if (request()->has('verified') && request()->verified == 1)
                <p class="text-white text-2xl mt-5 text-center">
                    {!! __('welcome.modal.confirmation.email_confimed') !!}
                    {{-- Thanks for confirming your account. --}}
                </p>
            @else
                <p class="text-white text-2xl mt-5 text-center">
                    {{ __('welcome.modal.confirmation.see_your_mail') }}
                    {{-- See you in your inbox. --}}
                </p>
            @endif
            
        </x-model>
        <div class="pt-2 pr-10 flex justify-end">
            @include('partials/language_switcher')
        </div>
        <!--Content ends-->
        <link href="{{ asset('/css/landing-page.css') }}" rel="stylesheet">
    </div>
