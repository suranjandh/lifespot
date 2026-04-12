<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    protected $table = 'messages';

    protected $primaryKey = 'message_id';

    protected $guarded = ['message_id'];

    public $timestamps = false;

    public function get_message_enabled_users()
    {
        /*$query = "SELECT users.user_id , members.* FROM members
 JOIN users ON  (members.member_owner_user_id = users.user_id AND  members.member_associated_user = {$this->user_id} ) 
  OR (members.member_associated_user = users.user_id
 AND members.member_owner_user_id = {$this->user_id})";
        $execution = $this->select_query($query);
        if ($execution && $this->numResults > 0) {
            return $this->result;
        }
        return array();*/
        /*$message_enabled_users = DB::select(DB::raw('users.id as user_id , members.*'))
            ->table("members")
            ->join("users",DB::raw("(members.member_owner_user_id = users.id AND  members.member_associated_user = ".auth()->user()->id." ) 
  OR (members.member_associated_user = users.id
 AND members.member_owner_user_id = ".auth()->user()->id));*/
        $query = "SELECT users.id as user_id , members.* FROM members
 JOIN users ON  (members.member_owner_user_id = users.id AND  members.member_associated_user = " . auth()->user()->id . " ) 
  OR (members.member_associated_user = users.id
 AND members.member_owner_user_id = " . auth()->user()->id . ")";

        $message_enabled_users = DB::select($query);
        return $message_enabled_users;
    }


    public function get_message_enable_users_data()
    {
        $message_enable_users_data = array();
        $message_enable_users = $this->get_message_enabled_users();
        if ($message_enable_users) {
            foreach ($message_enable_users as $user) {
                if($user->member_associated_user == auth()->user()->id)continue ; // no need of adding own member
                $data = array(
                    'user_id' => '',
                    'full_name' => '',
                    'image_path' => '',
                    'user_role_in_estate' => ''
                );
                if ($user->user_id != $user->member_owner_user_id) { // is a member  get data of member object
                    $data['user_id'] = $user->member_associated_user;
                    $data['full_name'] = $user->member_first_name . ' ' . $user->member_last_name;
                    $member = Member::find($user->member_id);
                    $data['image_path'] = $member->get_member_image_url($member);
                    $main_role = $member->main_role($member->roles);
                    $main_role_name = $main_role ? $main_role->role_name : '';
                    $data['user_role_in_estate'] = $main_role_name;//$roles_obj_item->get_main_role($member);
                } else { // is a user account - get data of  user object
                    $data['user_id'] = $user->user_id;
                    $profile = auth()->user()->profile;
                    $data['full_name'] = $profile->profile_first_name . ' ' . $profile->profile_last_name;
                    $data['image_path'] = $profile->get_profile_image($profile);
                }
                $message_enable_users_data[] = $data;
            }
        }
        return $message_enable_users_data;
    }

    public function get_users_message_groups_data()
    {
        $users_message_groups_data = array();
        $users_message_groups = $this->get_users_message_groups();
        if ($users_message_groups) {
            foreach ($users_message_groups as $users_message_groups_item) {
                $data = array(
                    'group_id' => $users_message_groups_item->message_group_id,
                    'group_owner_user_id' => $users_message_groups_item->message_group_owner_user_id,
                    'group_member_user_ids' => $users_message_groups_item->message_group_members_user_ids,
                    'group_name' => $users_message_groups_item->message_group_name
                );
                $users_message_groups_data[] = $data;
            }
        }
        return $users_message_groups_data;
    }

    public function get_users_message_groups()
    {

        /*  $query = "SELECT * FROM message_group_members
   JOIN  message_groups ON message_groups.message_group_id = message_group_members.message_group_members_group_id
   WHERE message_group_members_user_id = {$this->user_id}";
           $execution = $this->select_query($query);
           if ($execution && $this->numResults > 0) {
               return $this->result;
           }
           return array();*/

        $users_message_groups = DB::table('message_group_members')
            ->join('message_groups', 'message_groups.message_group_id', '=', 'message_group_members.message_group_members_group_id')
            ->where('message_group_members_user_id', '=', auth()->user()->id)->get();
        return $users_message_groups;

    }

    public function get_message_group_members($message_group_id)
    {
        /*  $where = "  message_group_members_group_id = {$message_group_id} ";
          $join = "  JOIN users ON  {$this->message_group_members_table}.message_group_members_user_id
           = users.user_id";
          $join .= "  LEFT JOIN members ON  members.member_associated_user = users.user_id AND member_associated_user > 0 AND
          member_owner_user_id = {$this->user_id}";
          $execution = $this->select($this->message_group_members_table, '*', $where, null, $join);
          if ($execution && $this->numResults > 0) {
              return $this->result;
          }
          return array();
          */
        $query = "SELECT * , users.id as user_id from message_group_members 
JOIN users ON message_group_members_user_id    = users.id
 LEFT JOIN members ON  members.member_associated_user = users.id AND member_associated_user > 0 AND
        member_owner_user_id = " . auth()->user()->id . "
        where message_group_members_group_id = {$message_group_id} 
";
        $message_group_members = DB::select(DB::raw($query));

        /*  DB::select(DB::raw('users.id as user_id , *'))
      ->table('message_group_members')
          ->join("users","message_group_members_user_id","=","users.user_id")
          ->leftJoin("members",DB::raw("members.member_associated_user = users.user_id AND member_associated_user > 0 AND
      member_owner_user_id =".auth()->user()->id))
      ->where('message_group_members_group_id','=',$message_group_id);*/

        return $message_group_members;
    }

    public function get_messages_with_member_user($member_user_id)
    {
        $query = "SELECT * FROM messages
LEFT JOIN members ON members.member_associated_user  = message_from_user AND members.member_associated_user  > 0
AND member_owner_user_id = " . auth()->user()->id . "
WHERE ( message_from_user = {$member_user_id} AND message_to_user = " . auth()->user()->id . " ) OR 
                             ( message_from_user = " . auth()->user()->id . " AND message_to_user = {$member_user_id} )
 ORDER BY message_created_time";
        /* $execution = $this->select_query($query);
         if ($execution && $this->numResults > 0) {
             return $this->result;
         }
         return array();*/
        return DB::select(DB::raw($query));
    }

    public function reset_message_channels($message_channel_data)
    {
        $query = " UPDATE message_channels SET message_channel_count = 0 WHERE ";
        $query .= " message_channel_type =  {$message_channel_data['message_channel_type']} ";
        $query .= " AND message_channel_owner_user =  {$message_channel_data['message_channel_owner_user']} ";
        $query .= " AND message_channel_sender =  {$message_channel_data['message_channel_sender']} ";

        DB::statement(DB::raw($query));
    }

    public function get_message_group_by_id($message_group_id)
    {
        /*$where = "  message_group_id = {$message_group_id} ";
        $execution = $this->select($this->message_groups_table, '*', $where, null, null, 1);
        if ($execution && $this->numResults == 1) {
            return $this->result[0];
        }
        return array();*/
        $query = "SELECT * FROM message_groups WHERE message_group_id = {$message_group_id} ";
        return DB::select(DB::raw($query))[0];
    }

    public function get_messages_with_message_group($message_group_id)
    {
        $query = "SELECT messages.* , members.* , users.first_name FROM messages
LEFT JOIN members ON members.member_associated_user  = message_from_user AND members.member_associated_user  > 0
  AND member_owner_user_id = " . auth()->user()->id . "
JOIN users ON users.id = messages.message_from_user
WHERE  message_message_group_id = {$message_group_id}
 ORDER BY message_created_time";
        /* $execution = $this->select_query($query);
         if ($execution && $this->numResults > 0) {
             return $this->result;
         }
         return array();*/
        return DB::select(DB::raw($query));
    }


    public function insert_message($message)
    {
        //$insert_id = $this->insert($this->table_name, array_values($message), array_keys($message));
        $message = Message::create($message);
        $this->add_hooks($message->message_id);
        return $message->message_id;
    }

    public function add_hooks($message_id)
    {
        $this->insert_or_update_message_channel($message_id);
    }

    public function insert_or_update_message_channel($message_id)
    {
        $message = Message::find($message_id);
        if ($message->message_message_group_id > 0) {
            $message_group = $this->get_message_group_by_id($message->message_message_group_id);
            if ($message_group) {
                foreach (explode('|', $message_group->message_group_members_user_ids)
                         as $message_group_member_user_id) {
                    if ($message_group_member_user_id == $this->user_id) continue;
                    $where = " message_channel_type  = 2 AND message_channel_owner_user = {$message_group_member_user_id} 
            AND  message_channel_sender = {$message['message_message_group_id']} ";
                    $message_channel = $this->get_message_channel($where);
                    if ($message_channel) {
                        $this->increase_message_channel_by_id($message_channel->message_channel_id);
                    } else {
                        $message_channel_data = array(
                            'message_channel_type' => 2,
                            'message_channel_owner_user' => $message_group_member_user_id,
                            'message_channel_sender' => $message->message_message_group_id
                        );
                        $this->add_new_message_channel($message_channel_data);
                    }
                }
            }
        } else {
            $where = " message_channel_type  = 1 AND message_channel_owner_user = {$message->message_to_user} 
            AND  message_channel_sender = {$message->message_from_user} ";
            $message_channel = $this->get_message_channel($where);
            if ($message_channel) {
                $this->increase_message_channel_by_id($message_channel->message_channel_id);
            } else {
                $message_channel_data = array(
                    'message_channel_type' => 1,
                    'message_channel_owner_user' => $message->message_to_user,
                    'message_channel_sender' => $message->message_from_user
                );
                $this->add_new_message_channel($message_channel_data);
            }
        }
    }

    public function get_message_channel($where)
    {
        /*$message_channel = array();
        $execution = $this->select($this->message_channel_table, '*', $where, null, null, 1);
        if ($execution && $this->numResults == 1) {
            $message_channel = $this->result[0];
        }*/
        $query = "SELECT * FROM message_channels WHERE " . $where;
        /* $execution = $this->select_query($query);
         if ($execution && $this->numResults > 0) {
             return $this->result;
         }
         return array();*/
        return DB::select(DB::raw($query))[0];
    }

    public function increase_message_channel_by_id($message_channel_id)
    {

        $query = " UPDATE message_channels SET message_channel_count = message_channel_count + 1
  WHERE message_channel_id =  {$message_channel_id} ";
        // $this->update_query($query);
        DB::statement(DB::raw($query));
    }

    public function add_new_message_channel($message_channel)
    {

        //$this->insert($this->message_channel_table, array_values($message_channel), array_keys($message_channel));
        DB::table('message_channels')->insert($message_channel);
    }

    public function get_message_by_id_advanced($message_id)
    {
        $query = "SELECT messages.* , members.* , users.first_name FROM messages
LEFT JOIN members ON members.member_associated_user  = message_from_user AND members.member_associated_user  > 0
JOIN users ON users.id = messages.message_from_user
WHERE   message_id = {$message_id} LIMIT 1";
        /* $execution = $this->select_query($query);
         if ($execution && $this->numResults == 1) {
             return $this->result[0];
         }
         return array();*/
        return DB::select(DB::raw($query))[0];
    }

    public function get_message_groups_by_user_id()
    {
        /*$where = "  message_group_owner_user_id = {$user_id} ";
        $execution = $this->select($this->message_groups_table, '*', $where);
        if ($execution && $this->numResults > 0) {
            return $this->result;
        }
        return array();*/
        $query = "SELECT * FROM message_groups WHERE message_group_owner_user_id = " . auth()->user()->id;
        return DB::select(DB::raw($query));

    }

    public function message_group_exsists($message_group)
    {
        /* $where = " message_group_members_user_ids = '{$message_group['message_group_members_user_ids']}'
          AND  message_group_owner_user_id =  {$message_group['message_group_owner_user_id']} ";
         $execution = $this->select($this->message_groups_table, '*', $where);*/
        $query = "SELECT * FROM message_groups WHERE message_group_members_user_ids = '{$message_group['message_group_members_user_ids']}'
         AND  message_group_owner_user_id =  {$message_group['message_group_owner_user_id']}";
        $message_group = DB::select(DB::raw($query))[0];
        //if ($execution) {
        if ($message_group) {
            return $message_group;
        } else {
            return 0;
        }
        //} else {
        //     return -1;
        //}
    }


    public function create_message_group($message_group)
    {

        //$message_group_id = $this->insert($this->message_groups_table, array_values($message_group), array_keys($message_group));
        $message_group = DB::table('message_groups')->insert($message_group);
                 $message_group_id = DB::getPdo()->lastInsertId();
                 return $message_group_id ;
//$message_group->message_group_id;
    }


    public function update_message_group_members($message_group, $message_group_id)
    {
        /*$where = " message_group_members_group_id = {$message_group_id} ";
        $this->delete($this->message_group_members_table, $where);
        foreach (explode('|', $message_group['message_group_members_user_ids']) as $message_group_members_user_id) {
            $message_group_members = array(
                'message_group_members_group_id' => $message_group_id,
                'message_group_members_user_id' => $message_group_members_user_id
            );
            $this->insert($this->message_group_members_table, array_values($message_group_members), array_keys($message_group_members));
        }
        return true;*/

        DB::table('message_group_members')->where('message_group_members_group_id', $message_group_id)->delete();
        foreach (explode('|', $message_group['message_group_members_user_ids']) as $message_group_members_user_id) {
            $message_group_members = array(
                'message_group_members_group_id' => $message_group_id,
                'message_group_members_user_id' => $message_group_members_user_id
            );
            DB::table('message_group_members')->insert($message_group_members);
            //$this->insert($this->message_group_members_table, array_values($message_group_members), array_keys($message_group_members));
            return true;
        }
    }

    public function is_user_owner_of_group($group_id)
    {
       // $message_group = $this->get_message_group_by_id($group_id);
        $message_group =  DB::table('message_group_members')->where('message_group_id',$group_id)->get();
        return $message_group->message_group_owner_user_id == auth()->user()->id;
    }


    public function delete_message_group($group_id)
    {
        if ($this->is_user_owner_of_group($group_id)) {
           // $this->delete($this->message_groups_table, "message_group_id = $group_id ");
          //  $this->delete($this->message_group_members_table, "message_group_members_group_id = $group_id ");
            DB::table('message_groups')->where('message_group_id','=',$group_id)->delete();
            DB::table('message_group_members')->where('message_group_members_group_id','=',$group_id)->delete();
            return true;
        }
        return false;
    }

}
