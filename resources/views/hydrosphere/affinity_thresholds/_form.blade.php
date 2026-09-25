    @isset($affinityThreshold->id)
        <form method="POST" action="{{ route('hydrosphere.affinity_thresholds.update', $affinityThreshold->id) }}" accept-charset="UTF-8">
        @csrf
        @method('PUT')
    @else
        <form method="POST" action="{{ route('hydrosphere.affinity_thresholds.store') }}" accept-charset="UTF-8">
        @csrf
    @endisset
    <div>
        <x-select
        name="field"
        :label="__('affinity_thresholds.field')"
        class="w-full"
        includeBlank="{{ __('affinity_thresholds.choose_field') }}"
        :list="$fields"
        :selected="old('field', $affinityThreshold->field ?? '')" />
    </div>
    <div>
        <x-input
            :label="__('affinity_thresholds.min_affinity')"
            id="min_affinity" class="block mt-1 w-full"
            type="number"
            min="0"
            max="100"
            name="min_affinity"
            :value="old('min_affinity', $affinityThreshold->min_affinity ?? '')" />
    </div>
    <div>
        <x-textarea
        :label="__('all.description')"
        class="w-full flex-auto"
        rows="4"
        name="description"
        >{{ old('description', $affinityThreshold->description ?? '') }}</x-textarea>
    </div>
    <div>
        <x-checkbox
            :label="__('all.active')"
            id="active" class="block mt-1 w-full"
            name="active"
            :checked="old('active', $affinityThreshold->active ?? true)" />
    </div>

    <div>
        <hr>
    </div>
    <div class="mt-5">
        <x-button
        class="w-full bg-blue-500 hover:bg-blue-700"
        >
            {{ __('affinity_thresholds.save') }}
        </x-button>
    </div>
    </form>
