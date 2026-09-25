<?php

namespace Tests\Feature\Models;

use App\Enums\RevealableField;
use App\Models\AffinityThreshold;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AffinityThresholdTest extends TestCase
{
    use DatabaseTransactions;

    public function test_affinity_thresholds_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('affinity_thresholds', [
            'id', 'field', 'min_affinity', 'description', 'active',
        ]));
    }

    public function test_create_affinity_threshold()
    {
        $this->assertInstanceOf(AffinityThreshold::class, AffinityThreshold::factory()->create());
    }

    public function test_casts_min_affinity_and_active()
    {
        $affinityThreshold = AffinityThreshold::factory(['min_affinity' => '60', 'active' => 1])->create()->fresh();

        $this->assertSame(60, $affinityThreshold->min_affinity);
        $this->assertTrue($affinityThreshold->active);
    }

    public function test_field_must_be_unique_in_database()
    {
        AffinityThreshold::factory(['field' => RevealableField::Email])->create();

        $this->expectException(QueryException::class);
        AffinityThreshold::factory(['field' => RevealableField::Email])->create();
    }

    public function test_field_label_is_translated()
    {
        $affinityThreshold = AffinityThreshold::factory(['field' => RevealableField::ProfileImage])->make();

        app()->setLocale('en');
        $this->assertEquals('Profile photo', $affinityThreshold->fieldLabel());

        app()->setLocale('pt_BR');
        $this->assertEquals('Foto de perfil', $affinityThreshold->fieldLabel());
    }

    public function test_field_label_falls_back_to_the_raw_field()
    {
        $affinityThreshold = new AffinityThreshold(['field' => 'removed_field']);

        $this->assertEquals('removed_field', $affinityThreshold->fieldLabel());
    }

    public function test_every_revealable_field_is_a_fisher_column()
    {
        $this->assertTrue(Schema::hasColumns('fishers', RevealableField::getValues()));
    }

    public function test_every_revealable_field_has_translation_in_all_locales()
    {
        foreach (['en', 'pt_BR'] as $locale) {
            foreach (RevealableField::getKeys() as $key) {
                $value = RevealableField::getValue($key);
                $this->assertTrue(
                    Lang::has('enums.'.RevealableField::class.'.'.$value, $locale, false),
                    "Missing {$locale} translation for RevealableField::{$key}"
                );
            }
        }
    }
}
