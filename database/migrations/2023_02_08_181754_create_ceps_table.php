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
        Schema::create('ceps', function (Blueprint $table) {
            $table->id();
            $table->string('cep')->unique()->index();
            $table->string('logradouro')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('localidade')->nullable();
            $table->string('uf')->nullable();
            $table->integer('ibge')->nullable();
            $table->integer('gia')->nullable();
            $table->integer('ddd')->nullable();
            $table->integer('siafi')->nullable();
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
        Schema::dropIfExists('ceps');
    }
};
