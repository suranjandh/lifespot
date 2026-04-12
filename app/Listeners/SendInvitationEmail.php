<?php

namespace App\Listeners;

use App\Events\MemberCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvitationEmail
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
     * @param  MemberCreated  $event
     * @return void
     */
    public function handle(MemberCreated $event)
    {

    }
}
