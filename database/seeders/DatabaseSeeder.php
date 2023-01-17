<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Language;
use App\Models\Fisher;
use App\Models\Net; 
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
        
        # Cria Pescadores
        $fisher1 = Fisher::factory(['name' => 'Fisher Teste 1', 'email' => 'fisher1@gmail.com', 'password' => bcrypt('12345678')])->create();
        $fisher2 = Fisher::factory(['name' => 'Fisher Teste 2', 'email' => 'fisher2@gmail.com', 'password' => bcrypt('12345678')])->create();
        $fisher3 = Fisher::factory(['name' => 'Fisher Teste 3', 'email' => 'fisher3@gmail.com', 'password' => bcrypt('12345678')])->create();

        # Cria Miguchos
        Net::factory(['fisher_id' => $fisher1->id, 'friend_id' => $fisher2->id])->create();
        Net::factory(['fisher_id' => $fisher1->id, 'friend_id' => $fisher3->id])->create();
    }
}
