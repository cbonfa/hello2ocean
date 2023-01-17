<?php

namespace Tests\Feature\Models;

use App\Models\Fisher;
use App\Models\Net;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class FisherTest extends TestCase
{
    use DatabaseTransactions;

    protected $dropViews = true;

    public function test_fisher_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('fishers', [
            'id','name', 'nick', 'sign_in_count', 'profile_image', 'nick_image',
            'email', 'email_verified_at', 'last_sign_in_at', 
            'password', 'language_id'
        ]), 1);
    }

    public function teste_create_fisher(){
        $this->assertInstanceOf(Fisher::class, Fisher::factory()->create()); 
    }

    public function test_return_fisher_net(){
        $fisher = Fisher::factory()->create();
        $friend = Fisher::factory()->create();
        Net::factory(['fisher_id' => $fisher->id, 'friend_id' => $friend->id])->create();
        $net = $fisher->net;
        $this->assertCount(1, $net);
    }

    public function test_return_fisher_net_not_show_blocked_fisher(){
        $fisher = Fisher::factory()->create();
        $friend = Fisher::factory()->create();
        $friendBlocked = Fisher::factory()->create();
        Net::factory(['fisher_id' => $fisher->id, 'friend_id' => $friend->id])->create();
        Net::factory(['fisher_id' => $fisher->id, 'friend_id' => $friendBlocked->id, 'blocked' => true])->create();
        $net = $fisher->net;
        $this->assertCount(1, $net);
    }

    public function test_return_fisher_net_view_all(){
        $fisher1 = Fisher::factory()->create();
        $fisher2 = Fisher::factory()->create();
        $fisher3 = Fisher::factory()->create();
        Net::factory(['fisher_id' => $fisher1->id, 'friend_id' => $fisher2->id])->create();
        Net::factory(['fisher_id' => $fisher3->id, 'friend_id' => $fisher1->id])->create();
        $net = $fisher1->allNet;
        $this->assertCount(2, $net);
    }

}
