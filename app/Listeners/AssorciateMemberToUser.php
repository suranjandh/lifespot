<?php

namespace App\Listeners;

use App\Events\MemberCreated;
use App\Member;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssorciateMemberToUser
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
     * @param  MemberCreated $event
     * @return void
     */
    public function handle($event)
    {
        $member = $event->member;
        $member_email = $member->member_email;
        $member_associated_user = $member->member_associated_user;
        if ($member_email && $member_associated_user == 0) {
            $user = User::where(['email'=> $member_email])->first();
            if ($user) {
                $member->member_associated_user = $user->id;
                $member->save();
            }
        }
    }
}
