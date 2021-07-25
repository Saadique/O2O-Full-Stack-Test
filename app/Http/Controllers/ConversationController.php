<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Services\ServiceGateway;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    private $serviceGateway;

    public function __construct(ServiceGateway $serviceGateway)
    {
        $this->serviceGateway = $serviceGateway;
    }

    public function index()
    {

    }

    public function store(Request $request)
    {
        $requestBody = $request->all();
        return $this->serviceGateway->conversationService->createConversation($requestBody);
    }

    public function addPerson($conversation_id, $person_id){
        return $this->serviceGateway->conversationService->addPerson($conversation_id, $person_id);
    }

    public function removePerson($conversation_id, $person_id){
        return $this->serviceGateway->conversationService->removePerson($conversation_id, $person_id);
    }

    public function removeConversation($conversation_id){
        return $this->serviceGateway->conversationService->deleteConversation($conversation_id);
    }

    public function getConversationMembers($conversation_id){
        return $this->serviceGateway->conversationService->findAllMembersOfCon($conversation_id);
    }

    public function getAllMessagesByConversation($conversation_id){
        return $this->serviceGateway->conversationService->findAllMessagesByConversation($conversation_id);
    }

    public function getConversationsByOwner($owner_id){
        return $this->serviceGateway->conversationService->findConversationsByOwner($owner_id);
    }

    public function getConversationsByPerson($person_id){
        return $this->serviceGateway->conversationService->findConversationsByPerson($person_id);
    }

    public function show(Conversation $conversation)
    {
        //
    }



    public function update(Request $request, Conversation $conversation)
    {
        //
    }


    public function destroy(Conversation $conversation)
    {
        //
    }
}
