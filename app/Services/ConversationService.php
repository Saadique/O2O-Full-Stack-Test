<?php


namespace App\Services;


use App\Events\PersonAddedToConversationEvent;
use App\Events\PersonRemovedFromConversationEvent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\People;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;

class ConversationService
{

    use ApiResponser;

    public function createConversation($requestBody){
        $conversation = Conversation::create($requestBody);
        $person_id = $requestBody['owner_id'];

        DB::insert("INSERT INTO participants(person_id, conversation_id)
        VALUES ($person_id, $conversation->id)");

        return $conversation;
    }

    public function addPerson($conversation_id, $person_id){
        $exists = DB::select("SELECT * FROM participants WHERE
                                 person_id=$person_id AND conversation_id=$conversation_id");
        if ($exists){
            return $this->errorResponse("Person Already Added", 400);
        }

        DB::insert("INSERT INTO participants(person_id, conversation_id)
        VALUES ($person_id, $conversation_id)");

        $person = People::findOrFail($person_id);
        $conversation = Conversation::findOrFail($conversation_id);

        event(new PersonAddedToConversationEvent($person, $conversation));

        return $this->successResponse("SUCCESS", 200);
    }

    public function removePerson($conversation_id, $person_id){
        DB::statement ("DELETE FROM participants WHERE person_id=$person_id AND
                               conversation_id=$conversation_id");


        $person = People::findOrFail($person_id);
        $conversation = Conversation::findOrFail($conversation_id);

        event(new PersonRemovedFromConversationEvent($person, $conversation));

        return $this->successResponse("SUCCESS", 200);
    }

    public function findAllMembersOfCon($conversation_id){
        $members = DB::select("SELECT * FROM people WHERE id IN
                           (SELECT person_id FROM participants WHERE conversation_id=$conversation_id)");
        return $members;
    }

    public function deleteConversation($conversation_id){
        DB::delete("DELETE FROM participants WHERE conversation_id=$conversation_id");
        DB::delete("DELETE FROM conversations WHERE id=$conversation_id");
        return $this->successResponse("SUCCESS", 200);
    }


    public function findAllMessagesByConversation($conversation_id){
        $conversation = Conversation::findOrFail($conversation_id);
        $messages = Message::where("conversation_id",$conversation->id)->with('person')->get();
        return $messages;
    }

    public function findConversationsByOwner($person_id){
        $conversations = Conversation::where("owner_id", $person_id)->get();
        return $conversations;
    }

    public function findConversationsByPerson($person_id){
        $conversations = DB::select("SELECT * FROM conversations WHERE id IN (SELECT participants.conversation_id
                                            FROM participants WHERE person_id=$person_id)
                                           AND id NOT IN (SELECT id from conversations WHERE owner_id=$person_id)");

        //SELECT * FROM conversations WHERE id IN (SELECT participants.conversation_id FROM participants WHERE person_id=2) AND owner_id!=2
        return $conversations;
    }
}
