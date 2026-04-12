<?php

namespace App\Listeners;

use App\Email;
use App\EmailQueue;
use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $user = $event->user ;
        $email_queue_obj = new EmailQueue();
        $email_obj = new Email();

        $mail_settings = array(
            'to' => $user->email,
            'to_name' => $user->first_name . ' ' . $user->last_name,
            'subject'=> 'Welcome to LifeSpot '.$user->first_name
        );
        $mail_settings = $email_obj->get_welcome_email_total_settings($mail_settings);
        $email_queue_obj->push_to_queue($mail_settings,$user->id);
      /*  $email_queue_obj = new EmailQueueModel();
        $mail_settings = array(
            'to' => $email,
            'to_name' => $first_name . ' ' . $last_name,
            'subject'=> 'Welcome to LifeSpot '.$first_name
        );
        $mail_settings = $email_queue_obj->get_welcome_email_total_settings($mail_settings);
        $email_queue_obj->push_to_queue($mail_settings);*/
    }
}
