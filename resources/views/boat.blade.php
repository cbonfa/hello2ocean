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
            <livewire:boat.home></livewire:boat.home>
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
                        if (confirm('Alguém que não está na sua lista está enviando uma mensagem, deseja adiciona-lo?')) {
                            document.getElementById('net_contacs').dispatchEvent(
                                new CustomEvent('add-fisher-net', {
                                                                        detail: { message: e.message, fisher: e.user }
                                                                    })
                            );
                        }
                    }
            });

            // document.querySelectorAll('[x-data]').forEach(el => {
            //     console.log(el.__x.getUnobservedData());
            // });
        }    
    </script>
    <script>
        // Sample stores
        document.addEventListener('alpine:init', () => {
            Alpine.data('net', () => ({
                contacts: [ ],
                loadContacts(){
                    axios.post('/boat/chat/get_net', {})
                    .then((response) => {
                        this.contacts = response.data;
                    }, (error) => {
                        console.log(error);
                    });
                    
                },
                addNetOnBroadcast(event){
                    var fisher = event.detail.fisher
                    this.contacts.push({ id: fisher.id, name: fisher.name, nick_image: fisher.nick_image });
                    axios.post(`/boat/chat/add_net/${fisher.id}`, {})
                    .then((response) => {
                        alert('respondeu');
                        document.getElementById("chat_fisher_" + fisher.id).dispatchEvent(
                            new CustomEvent('open-and-scroll', {
                                                                    detail: { fisher_id: fisher.id }
                                                                })
                            );
                    }, (error) => {
                        console.log(error);
                    });
                    
                }
            }));

            Alpine.data('chats', () => ({
                messages: [ ],
                newMessage: '',
                showChat: false,
                setMessages(fisher_id){
                    axios.post(`/boat/chat/get_messages/${fisher_id}`, {})
                    .then((response) => {
                       this.messages = response.data; 
                    }, (error) => {
                        console.log(error);
                    });
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
                openAndScrool(event){
                    alert('entrou2');
                    console.log(event.detail);
                    var fisher_id = event.detail.fisher_id;
                    setTimeout(() => {
                        this.showChat = true
                        var objDiv = document.getElementById("chat_fisher_" + fisher_id);
                        objDiv.scrollTop = objDiv.scrollHeight;
                    }, "50");
                },
            }));

        });
        
        // function addFisher(event){
        //     var fisher = event.detail.fisher;
        //     var message = event.detail.message;
        //     this.contacts.push({ fisher });
        //     setTimeout(() => {
        //         if (document.getElementById('fisher_' + fisher.id)) {
        //             document.getElementById('fisher_' + fisher.id).dispatchEvent(
        //                 new CustomEvent('add-fisher-message', {
        //                                     detail: { message: message, fisher_id: fisher.id }
        //                                 });
        //             );
        //         }
        //     }, "50");
        // }        
        
    </script>
  @endpush
</x-boat-layout>
