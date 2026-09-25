<?php

namespace App\Http\Controllers\Hydrosphere;

use App\Enums\RevealableField;
use App\Http\Controllers\Controller;
use App\Models\AffinityThreshold;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AffinityThresholdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $affinityThresholds = AffinityThreshold::orderBy('min_affinity')->paginate(50);

        return view('hydrosphere.affinity_thresholds.index', compact('affinityThresholds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('hydrosphere.affinity_thresholds.create')
            ->with('fields', RevealableField::asSelectArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        AffinityThreshold::create($this->validated($request));

        return redirect()->route('hydrosphere.affinity_thresholds.index')
            ->with('success', __('affinity_thresholds.created_success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(AffinityThreshold $affinityThreshold): View
    {
        return view('hydrosphere.affinity_thresholds.show', compact('affinityThreshold'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AffinityThreshold $affinityThreshold): View
    {
        return view('hydrosphere.affinity_thresholds.edit', compact('affinityThreshold'))
            ->with('fields', RevealableField::asSelectArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AffinityThreshold $affinityThreshold): RedirectResponse
    {
        $affinityThreshold->update($this->validated($request, $affinityThreshold));

        return redirect()->route('hydrosphere.affinity_thresholds.show', $affinityThreshold)
            ->with('success', __('affinity_thresholds.updated_success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AffinityThreshold $affinityThreshold): RedirectResponse
    {
        $affinityThreshold->delete();

        return redirect()->route('hydrosphere.affinity_thresholds.index')
            ->with('success', __('affinity_thresholds.deleted_success'));
    }

    /**
     * @return array{field: string, min_affinity: int, description: ?string, active: bool}
     */
    private function validated(Request $request, ?AffinityThreshold $affinityThreshold = null): array
    {
        $data = $request->validate([
            'field' => [
                'required',
                new EnumValue(RevealableField::class),
                Rule::unique('affinity_thresholds', 'field')->ignore($affinityThreshold),
            ],
            'min_affinity' => 'required|integer|min:0|max:100',
            'description' => 'nullable|max:1000',
        ]);
        $data['active'] = $request->boolean('active');

        return $data;
    }
}
