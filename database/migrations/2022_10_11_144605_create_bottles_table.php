<?php

use App\Models\Drop;
use App\Models\Fisher;
use App\Models\Splash;
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

            $table->foreignIdFor(Fisher::class);
            $table->foreignIdFor(Splash::class);
            $table->foreignIdFor(Drop::class);

            $table->integer('answer');
            $table->boolean('ignore')->default(false);
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
        Schema::dropIfExists('bottles');
    }
}
