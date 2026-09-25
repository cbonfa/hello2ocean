<?php

namespace Database\Seeders;

use App\Enums\RevealableField;
use App\Models\AffinityThreshold;
use Illuminate\Database\Seeder;

/**
 * Default affinity needed to reveal each fisher field.
 *
 * The more sensitive the data is under the LGPD (Lei Geral de Proteção de
 * Dados), the higher the affinity: generic data comes first, then data that
 * identifies the person (photo, name, e-mail) and, last, data that locates
 * them (address and exact geolocation).
 */
class AffinityThresholdSeeder extends Seeder
{
    /**
     * @var array<string, int>
     */
    private const THRESHOLDS = [
        RevealableField::Country => 0,
        RevealableField::Language => 0,
        RevealableField::Uf => 20,
        RevealableField::City => 30,
        RevealableField::Gender => 40,
        RevealableField::Birthdate => 50,
        RevealableField::ProfileImage => 60,
        RevealableField::Name => 70,
        RevealableField::Neighborhood => 75,
        RevealableField::Email => 80,
        RevealableField::Cep => 85,
        RevealableField::Zipcode => 85,
        RevealableField::Address => 95,
        RevealableField::Number => 95,
        RevealableField::Complement => 95,
        RevealableField::InternationalAddress => 95,
        RevealableField::Lat => 100,
        RevealableField::Long => 100,
    ];

    /**
     * Run the database seeds. Thresholds already configured in the
     * hydrosphere are kept untouched.
     */
    public function run(): void
    {
        foreach (self::THRESHOLDS as $field => $minAffinity) {
            AffinityThreshold::firstOrCreate(
                ['field' => $field],
                ['min_affinity' => $minAffinity, 'active' => true],
            );
        }
    }
}
