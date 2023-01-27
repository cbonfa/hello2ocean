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
        window.onload=function(){
            Echo.private('chat.fisher.{{ Auth::user()->id }}')
                .listen('MessageSent', (e) => {
                    if (document.getElementById('fisher_' + e.user.id)) {
                        document.getElementById('fisher_' + e.user.id).dispatchEvent(
                            new CustomEvent('add-fisher-message', {
                                                                    detail: { message: e.message, fisher_id: e.user.id }
                                                                })
                        );
                    } else {
                        alert('mensagem de alguém não na sua lista');
                    }
            });

            // document.querySelectorAll('[x-data]').forEach(el => {
            //     console.log(el.__x.getUnobservedData());
            // });
        }    
    </script>
    <script>
        // Sample stores
        // https://technotrampoline.com/articles/working-with-arrays-in-alpinejs-stores/
        document.addEventListener('alpine:init', () => {
            Alpine.data('utils', () => ({
                messages: [ ],
                newMessage: '',
                showChat: false,
                setMessages(fisher_id){
                    // axios
                    //   this.messages = messages;
                },
                addMessageOnBroadcast(event){
                    this.messages.push({ received: event.detail.message });
                    this.showChat = true;
                    // End of scroll
                    var objDiv = document.getElementById("chat_fisher_" + event.detail.fisher_id);
                    setTimeout(() => {
                        objDiv.scrollTop = objDiv.scrollHeight;
                    }, "50");
                },
                addMessage(fisher_id){
                    this.messages.push({ sent: this.newMessage });
                    let postVars = { message: this.newMessage };
                    window.axios.post(`/boat/chat/send_message/${fisher_id}`, postVars);
                    this.newMessage = "";
                    // End of scroll
                    var objDiv = document.getElementById("chat_fisher_" + fisher_id);
                    setTimeout(() => {
                        objDiv.scrollTop = objDiv.scrollHeight;
                    }, "50");
                }
            }))
        });
    </script>
  @endpush
</x-boat-layout>
