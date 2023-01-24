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
                <x-boat-contacts :user="Auth::user()" :net="$net"/>
            </div>
        </div>
        

        
    </div>
  @push('scripts')
    <script>
        function sendMessage(fisher_id)
        {
            let postVars = { message: 'Hello' };
            window.axios.post(`/boat/chat/send_message/${fisher_id}`, postVars);
        }
    </script>
    <script>
        window.onload=function(){
            Echo.private('chat.fisher.{{ Auth::user()->id }}')
                .listen('MessageSent', (e) => {
                    alert(e.message);
                    console.log(e);
            });
        }    
    </script>
    <script>
        // Sample stores
        // https://technotrampoline.com/articles/working-with-arrays-in-alpinejs-stores/
        document.addEventListener('alpine:init', () => {
            Alpine.data('utils', () => ({
                messages: [ { sent: 'BiriguiLISTENER', received: '', datetime: '' }, { received: 'XXX', datetime: '' }, { sent: '', received: 'received NANANANA', datetime: '' } ],
                newMessage: "",
                addMessage(){
                    this.messages.push({ received: this.newMessage });
                    this.newMessage = "";
                }
            }))
        })
    </script>
  @endpush
</x-boat-layout>
