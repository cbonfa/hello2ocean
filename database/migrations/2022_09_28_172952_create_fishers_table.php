<?php

use App\Models\Country;
use App\Models\Language;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fishers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('nick')->nullable();
            $table->string('nick_image')->nullable();
            $table->string('email')->unique();
            $table->date('birthdate')->nullable();
            $table->string('gender', 2)->nullable();
            $table->string('cep')->nullable();
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('complemento')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city')->nullable();
            $table->string('uf')->nullable();
            $table->string('zipcode')->nullable();
            $table->text('international_address')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('long', 10, 7)->nullable();
            $table->dateTime('geo_ip_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_sign_in_at')->nullable();
            $table->string('password')->nullable();
            $table->dateTime('premium_until')->nullable();
            $table->integer('sign_in_count')->default(0);            
            $table->string('secret_code')->nullable()->unique();
            $table->foreignIdFor(Language::class)->nullable();
            $table->foreignIdFor(Country::class)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('fishers');
    }
}
