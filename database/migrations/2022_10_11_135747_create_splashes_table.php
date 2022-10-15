<?php

use App\Models\Fisher;
use App\Models\Language;
use App\Models\User;
use App\Models\Wave;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSplashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('splashes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->foreignIdFor(Wave::class);
            $table->foreignIdFor(Language::class)->default(1);
            $table->boolean('blocked')->default(false);
            $table->text('blocked_reason')->nullable();
            $table->integer('days_to_expire')->nullable();   

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
        Schema::dropIfExists('splashes');
    }
}
