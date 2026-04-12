<?php

namespace App;

use App\Helpers\Helper;
use App\Email;
use Illuminate\Database\Eloquent\Model;

class EmailQueue extends Model
{


    public $table = 'email_queue';

    protected $primaryKey = 'email_queue_id';

    protected $guarded = ['email_queue_id'];

    public $email_limit = 5;



    public function push_to_queue($mail_settings,$user_id = 0)
    {
        $email_queue = array(
           // 'email_queue_settings' => $this->escape_string(json_encode($mail_settings)),
            'email_queue_settings' =>json_encode($mail_settings),
            'email_queue_template' => $mail_settings['template'],
            'email_queue_user_id' => $user_id
        );
        if (Helper::email_address_validated($mail_settings['to'])) {
            //$execution = $this->insert($this->table_name, array_values($email_queue), array_keys($email_queue));
            EmailQueue::create($email_queue);
        }
        return true ;
    }


    public function get_from_queue_ordered($limit = 0)
    {
      /*  $limit = $limit ? $limit : $this->email_limit;
        $execution = $this->select($this->table_name, "*", null, " RAND() ", null, $limit);
        if ($execution && $this->numResults > 0) {
            return $this->result;
        }
        return array();*/
        $limit = $limit ? $limit : $this->email_limit;
        return EmailQueue::inRandomOrder()->take($limit)->get();
    }

    public function process_queue()
    {
        /*
        $emails = $this->get_from_queue_ordered();
        $email_counter = 0;
        foreach ($emails as $email) {
            $email_settings = json_decode($email['email_queue_settings'], true);
            $sent = $this->send_email($email_settings);
            if ($sent) {
                $email_counter++;
                $email_queue_id = $email['email_queue_id'];
                $this->delete_email_queue($email_queue_id);
            } else {
                $email_update = array(
                    'email_queue_fail_times' => $email['email_queue_fail_times'] + 1
                );
                $this->update_email_queue_by_id($email['email_queue_id'], $email_update);
                $this->email_queue_fail_hooks($email);
            }
        }
        return $email_counter;
        */
        $emails = $this->get_from_queue_ordered();
        $email_counter = 0;
        foreach ($emails as $email) {
            $email_queue_id = $email->email_queue_id ;
            $email_settings = json_decode($email->email_queue_settings, true);
           // $sent = $this->send_email($email_settings);
            $email_obj = new Email();
            $sent = $email_obj->send_email($email_settings);
            if ($sent) {
                $email_counter++;
              //  $email_queue_id = $email['email_queue_id'];
           //     $this->delete_email_queue($email_queue_id);
                EmailQueue::find($email_queue_id)->delete();
            } else {
                $email_update = array(
                    'email_queue_fail_times' => $email->email_queue_fail_times + 1
                );
                EmailQueue::find($email_queue_id)->update($email_update);
                $this->email_queue_fail_hooks($email);
          //      $this->update_email_queue_by_id($email['email_queue_id'], $email_update);
          //      $this->email_queue_fail_hooks($email);
            }
        }
        return $email_counter;
    }

   /* public function delete_email_queue($email_queue_id)
    {
        $this->delete($this->table_name, " email_queue_id = $email_queue_id ");
    }*/

 /*   public function update_email_queue_by_id($email_queue_id, $email_update)
    {
        $this->update($this->table_name, $email_update, " email_queue_id = $email_queue_id ");
    }*/

   /* public function get_users_emails($email_queue_template = '')
    {

        $where = " email_queue_user_id = {$this->user_id} ";
        $where .= $email_queue_template ? " AND email_queue_template = '{$email_queue_template}' " : " ";
        $execution = $this->select($this->table_name, '*', $where);
        if ($execution && $this->numResults > 0) {
            return $this->result;
        }
        return array();
    }*/

    public function email_queue_fail_hooks($email)
    {
        /* if ($email['email_queue_template'] == 'invitation_email.php') {
             $member_id = $email['email_queue_settings']['template_bindings']['member_id'];*/
            if ($email->email_queue_template == 'invitation_email.php') {
                $member_id = $email->email_queue_settings['template_bindings']['member_id'];
          //  $member_obj = new MemberModel();
            $member = Member::find($member_id); //$member_obj->get_member_by_id($member_id);
            if ($member) {
                if ($member->member_invitation_status != 3) {
                    $member->member_invitation_status =  $member->member_invitation_status  > 0 ? -1 : $member->member_invitation_status  -1 ;
                    $member->save();
                   // $member_invitation_status = $member->member_invitation_status  > 0 ? -1 : $member->member_invitation_status  -1 ;
                   // $member_details = array('member_invitation_status' => $member_invitation_status);
                   // $member_obj->update_member_by_id($member_details, $member_id);
                }
            }
        }
    }


}


