<?php

use App\Models\Fisher;
use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waves', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignIdFor(Language::class)->default(1);
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(Fisher::class)->nullable();
            $table->boolean('blocked')->default(false);
            $table->text('blocked_reason')->nullable();
            # Referring to Upper Wave
            $table->unsignedBigInteger('wave_id_main')->nullable();;
            $table->foreign('wave_id_main')->references('id')->on('waves');
            # Reference to same language
            $table->unsignedBigInteger('wave_id_language')->nullable();;
            $table->foreign('wave_id_language')->references('id')->on('waves');
            # $table->string('IP', 128)->nullable();
            
            $table->timestamps();
        });
    }

    # $table->unsignedBigInteger('language_id')->default(1);
    # $table->foreign('language_id')->references('id')->on('languages');    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('waves');
    }
}
