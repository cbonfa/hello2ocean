<?php

namespace Tests\Feature;

use App\Enums\RevealableField;
use App\Models\AffinityThreshold;
use Database\Seeders\AffinityThresholdSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AffinityThresholdSeederTest extends TestCase
{
    use DatabaseTransactions;

    public function test_seeder_creates_a_threshold_for_every_revealable_field()
    {
        $this->seed(AffinityThresholdSeeder::class);

        $this->assertEqualsCanonicalizing(
            RevealableField::getValues(),
            AffinityThreshold::pluck('field')->all()
        );
        $this->assertDatabaseHas('affinity_thresholds', ['field' => RevealableField::ProfileImage, 'min_affinity' => 60]);
    }

    public function test_seeder_keeps_thresholds_configured_in_the_hydrosphere()
    {
        AffinityThreshold::factory(['field' => RevealableField::Email, 'min_affinity' => 30])->create();

        $this->seed(AffinityThresholdSeeder::class);

        $this->assertDatabaseHas('affinity_thresholds', ['field' => RevealableField::Email, 'min_affinity' => 30]);
    }

    public function test_public_fields_are_always_visible()
    {
        $this->seed(AffinityThresholdSeeder::class);

        $this->assertDatabaseHas('affinity_thresholds', ['field' => RevealableField::Country, 'min_affinity' => 0]);
        $this->assertDatabaseHas('affinity_thresholds', ['field' => RevealableField::Language, 'min_affinity' => 0]);
    }

    public function test_identifying_and_locating_fields_need_more_affinity()
    {
        $this->seed(AffinityThresholdSeeder::class);
        $min = AffinityThreshold::pluck('min_affinity', 'field');

        $this->assertLessThan($min[RevealableField::ProfileImage], $min[RevealableField::City]);
        $this->assertLessThan($min[RevealableField::Name], $min[RevealableField::ProfileImage]);
        $this->assertLessThan($min[RevealableField::Email], $min[RevealableField::Name]);
        $this->assertLessThan($min[RevealableField::Address], $min[RevealableField::Email]);
        $this->assertEquals(100, $min[RevealableField::Lat]);
        $this->assertEquals(100, $min[RevealableField::Long]);
    }

    public function test_seeder_can_run_twice_without_duplicating()
    {
        $this->seed(AffinityThresholdSeeder::class);
        $this->seed(AffinityThresholdSeeder::class);

        $this->assertEquals(count(RevealableField::getValues()), AffinityThreshold::count());
    }
}
