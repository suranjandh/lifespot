<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Member extends Model
{

    protected $table = 'members';

    protected $primaryKey = 'member_id';

    protected $guarded = ['member_id'];

    use LogsActivity;


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['member_first_name']);
    }


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            if (\Auth::check()) {
                $model->member_owner_user_id = auth()->user()->id;
            }
            if (Input::get('action_on') == 'Spouse') {
                $model->member_relationship_to_owner = 18;
            }
        });
        /* \App\Member::created(function ($model) {
             $EmptyLog = new EmptyLog();
             $EmptyLog->process_empty_log($model);
         });
         \App\Member::updated(function ($model) {
             $EmptyLog = new EmptyLog();
             $EmptyLog->process_empty_log($model);
         });*/
        \App\Member::updated(function ($model) {
            $EmptyLog = new EmptyLog();
            $EmptyLog->process_empty_log($model);
        });
        \App\Member::created(function ($model) {
            $EmptyLog = new EmptyLog();
            $EmptyLog->process_empty_log($model);
        });
    }

    /*    public function member_relationship_to_owner()
    {
        return Relationship::get_relationship_name_by_relationship_id($this->member_relationship_to_owner);
    }*/


    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'member_owner_user_id');
    }

    public function members_user_account()
    {
        return $this->belongsTo('App\User', 'id', 'member_associated_user');
    }

    /*public function roles()
    {
        return $this->belongsToMany('App\Role', 'member_roles',
            'member_roles_role', 'member_roles_member');
    }*/

    /*public function products()
    {
        return $this->belongsToMany('App\Product');
    return $this->belongsToMany('App\Product', 'products_shops',
      'shops_id', 'products_id');
    }*/

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'roles_members',
            'roles_members_member', 'roles_members_role');
    }

    public function dependent_medical()
    {
        return $this->hasOne('App\DependentMedical', 'dependent_medical_member_id', 'member_id');
    }

    public function dependent_school()
    {
        return $this->hasOne('App\DependentSchool', 'dependent_school_member_id', 'member_id');
    }

    public function guardian()
    {
        return $this->hasOne('App\Member', 'member_id', 'member_guardian_member_id');
    }

    public function get_guardians_dependents($guardian_member_id)
    {
        return Member::where('member_guardian_member_id', $guardian_member_id)->get();
    }

    public static function only_member_type_members()
    {

        $except_other_type_members = [
            ['member_owner_user_id', '=', auth()->user()->id],
            ['member_is_spouse', '!=', 1],
            ['member_is_dependent', '!=', 1],
            ['member_is_beneficiary', '!=', 1],
            ['member_is_emergency_contact', '!=', 1],
            ['member_is_friend', '!=', 1]
        ];
        $members_except_other_type_members = Member::where($except_other_type_members)->get();
        return $members_except_other_type_members;

    }

    public function guardians_dependents_member_ids_set($guardian_member_id)
    {
        $dependents = $this->get_guardians_dependents($guardian_member_id);
        $dependents_member_ids_set = array();
        foreach ($dependents as $dependent) {
            $dependents_member_ids_set[] = $dependent->member_id;
        }
        return $dependents_member_ids_set;
    }

    public function role_ids_array($roles)
    {
        $role_ids = array();
        foreach ($roles as $role) {
            $role_ids[] = $role->role_id;
        }
        return $role_ids;
    }

    public function main_role($roles)
    {
        $main_role = null;
        foreach ($roles as $role) {
            $main_role = $main_role == null || $main_role->role_id > $role->role_id ? $role : $main_role;
        }
        return $main_role;
    }

    public function role_has_guardian($roles)
    {
        foreach ($roles as $role) {
            if ($role->role_id == Role::get_role_guardian()) return true;
        }
        return false;
    }

    public function get_member_full_name($member)
    {
        if ($member)
            return "{$member->member_first_name} {$member->member_last_name}";
        else return "";
    }

    public function member_is_dependent($member)
    {
        return $member->member_is_dependent == 1;
    }

    public function member_is_friend($member)
    {
        return $member->member_is_friend == 1;
    }

    public function member_type($member)
    {
        if ($member->member_is_spouse == 1) {
            return 'spouse';
        } elseif ($member->member_is_dependent == 1) {
            return 'dependent';
        } elseif ($member->member_is_friend == 1) {
            return 'friend';
        } elseif ($member->member_is_beneficiary == 1) {
            return 'beneficiary';
        } elseif ($member->member_is_emergency_contact == 1) {
            return 'emergency_contact';
        }
        return 'member';
    }

    public function set_member_types(Member $member, $member_roles = array(), $action_on = '')
    {
        // action on
        if ($action_on == 'Spouse') {
            $member->member_is_spouse = 1;
        } elseif ($action_on == 'Dependent') {
            $member->member_is_dependent = 1;
        } elseif ($action_on == 'Friend') {
            $member->member_is_friend = 1;
        }

        if ($action_on == 'Beneficiary') {
            $member->member_is_beneficiary = 1;
        }
        if ($action_on == 'EmergencyContact') {
            $member->member_is_emergency_contact = 1;
        }
        // member roles
        if (in_array(Role::get_role_beneficiary(), $member_roles)) {
            $member->member_is_beneficiary = 1;
        }
        if (in_array(Role::get_role_emergency_contact(), $member_roles)) {
            $member->member_is_emergency_contact = 1;
        }

        $member->save();
        return $member;
    }

    public function member_is_spouse($member)
    {
        return $member->member_is_spouse == 1;
    }

    public function member_user_account($member)
    {
        $user = User::find($member->member_associated_user);
        return $user ? $user : false;
    }

    public function member_has_email($member)
    {
        return isset($member->member_email) && $member->member_email && trim($member->member_email) != '' ?
            $member->member_email : '';
    }

    public function get_member_invitation_status_text($member)
    {
        $member_invitation_status = $member->member_invitation_status;
        $member_associated_user = $member->member_associated_user;
        $member_invitation_status_text = "Invitation Email Not Sent";
        if ($member_invitation_status == 1) {
            $member_invitation_status_text = "Invitation Email Sent";
        } elseif ($member_invitation_status == 2) {
            $member_invitation_status_text = "Invitation Email Opened";
        } elseif ($member_invitation_status == 3) {
            $member_invitation_status_text = "Clicked Accept.";
            $member_invitation_status_text .= $member_associated_user > 0 ? " And User Created " : " . User not Created Yet";
        } elseif ($member_invitation_status == 4) {
            $member_invitation_status_text = "Clicked Decline";
            $member_invitation_status_text .= $member_associated_user > 0 ? " But Has A Lifespot Account" : " ";
        }
        return $member_invitation_status_text;
    }


    public static function search_member($member_first_name = '', $member_last_name = '', $current_member_id = 0)
    {
        $where_array = array();
        if ($member_first_name) {
            $where_array[] = " member_first_name  LIKE '$member_first_name%' ";
        }
        if ($member_last_name) {
            $where_array[] = " member_last_name  LIKE '$member_last_name%' ";
        }

        if ($where_array) {
            $where_array[] = " member_owner_user_id  = " . auth()->user()->id;
            if ($current_member_id) {
                $where_array[] = " member_id != " . $current_member_id;
            }
        } else {
            return array();
        }

        $where = implode(' AND ', $where_array);
        $results = DB::select(
            DB::raw(
                "SELECT * FROM members WHERE $where "));

        return $results;
    }


    public static function get_members_set_for_roles($role_ids_array)
    {
        /* $member_set_for_roles = array();
         $members_of_user = $this->get_members_by_owner_user_id($this->user_id);
         foreach ($members_of_user as $member){
             $roles = $this->get_member_roles_array($member);
             if(array_intersect($roles,$role_ids_array)){
                 $member_set_for_roles[] = $member ;
             }
         }
         return $member_set_for_roles ;*/
        $role_ids_in = implode(',', $role_ids_array);
        $members = Member::join('roles_members', 'roles_members.roles_members_member', '=', 'members.member_id')
            ->whereIn('roles_members_roles_id', $role_ids_array)->where('member_owner_user_id', 1)->get();
        $member_set_for_roles = array();
        foreach ($members as $member) {
            $member_set_for_roles[$member->member_id] = $member;
        }
        return $member_set_for_roles;
    }


    public static function get_member_ids_comma_separated($member_set)
    {
        $member_ids = array();
        foreach ($member_set as $member) {
            $member_ids[] = $member['member_id'];
        }
        return implode(",", $member_ids);
    }

    public static function get_member_ids_set_for_roles($role_ids_array)
    {
        $members_set = self::get_members_set_for_roles($role_ids_array);
        return self::get_member_ids_comma_separated($members_set);
    }


    public function member_deactivated_his_account($member)
    {
        if (!($member->member_associated_user > 0)) return false;
        $is_active_member = User::is_active_user($member['member_associated_user']);
        return !$is_active_member;
    }

    public function get_member_address($member)
    {
        $address_content = array();
        $address_content_fields = array(
            'member_address', 'member_address2', 'member_city', 'member_state', 'member_zip'
        );
        foreach ($address_content_fields as $v) {
            if (trim($member->$v) != '') $address_content[] = $member->$v;
        }

        return implode(" , ", $address_content);
    }

    public function get_member_role_names_string($member)
    {
        $role_names_string_array = array();
        $roles_set = $member->roles;
        if (empty($roles_set)) return "";
        /*$roles_set_ar = explode("|", $roles_set);
        $roles_obj = new RolesModel();
        if ($roles_set_ar) {
            foreach ($roles_set_ar as $role) {
                $role_names_string_array[] = $roles_obj->get_role_name_by_role_id($role);
            }
            return implode(', ', array_unique($role_names_string_array));
        }*/
        foreach ($roles_set as $role) {
            $role_names_string_array[] = $role->role_name;
        }
        return implode(', ', array_unique($role_names_string_array));
    }


    public function get_member_birthday($member)
    {
        return $member->member_bday > 0 ? date('m/d/Y', strtotime($member->member_bday)) : "";
    }


    public function get_member_image_url($member)
    {
        /* $member_type = 'current_member';
         if ($this->member_is_spouse($member)) {
             $member_type = 'current_spouse';
         } elseif ($this->member_is_dependent($member)) {
             $member_type = 'current_dependent';
         }
         elseif ($this->member_is_beneficiary($member)) {
             $member_type = 'current_beneficiary';
         }
         elseif ($this->member_is_emergency_contact($member)) {
             $member_type = 'current_emergency_contact';
         }*/
        //$image_folder_url = $member_type == 'current_dependent' ? DEPENDENT_PROFILE_IMG_URL : MEMBER_IMG_URL;
        $member_image = trim($member->member_image) != '' ? Config::get('constants.MEMBER_IMG_URL') . $member->member_image . '?rand=' . rand(1, 1000) : Config::get('constants.DEFAULT_AVATAR_IMAGE_URL');
        return $member_image;
    }

    public static function get_invited_estates_list_for_user()
    {

        /* $invited_estates_list = array();
         $where = " member_associated_user = {$user_id}  ";
         $join = " JOIN estates ON members.member_owner_user_id = estates.estate_user_id ";
         $execution = $this->select($this->table_name, '*', $where, null, $join, null);
         if ($execution && $this->numResults > 0) {
             $invited_estates_list = $this->result;
         }
         return $invited_estates_list;*/
        return Member::join('estates', 'members.member_owner_user_id', '=', 'estates.estate_user_id')
            ->where("member_associated_user", "=", auth()->user()->id)->get();
    }

    public function get_member_birth_day($member)
    {
        return $member->member_birth_day > 0 ? date('m/d/Y', strtotime($member->member_birth_day)) : "";
    }

    public function get_member_age($member)
    {
        if (!Helper::validateDate($member->member_birth_day)) return false;
        $member_age = Helper::get_age_years($member->member_birth_day);
        return $member_age;
    }

}
