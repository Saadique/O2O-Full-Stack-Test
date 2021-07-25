<?php


namespace App\Services;


class ServiceGateway
{
    public $peopleService;
    public $messageService;
    public $conversationService;

    public function __construct(PeopleService $peopleService, MessageService $messageService,
                                ConversationService $conversationService){

        $this->peopleService = $peopleService;
        $this->messageService = $messageService;
        $this->conversationService = $conversationService;
    }
}
