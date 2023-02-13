<?php

namespace Tests\Feature\Models;

use App\Models\Affinitie;
use App\Models\Chat;
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
            'password', 'language_id', 'birthdate', 'gender'
        ]), 1);
    }

    public function teste_create_fisher(){
        $this->assertInstanceOf(Fisher::class, Fisher::factory(['birthdate' => '19/05/1977'])->create()); 
    }

    public function test_return_fisher_net(){
        $fisher = Fisher::factory()->create();
        $friend = Fisher::factory()->create();
        Net::factory(['fisher_id' => $fisher->id, 'friend_id' => $friend->id])->create();
        $net = $fisher->net;
        $this->assertCount(1, $net);
    }

    public function test_return_fisher_from_net(){
        $fisher = Fisher::factory()->create();
        $friend = Fisher::factory()->create();
        Net::factory(['fisher_id' => $friend->id, 'friend_id' => $fisher->id])->create();
        $netFrom = $fisher->netFrom;
        $this->assertCount(1, $netFrom);
    }

    public function test_return_fisher_net_not_show_blocked_fishers(){
        $fisher = Fisher::factory()->create();
        $friend = Fisher::factory()->create();
        $friendBlocked = Fisher::factory()->create();
        Net::factory(['fisher_id' => $fisher->id, 'friend_id' => $friend->id])->create();
        Net::factory(['fisher_id' => $fisher->id, 'friend_id' => $friendBlocked->id, 'blocked' => true])->create();
        $net = $fisher->net;
        $this->assertCount(1, $net);
    }

    # teste union view net + fromNet
    public function test_return_fisher_net_view_all(){
        $fisher1 = Fisher::factory()->create();
        $fisher2 = Fisher::factory()->create();
        $fisher3 = Fisher::factory()->create();
        Net::factory(['fisher_id' => $fisher1->id, 'friend_id' => $fisher2->id])->create();
        Net::factory(['fisher_id' => $fisher3->id, 'friend_id' => $fisher1->id])->create();
        $net = $fisher1->allNet;
        $this->assertCount(2, $net);
    }

    public function test_return_fisher_affinitie(){
        $fisher = Fisher::factory()->create();
        $friend = Fisher::factory()->create();
        Affinitie::factory(['fisher_id' => $fisher->id, 'fisherman_id' => $friend->id])->create();
        $affinities = $fisher->affinities;
        $this->assertCount(1, $affinities);
    }

    public function test_return_fisher_affinities_from(){
        $fisher = Fisher::factory()->create();
        $friend = Fisher::factory()->create();
        Affinitie::factory(['fisher_id' => $friend->id, 'fisherman_id' => $fisher->id])->create();
        $affinitiesFrom = $fisher->affinitiesFrom;
        $this->assertCount(1, $affinitiesFrom);
    }

    public function test_return_fisher_affinities_not_show_blocked_fishers(){

        $fisher = Fisher::factory()->create();
        $friend = Fisher::factory()->create();
        $friendBlocked = Fisher::factory()->create();
        Affinitie::factory(['fisher_id' => $fisher->id, 'fisherman_id' => $friend->id])->create();
        Affinitie::factory(['fisher_id' => $fisher->id, 'fisherman_id' => $friendBlocked->id, 'join_date' => date("Y-m-d H:i:s")])->create();
        $affinities = $fisher->affinities;
        $this->assertCount(1, $affinities);
    }

    # teste union view affinitie + affinitiesFrom
    public function test_return_fisher_affinitie_view_all(){
        $fisher1 = Fisher::factory()->create();
        $fisher2 = Fisher::factory()->create();
        $fisher3 = Fisher::factory()->create();
        Affinitie::factory(['fisher_id' => $fisher1->id, 'fisherman_id' => $fisher2->id])->create();
        Affinitie::factory(['fisher_id' => $fisher3->id, 'fisherman_id' => $fisher1->id])->create();
        $affinities = $fisher1->allAffinities;
        $this->assertCount(2, $affinities);
    }

    public function test_fisher_show_chat_messages(){
        $fisher = Fisher::factory()->create();
        $chat = Chat::factory(['fisher_id' => $fisher->id])->create();
        $this->assertEquals(1, $fisher->chat->count());
        $this->assertTrue($fisher->chat->contains($chat));
    }

    public function test_fisher_show_chat_from_messages(){
        $fisher = Fisher::factory()->create();
        $receiver1 = Fisher::factory()->create();
        $receiver2 = Fisher::factory()->create();
        $chat1 = Chat::factory(['fisher_id' => $fisher->id, 'receiver_id' => $receiver1->id])->create();
        $chat2 = Chat::factory(['fisher_id' => $fisher->id, 'receiver_id' => $receiver2->id])->create();

        # teste by ID
        $this->assertEquals(1, $fisher->chat_from($receiver1->id)->count());
        # teste by fisher
        $this->assertEquals(1, $fisher->chat_from($receiver2)->count());

    }

    public function test_add_fisher_net(){
        $fisher = Fisher::factory()->create();
        $friend = Fisher::factory()->create();
        $fisher->addNet($friend->id);
        $this->assertCount(1, $fisher->net);
        $this->assertEquals($friend->id, $fisher->net->first()->id);
    }

    public function test_do_not_let_duplicity_fisher_net(){
        $fisher = Fisher::factory()->create();
        $friend = Fisher::factory()->create();
        $fisher->addNet($friend->id);
        $fisher->addNet($friend->id);
        $this->assertCount(1, $fisher->net);
        $this->assertEquals($friend->id, $fisher->net->first()->id);
    }

}
