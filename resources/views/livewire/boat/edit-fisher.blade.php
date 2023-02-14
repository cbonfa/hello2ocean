<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8" x-data>
    <form wire:submit.prevent="update()" enctype="multipart/form-data">
        @csrf
        <x-boat-info-alert/>
        <x-boat-title 
            title="{{ __('boat.fisher.edit.title') }}"
            subtitle="{{ __('boat.fisher.edit.subtitle') }}"
        />

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
                :placeholder="__('boat.fisher.edit.placeholder.name')" 
                wire:model.defer="name" />
        </div>

        <div>
            <x-data-mask 
                :label="__('all.birthdate')"
                id="birthdate" class="block mt-1 w-full"
                type="text"
                name="birthdate"
                placeholder="DD/MM/YYYY"
                wire:model.defer="birthdate"
                />
        </div>
        <div>
            <x-select
            name="gender"
            :label="__('all.gender')"
            class="w-full"
            includeBlank="{{__('boat.fisher.edit.choose_your_gender')}}"
            wire:model.defer="gender"
            :list="$genders"
            :selected="old('gender', auth()->user()->gender ?? '')" />                        
        </div>
        <div>
            <x-input 
                :label="__('all.cep')"
                id="cep" class="block mt-1 w-full"
                type="text"
                name="cep"
                :placeholder="__('boat.fisher.edit.placeholder.cep')" 
                wire:model.defer="cep" />
        </div>
        <div>
            <x-input 
                :label="__('all.address')"
                id="address" class="block mt-1 w-full"
                type="text"
                name="address"
                :placeholder="__('boat.fisher.edit.placeholder.address')" 
                wire:model.defer="address" />
        </div>
        <div>
            <x-input 
                :label="__('all.number')"
                id="number" class="block mt-1 w-full"
                type="text"
                name="number"
                :placeholder="__('boat.fisher.edit.placeholder.number')" 
                wire:model.defer="number" />
        </div>
        <div>
            <x-input 
                :label="__('all.complement')"
                id="complement" class="block mt-1 w-full"
                type="text"
                name="complement"
                :placeholder="__('boat.fisher.edit.placeholder.complement')" 
                wire:model.defer="complement" />
        </div>
        <div>
            <x-input 
                :label="__('all.neighborhood')"
                id="neighborhood" class="block mt-1 w-full"
                type="text"
                name="neighborhood"
                :placeholder="__('boat.fisher.edit.placeholder.neighborhood')" 
                wire:model.defer="neighborhood" />
        </div>
        <div>
            <x-input 
                :label="__('all.city')"
                id="city" class="block mt-1 w-full"
                type="text"
                name="city"
                :placeholder="__('boat.fisher.edit.placeholder.city')" 
                wire:model.defer="city" />
        </div>
        <div>
            <x-input 
                :label="__('all.uf')"
                id="uf" class="block mt-1 w-full"
                type="text"
                name="uf"
                :placeholder="__('boat.fisher.edit.placeholder.uf')" 
                wire:model.defer="uf" />
        </div>
        <div>
            <x-input 
                :label="__('all.zipcode')"
                id="zipcode" class="block mt-1 w-full"
                type="text"
                name="zipcode"
                :placeholder="__('boat.fisher.edit.placeholder.zipcode')" 
                wire:model.defer="zipcode" />
        </div>
        <div>
            <x-textarea 
                :label="__('all.international_address')"
                id="international_address" class="block mt-1 w-full"
                type="text"
                name="international_address"
                :placeholder="__('boat.fisher.edit.placeholder.international_address')" 
                wire:model.defer="international_address" />
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
