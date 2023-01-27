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
        $fisher = Fisher::factory(['name' => 'Fisher Teste', 'email' => 'fisher@gmail.com', 'password' => bcrypt('12345678'), 'nick_image' => url('images/profile1.jpg')])->create();
        $fisher1 = Fisher::factory(['name' => 'Fisher Teste 1', 'email' => 'fisher1@gmail.com', 'password' => bcrypt('12345678'), 'nick_image' => url('images/profile1.jpg')])->create();
        $fisher2 = Fisher::factory(['name' => 'Fisher Teste 2', 'email' => 'fisher2@gmail.com', 'password' => bcrypt('12345678'), 'nick_image' => url('images/profile2.jpg')])->create();
        $fisher3 = Fisher::factory(['name' => 'Fisher Teste 3', 'email' => 'fisher3@gmail.com', 'password' => bcrypt('12345678'), 'nick_image' => url('images/profile3.jpg')])->create();

        # Cria Miguchos
        Net::factory(['fisher_id' => $fisher->id, 'friend_id' => $fisher1->id, 'affinity' => 60])->create();
        Net::factory(['fisher_id' => $fisher->id, 'friend_id' => $fisher2->id, 'affinity' => 80])->create();

        Net::factory(['fisher_id' => $fisher1->id, 'friend_id' => $fisher->id, 'affinity' => 80])->create();
        Net::factory(['fisher_id' => $fisher3->id, 'friend_id' => $fisher2->id, 'affinity' => 100])->create();


    }
}
