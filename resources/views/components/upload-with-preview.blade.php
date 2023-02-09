@props(['label' => '', 'image_preview', 'wire_model' => 'false', 'button_text' => __('Select Image')])
{{-- alterar futuramente para funcionar sem o liviwire --}}
<div x-data="{photoName: null, photoPreview: null}" class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
  <!-- Photo File Input -->
  <input type="file" class="hidden" x-ref="photo" wire:model="{{ $wire_model }}" x-on:change="
                      photoName = $refs.photo.files[0].name;
                      const reader = new FileReader();
                      reader.onload = (e) => {
                          photoPreview = e.target.result;
                      };
                      reader.readAsDataURL($refs.photo.files[0]);
  ">

  <label class="block text-gray-700 text-sm mb-2 text-center" for="photo">
      {{ $label }}<span class="text-red-600"> </span>
  </label>
  
  <div class="text-center">
      <!-- Current Profile Photo -->
      <div class="mt-2" x-show="!photoPreview">
          <img src="{{ $image_preview }}"  class="w-40 h-40 m-auto rounded-full shadow">
      </div>
      <!-- New Profile Photo Preview -->
      <div class="mt-2" x-show="photoPreview" style="display: none;">
          <span class="block w-40 h-40 rounded-full m-auto shadow" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
          </span>
      </div>
      <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3" x-on:click.prevent="$refs.photo.click()">
        {{ $button_text }}
      </button>
      @error($wire_model) <div class="text-sm text-red-600">{{ $message }}</span> @enderror
  </div>
</div>