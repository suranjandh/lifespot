<?php

namespace App\Http\Controllers;

use App\Email;
use App\EmailQueue;
use App\Helpers\Helper;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class EmailController extends Controller
{
    public function process_queue(){
        $email_queue = new EmailQueue();
        $number_of_emails_sent = $email_queue->process_queue();
        echo $number_of_emails_sent ;
    }

    public function ajax_validate_member_email()
    {
        $member = Member::find(Input::get('member_id'));
        if($member){
            $validated = Helper::email_address_validated($member->member_email);
            if($validated){
                return Helper::success_message();
            }
        }
        return Helper::error_message();
    }

    public function ajax_get_invitation_email(){
        $member_id = Input::get('member_id');

        $custom_message_invitation_email = Input::get('custom_message_invitation_email');;

        if ($member_id) {
            $member = Member::find($member_id);
            if ($member) {

                $member_roles = $member->roles ;
                $main_role =  $member->main_role($member_roles) ;
                $roles_set_first = $main_role ? $main_role->role_name : "";
                $roles_set_first = $roles_set_first ? $roles_set_first : " member ";


                $mail_settings = array(
                    'template' => 'invitation_email',
                    'template_bindings' => array(
                        'user_main_role' => $roles_set_first,
                        'custom_message' => $custom_message_invitation_email,
                        'sender_name' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
                        'first_name' => $member->member_first_name,
                        'member_id' => $member->member_id
                    )
                );
                $email_obj = new Email();
                $invitation_email = $email_obj->get_email_template_for_settings($mail_settings);
                echo $invitation_email;
                die();
            }
        }
    }

    public function ajax_send_invitation_email(){
        $member_id = Input::get('member_id');

        $custom_message_invitation_email = Input::get('custom_message_invitation_email');

        if ($member_id) {
            $member = Member::find($member_id);
            if ($member) {

                $member_roles = $member->roles ;
                $main_role = $member->main_role($member_roles) ;
                $roles_set_first = $main_role ? $main_role->role_name : "";
                $roles_set_first = $roles_set_first ? $roles_set_first : " member ";


                $mail_settings = array(
                    'to' => $member->member_email,
                    'to_name' => $member->member_first_name . ' ' . $member->member_last_name,

                    'reply_to' => auth()->user()->email,
                    'reply_to_name' => auth()->user()->first_name . ' ' . auth()->user()->last_name ,
                    'template_bindings' => array(
                        'user_main_role' => $roles_set_first,
                        'custom_message' => $custom_message_invitation_email,
                        'member_id' => $member_id,
                        'sender_name' => auth()->user()->first_name . ' ' .  auth()->user()->last_name ,
                        'first_name' => $member->member_first_name,
                        'accept_buttons' => true,
                    )
                );


                $email_queue_obj = new EmailQueue();
                $email_obj = new Email();
                $mail_settings = $email_obj->get_invitation_email_total_settings($mail_settings);
                $invitation_email = $email_queue_obj->push_to_queue($mail_settings);

                if ($invitation_email && $member->member_invitation_status < 1) {
                    $member->member_invitation_status = 1 ;
                    $member->save();
                }
            }
        }
    }
}
