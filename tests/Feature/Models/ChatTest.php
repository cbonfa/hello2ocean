<?php

namespace Tests\Feature;

use App\Models\Chat;
use App\Models\Fisher;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use DatabaseTransactions;

    public function test_chat_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('chats', [
            'id','fisher_id', 'receiver_id', 'text_sent', 'received_text'
        ]), 1);
    }

    public function teste_create_chat(){
        $this->assertInstanceOf(Chat::class, Chat::factory()->create()); 
    }

    public function test_chat_has_fisher() {
        $fisher = Fisher::factory()->create();
        $chat = Chat::factory(['fisher_id' => $fisher->id ])->create();
        $this->assertInstanceOf(Fisher::class, $chat->fisher);
    }

    public function test_chat_has_received_by() {
        $receiver = Fisher::factory()->create();
        $chat = Chat::factory(['receiver_id' => $receiver->id ])->create();
        $this->assertInstanceOf(Fisher::class, $chat->received);
    }

}
