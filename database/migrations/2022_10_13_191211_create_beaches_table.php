<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beaches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('language_id')->default(1);
            $table->foreign('language_id')->references('id')->on('languages');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beaches');
    }
}
