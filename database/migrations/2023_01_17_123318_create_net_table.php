<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fishnet Friends 
     *
     * @return void
     */
    public function up()
    {
        Schema::create('net', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fisher_id')->constrained();
            $table->foreignId('friend_id')->constrained('fishers');
            $table->string('profile_image')->default('profile_image');
            $table->dateTime('join_date')->nullable();
            $table->string('display_name')->default('nick');
            $table->boolean('blocked')->default(false);
            $table->integer('affinity')->default(0); # percentual de afinidade
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
        Schema::dropIfExists('net');
    }
};
