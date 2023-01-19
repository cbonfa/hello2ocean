<x-boat-layout>
    @push('styles')
    <style type="text/css">
    </style>
    @endpush

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
  @push('scripts')
    <script>
        function sendMessage(fisher_id)
        {
            alert('entrou');
            let postVars = { message: 'Hello' };
            window.axios.post(`/boat/chat/send_message/${fisher_id}`, postVars);
        }
    </script>
  @endpush
</x-boat-layout>
