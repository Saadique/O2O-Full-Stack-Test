<?php

namespace Tests\Feature;

use App\Models\Conversation;
use App\Models\People;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ConversationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;


    public function createConversation() {

        $person = People::create(
            [
                'name' => "Saadique Zufer",
                'email'  => "sadiqzufer@gmail.com",
                'password'      => "123"
            ]
        );

        $inputData = [
            'title'    =>"Football Club",
            'owner_id' =>$person->id
        ];


        $this->json('post',"api/conversations",$inputData)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'title',
                        'owner_id',
                        'created_at',
                        'updated_at'
                    ]
                ]
            );
    }
}
