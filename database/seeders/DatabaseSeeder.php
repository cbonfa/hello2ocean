<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // senha: password
        User::factory(['name' => 'César Bonfá', 'email' => 'bonfa@inaum.net', 'password' => bcrypt('12345678')])->create();
        
        // Fisher::factory(10)->create();
    }
}
