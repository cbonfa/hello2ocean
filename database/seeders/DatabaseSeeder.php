<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Language;
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
        
        Language::create(['id' => 1,
                         'description' => 'Português',
                         'country' => 'Brasil', 
                         'country_code' => 'BR',
                         'locale' => 'pt_BR',
                         'active' => true,
                        ]);

        Language::create(['id' => 2,
                        'description' => 'English',
                         'country' => 'Estados Unidos', 
                         'country_code' => 'USA',
                         'locale' => 'en',
                         'active' => false,
                        ]);                        
        // Fisher::factory(10)->create();
    }
}
