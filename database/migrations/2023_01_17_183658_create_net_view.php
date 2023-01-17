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
        'view_net',
        [(new Fisher())->net(), (new Fisher())->netFrom()]
    );
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW view_net');
    }
};
