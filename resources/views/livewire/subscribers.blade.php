<div class="p-6 bg-white border-b border-gray-200">
    <p class="text-2xl text-gray-600 font-bold mb-6 underline">
        Subscribers
    </p>

    <div class="px-8">
        <x-input
            type="text" 
            class="rounded-lg border float-right border-gray-300 mb-4 pl-8 w-1/3"
            placeholder="search"
            wire:model="search"
        >

        </x-input>
        @if ($subscribers->isEmpty())
            <div class="flex w-full bg-red-100 p-5 rounded-lg">
                <p class="text-red-400">
                    No subscribers found.
                </p>    
            </div>
        @else
            <table class="w-full">
                <thead class="norder border-b-2 border-gray-300 text-indigo-600">
                    <tr>
                        <td class="px-6 py-3 text-left">e-mail</td>
                        <td class="px-6 py-3 text-left">verified</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach ( $subscribers as $subscribe)
                    <tr class="text-sm text-indigo-900 border-b border-gray-400">
                        <td class="px-6 py-4">
                            {{ $subscribe->email }}
                        </td>
                        <td class="px-6 py-4">    
                            {{ optional($subscribe->email_verified_at)->diffForHumans() ?? 'Never' }}
                        </td>
                        <td class="px-6 py-4">
                            <x-button
                                class="border border-red-500 text-red-500 bg-red-50 hover:bg-red-100"
                                wire:click="delete({{ $subscribe->id }})"
                            >
                                Delete
                            </x-button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                {{-- @dd($subscribers) --}}
            </table>
        @endif
    </div>
</div>