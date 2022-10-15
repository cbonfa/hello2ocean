<?php

use App\Models\Drop;
use App\Models\Fisher;
use App\Models\Language;
use App\Models\Splash;
use App\Models\User;
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
            $table->foreignIdFor(Drop::class)->nullable();
            $table->foreignIdFor(Splash::class);
            $table->foreignIdFor(Language::class)->default(1);

            $table->boolean('blocked')->default(false);

            # O Splash é necessário para entendimento da "pergunta" drops
            $table->boolean('splash_needed')->nullable();

            $table->text('blocked_reason')->nullable();
            
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(Fisher::class)->nullable();
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
