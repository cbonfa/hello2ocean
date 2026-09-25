<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('all.hydrosphere') }}
        </h2>
    </x-slot>
    <!-- will be used to show any messages -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs p-8">
                <x-hydrosphere-title
                    title="{{ __('affinity_thresholds.index') }}"
                    subtitle="{{ __('affinity_thresholds.explanation') }}"
                />

                <table class="tablemobile w-full flex-row flex-no-wrap overflow-hidden my-5">
                    <thead class="border-gray-300 text-indigo-600">
                        @foreach($affinityThresholds as $affinityThreshold)
                            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                                <td>{{ __('all.id') }}</td>
                                <td>{{ __('affinity_thresholds.field') }}</td>
                                <td>{{ __('affinity_thresholds.min_affinity') }}</td>
                                <td>{{ __('all.active') }}</td>
                                <td class="actions">{{ __('all.actions') }}</td>
                            </tr>
                        @endforeach
                    </thead>

                    <tbody class="bg-white sm:flex-none">
                        @foreach($affinityThresholds as $key => $value)
                            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                                <td class="text-sm text-indigo-900 border-b border-gray-400">{{ $value->id }}</td>
                                <td class="text-sm text-indigo-900 border-b border-gray-400">{{ $value->fieldLabel() }}</td>
                                <td class="text-sm text-indigo-900 border-b border-gray-400">{{ $value->min_affinity }}%</td>
                                <td class="text-sm text-indigo-900 border-b border-gray-400">{{ to_sn($value->active) }}</td>
                                <td class="text-sm text-indigo-900 border-b border-gray-400">
                                    <form action="{{ route('hydrosphere.affinity_thresholds.destroy',$value->id) }}" method="POST">
                                        <div class="flex flex-row">
                                            <div class="flex-1 px-1">
                                                <x-button-show :href="route('hydrosphere.affinity_thresholds.show',$value->id)">
                                                    {{ __('all.show') }}
                                                </x-button-show>
                                            </div>
                                            <div class="flex-1 px-1">
                                                <x-button-edit :href="route('hydrosphere.affinity_thresholds.edit',$value->id)">
                                                    {{ __('all.edit') }}
                                                </x-button-edit>
                                            </div>
                                            <div class="flex-1 px-1">
                                                <x-button-delete confirm="{{ __('all.are_you_sure_delete') }}" >{{ __('all.delete') }}</x-button>
                                                @csrf
                                                @method('DELETE')
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                </table>

                {!! $affinityThresholds->links() !!}
                </div>
                <div class="mt-5 px-2">
                    <x-button-link class="bg-blue-500 hover:bg-blue-800 block" :href="route('hydrosphere.affinity_thresholds.create')">
                        {{ __('affinity_thresholds.create') }}
                    </x-button-link>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
