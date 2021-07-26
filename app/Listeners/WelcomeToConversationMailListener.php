<?php

namespace App\Listeners;

use App\Mail\AddedToConversationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeToConversationMailListener
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
            "name"=>$event->personAdded->name,
            "conversation_title"=>$event->conversationAdded->title
        ];
        Mail::to($event->personAdded->email)->send(new AddedToConversationMail($mailData));
    }
}
