<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            # don't remember category motivation
            # $table->integer('category')->default(0) # yes ou no
            $table->string('image')->nullable();
            # referencia a si mesmo, se foi reaproveitada
            $table->unsignedBigInteger('drop_id')->nullable();
            $table->foreign('drop_id')->references('id')->on('drops');
            $table->unsignedBigInteger('splash_id');
            $table->foreign('splash_id')->references('id')->on('splashes');
            $table->unsignedBigInteger('language_id')->default(1);
            $table->foreign('language_id')->references('id')->on('languages');
            $table->boolean('blocked')->default(false);
            $table->text('blocked_reason')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('fisher_id')->nullable();
            $table->foreign('fisher_id')->references('id')->on('fishers');  
            # $table->string('IP', 128)->nullable();
               
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
        Schema::dropIfExists('drops');
    }
}
