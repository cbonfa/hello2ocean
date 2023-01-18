<x-boat-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('boat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-boat-contacts :fisher="Auth::user()" :net="$net"/>
            </div>
        </div>
        

        <x-boat-chat/>
    </div>
    
  
</x-boat-layout>
