<?php

namespace Tests\Feature;

use App\Models\People;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class PeopleTest extends TestCase
{
    use RefreshDatabase;


    public function getAllRegisteredPeople() {
        $this->json('get','api/people')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'email',
                            'password',
                            'created_at',
                            'updated_at'
                        ]
                    ]
                ]
            );
    }


    public function newUserRegistration() {
        $inputData = [
            "name"=>"Sadiq Zufer",
            "email"=>"sadiqzufer@gmail.com",
            "password"=>"123"
        ];

        $this->json('post','api/people', $inputData)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'email',
                        'password',
                        'created_at',
                        'updated_at'
                    ]
                ]
            );
        $this->assertDatabaseHas('users', $inputData);
    }


    public function getPersonById(){
        $person = People::create(
            [
                'name' => "Saadique Zufer",
                'email'  => "sadiqzufer@gmail.com",
                'password'      => "123"
            ]
        );

        $this->json('get', "api/people/$person->id")
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'data' => [
                        'id'         => $person->id,
                        'name'       => $person->name,
                        'email'      => $person->email,
                        'password'   => $person->password,
                        'created_at' => $person->created_at
                    ]
                ]
            );
    }
}
