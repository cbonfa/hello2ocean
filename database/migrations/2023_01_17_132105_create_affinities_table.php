<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affinities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fisher_id')->constrained();
            $table->foreignId('fisherman_id')->constrained('fishers');
            $table->dateTime('join_date')->nullable();
            $table->dateTime('last_show')->nullable();
            $table->dateTime('hidden_date')->nullable();
            $table->dateTime('blocked_date')->nullable();
            $table->integer('affinity')->nullable(); # percentual de afinidade
            $table->bigInteger('points')->nullable(); # numero de drops que bateram
            $table->bigInteger('drops')->nullable(); # numero de drops respondidos
            $table->bigInteger('splashs')->nullable(); # numero de splashs respondidos
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
        Schema::dropIfExists('affinities');
    }
};
