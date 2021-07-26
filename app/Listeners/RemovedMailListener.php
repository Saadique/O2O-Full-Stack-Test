<?php

namespace App\Listeners;

use App\Mail\AddedToConversationMail;
use App\Mail\RemovedFromConversationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class RemovedMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $mailData = [
            "name"=>$event->personRemoved->name,
            "conversation_title"=>$event->conversationRemoved->title
        ];
        Mail::to($event->personRemoved->email)->send(new RemovedFromConversationMail($mailData));
    }
}
