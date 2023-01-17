<?php

use App\Models\Fisher;
use Illuminate\Database\Migrations\Migration;
use Staudenmeir\LaravelMergedRelations\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::createMergeViewWithoutDuplicates(
        'view_affinities',
        [(new Fisher())->affinities(), (new Fisher())->affinitiesFrom()]
    );
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW view_affinities');
    }
};
