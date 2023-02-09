<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
    <form wire:submit.prevent="update()" enctype="multipart/form-data">
        @csrf
        <x-boat-info-alert/>
        <x-boat-title 
            title="{{ __('boat.fisher.edit.title') }}"
            subtitle="{{ __('boat.fisher.edit.subtitle') }}"
        />

        <div>
            <x-input 
                :label="__('all.nick')"
                id="nick" class="block mt-1 w-full"
                type="text"
                name="nick"
                :placeholder="__('boat.fisher.edit.placeholder.nick')" 
                wire:model.defer="nick" />
        </div>

        <div>
            <x-input 
                :label="__('all.name')"
                id="name" class="block mt-1 w-full"
                type="text"
                name="name"
                :placeholder="__('boat.fisher.edit.placeholder.profile')" 
                wire:model.defer="name" />
        </div>

        <div>
            <x-upload-with-preview
                :label="__('boat.fisher.edit.nick.image')"
                image_preview="{{ auth()->user()->nick_image }}"
                :button_text="__('boat.fisher.edit.button_text.nick')"
                wire_model="nick_image" />
        </div>        
        <div>
            <x-upload-with-preview
                :label="__('boat.fisher.edit.profile.image')"
                image_preview="{{ auth()->user()->profile_image }}"
                :button_text="__('boat.fisher.edit.button_text.profile')"
                wire_model="profile_image" />
        </div>
        <div>
            <hr>
        </div>
        <div class="mt-5">
            <x-button 
            class="w-full bg-blue-500 hover:bg-blue-700"
            >
            {{ __('boat.fisher.edit.save') }}
            </x-button>
        </div>
    </form>
</div>
