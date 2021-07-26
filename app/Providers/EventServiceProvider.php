<?php

namespace App\Providers;

use App\Events\NewPersonHasRegisteredEvent;
use App\Events\PersonAddedToConversationEvent;
use App\Events\PersonRemovedFromConversationEvent;
use App\Listeners\RemovedMailListener;
use App\Listeners\WelcomeNewPersonListener;
use App\Listeners\WelcomeToConversationMailListener;
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
        PersonAddedToConversationEvent::class => [
            WelcomeToConversationMailListener::class
        ],
        PersonRemovedFromConversationEvent::class => [
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
