<div x-data="{
        showFisher: @entangle('showFisher'),
        showSuccess: @entangle('showSuccess'),
    }"
    class="flex flex-col w-full h-screen"   
    >
        
        <div class="header">
            <div class="flex flex-col space-y-2">
                <div>
                    <nav class="flex pt-5 justify-between container mx-auto text-indigo-200">
                        <a class="text-4xl" href="/">
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
                        <div class="flex flex-col w-1/3 items-start">
                            <h1 class="text-white font-bold text-5xl leading-tight mb-4">
                                Hello 2 Ocean
                            </h1>
                            <p class="text-indigo-200 text-xl mb-10">
                                A nova rede social para <span class="font-bold underline">NAVEGAR</span> de verdade. <br><small>Inscreva-se para novidades em breve</small>
                            </p>
                            <x-button 
                                class="py-3 px-8 bg-red-500 hover:bg-red-600"
                                x-on:click="showFisher = true"
                            >
                                Inscrever
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
            <p class="text-white text-5xl font-extrabold text-center"> Vamos lá!</p>
            <p class="text-white text-1xl font-extrabold text-center"> Desejo pescar em breve!</p>
            <form 
                class="flex flex-col items-center p-20"
                wire:submit.prevent="subscribe"
            >
                <x-input 
                    class="px-5 py-3 w-80 border border-blue-400" 
                    type="email" 
                    name="email" 
                    placeholder="endereço de e-mail"
                    wire:model.defer="email"
                >
                </x-input>
                <span class="text-gray-100 text-xs">
                    {{ 
                        $errors->has('email') 
                        ? $errors->first('email')
                        : 'Nós iremos enviar um e-mails de confirmação'
                    }}
                    {{-- 'We will send you a confirmation e-mail' --}}
                </span>
                <x-button class="px-5 py-3 mt-5 w-80 bg-blue-500 justify-center">
                    <span class="animate-spin mr-1" wire:loading wire:target="subscribe">
                        &#9696;
                    </span>
                    <span wire:loading.remove wire:target="subscribe">
                        Prontinho!
                    </span>                    
                </x-button>
            </form>
        </x-model>

        <!-- modal tailwind -->
        <x-model class="bg-green-500" trigger="showSuccess">
            <p class="animate-pulse text-white text-9xl font-extrabold text-center">
                &check; 
            </p>
            <p class="text-white text-5xl font-extrabold text-center mt-16">
                Perfeito!
            </p>
            @if (request()->has('verified') && request()->verified == 1)
                <p class="text-white text-3xl text-center">
                    Obrigado por confirmar seu e-mail
                    {{-- Thanks for confirming your account. --}}
                </p>
            @else
                <p class="text-white text-3xl text-center">
                    Veja sua caixa de e-mail
                    {{-- See you in your inbox. --}}
                </p>
            @endif
            
        </x-model>
        <div class=" items-center">
            <p>Em breve pescador</p>
        </div>
        <!--Content ends-->
    </div>
    <!--Content starts-->
    
    <link href="{{ asset('/css/landing-page.css') }}" rel="stylesheet">
