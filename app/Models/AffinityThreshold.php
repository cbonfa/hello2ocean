<?php

namespace App\Models;

use App\Enums\RevealableField;
use Database\Factories\AffinityThresholdFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffinityThreshold extends Model
{
    /** @use HasFactory<AffinityThresholdFactory> */
    use HasFactory;

    protected $fillable = ['field', 'min_affinity', 'description', 'active'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'min_affinity' => 'integer',
            'active' => 'boolean',
        ];
    }

    /**
     * Translated label of the field.
     */
    public function fieldLabel(): string
    {
        return RevealableField::hasValue($this->field)
            ? RevealableField::getDescription($this->field)
            : $this->field;
    }
}
