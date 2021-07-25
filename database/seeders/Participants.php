<?php

namespace Database\Seeders;

use App\Models\Conversation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class Participants extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 50) as $index) {
            try {
                DB::table('participants')->insert([
                    'person_id' => rand(1,13),
                    'conversation_id' => rand(1,20)
                ]);
            }catch (\Exception $e){
                continue;
            }

        }

        $conversations = Conversation::all();
        foreach ($conversations as $conversation){
            try {
                DB::table('participants')->insert([
                    'person_id' => $conversation->owner_id,
                    'conversation_id' => $conversation->id
                ]);
            }catch (\Exception $e){
                continue;
            }
        }
    }
}
