<?php
namespace App\Services;

use App\Models\Message;
use App\Traits\ApiResponser;

class MessageService
{
    use ApiResponser;

    function createMessage($requestBody){
        $message = Message::create($requestBody);
        return $message;
    }

    function deleteMessage($message_id){
        $message = Message::findOrFail($message_id);
        $message->delete();
        return $this->successResponse("SUCCESS", 200);
    }
}
