<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBottlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bottles', function (Blueprint $table) {
            $table->id();
            # $table->integer('user_id')->unsigned();
            $table->unsignedBigInteger('fisher_id');
            $table->foreign('fisher_id')->references('id')->on('fishers');
            $table->unsignedBigInteger('splash_id');
            $table->foreign('splash_id')->references('id')->on('splashes');            
            $table->unsignedBigInteger('drop_id');
            $table->foreign('drop_id')->references('id')->on('drops');
            $table->integer('answer');
            $table->boolean('ignore')->default(false);
                        
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
        Schema::dropIfExists('bottles');
    }
}
