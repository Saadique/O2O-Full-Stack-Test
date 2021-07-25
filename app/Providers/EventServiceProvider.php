<?php

namespace App\Providers;

use App\Events\NewPersonHasRegisteredEvent;
use App\Events\PersonHasBeenAddedToAConversation;
use App\Events\PersonHasBeenRemovedFromConversation;
use App\Listeners\RemovedMailListener;
use App\Listeners\WelcomeNewPersonListener;
use App\Listeners\WelcomeToConversationMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        NewPersonHasRegisteredEvent::class => [
            WelcomeNewPersonListener::class,
        ],
        PersonHasBeenAddedToAConversation::class => [
            WelcomeToConversationMail::class
        ],
        PersonHasBeenRemovedFromConversation::class => [
            RemovedMailListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
