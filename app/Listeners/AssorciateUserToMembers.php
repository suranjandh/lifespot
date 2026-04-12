<?php

namespace App\Listeners;

use App\Member;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssorciateUserToMembers
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user ;
        $user_id = $user->id ;
        $user_email = $user->email ;
        $members = Member::where(['member_email'=>$user_email,'member_associated_user'=> 0])->get();
        $user_is_kid = false ;
        foreach ($members as $member){
            if($member->member_is_dependent($member)) {
                $member_age = $member->get_member_age($member);
                if ($member_age !== false && $member_age < 18) {
                    $user_is_kid = true;
                }
            }
            if($member->member_is_friend($member)){
                $user_is_kid = true;
            }
            $member->member_associated_user = $user_id ;
            $member->save();
        }

        if($user_is_kid){
            User::find($user->id)->update(['user_access'=>1]);
        }
    }
}
