<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('affinity_thresholds', function (Blueprint $table) {
            $table->id();
            // Fisher field, see App\Enums\RevealableField
            $table->string('field', 50)->unique();
            // minimum affinity percentage (0 - 100) to reveal the field
            $table->unsignedTinyInteger('min_affinity');
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affinity_thresholds');
    }
};
