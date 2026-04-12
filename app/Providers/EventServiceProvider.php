<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /*Registered::class => [
            SendEmailVerificationNotification::class,
        ],*/
        'App\Events\UserRegistered' => [
            'App\Listeners\SendWelcomeEmail',
        ],
        'App\Events\MemberCreated' => [
            'App\Listeners\AssorciateMemberToUser',
            'App\Listeners\SendInvitationEmail',
        ],
        'App\Events\MemberEdited' => [
            'App\Listeners\AssorciateMemberToUser',
        ],
        Registered::class=> [
            'App\Listeners\AssorciateUserToMembers',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
