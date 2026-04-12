<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

// user_access 0 => estate 1 => kid
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*    protected $fillable = [
                'first_name', 'last_name', 'email', 'password','spouse_logged','user_sessions_last_active'
    ]; */

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function boot()
    {
        parent::boot();
        \App\User::updated(function ($model) {
            $model->action_on = 'User';
        });
        \App\User::created(function ($model) {
            $model->action_on = 'User';
        });
    }

    public function estate()
    {
        return $this->hasOne('App\Estate', 'estate_user_id', 'id');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile', 'profile_user_id', 'id');
    }

    public function spouse()
    {
        return $this->hasOne('App\Spouse', 'member_owner_user_id', 'id');
    }

    public function members()
    {
        return $this->hasMany('App\Member', 'member_owner_user_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany('App\Document', 'document_owner_user_id', 'id');
    }

    public function beneficiaries()
    {
        return $this->hasMany('App\Beneficiary', 'member_owner_user_id', 'id');
    }

    public function emergency_contacts()
    {
        return $this->hasMany('App\EmergencyContact', 'member_owner_user_id', 'id');
    }

    public function dependents()
    {
        return $this->hasMany('App\Dependent', 'member_owner_user_id', 'id');
    }

    public function pets()
    {
        return $this->hasMany('App\Pet', 'pet_owner_user_id', 'id');
    }

    public function users_other_estate_member_cards()
    {
        return $this->hasMany('App\Member', 'member_associated_user', 'id');
    }

    public function activities()
    {
        return $this->hasMany('App\Activity', 'causer_id', 'id');
    }

    public function site()
    {
        return $this->hasOne('App\Site', 'site_owner_user_id', 'id');
    }

    public function friends()
    {
        return $this->hasMany('App\Friend', 'member_owner_user_id', 'id');
    }

    public function user_has_spouse()
    {
        return auth()->user()->spouse ? true : false;
    }

    public static function is_active_user($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            return $user->user_status == 1 ? true : false;
        }
        return false;
    }

    public function get_users_husbands_user_id($user_id, $join_account_access_allowed = false)
    {
        /*$member_obj = new MemberModel();
        $where = "  member_associated_user = $user_id AND  member_is_spouse = 1 ";
        $where .= $join_account_access_allowed ? " AND member_join_account_access = 1 " : " ";
        $execution = $this->select($member_obj->table_name, '*', $where, null, null, 1);
        if ($execution) {
            if ($this->numResults > 0) {
                return $this->result[0]['member_owner_user_id'];
            }
        }*/
        $member = Spouse::where('member_associated_user', '=', $user_id)->where(function ($q) use ($join_account_access_allowed) {
            if ($join_account_access_allowed) {
                $q->where('member_join_account_access', '=', 1);
            }
        })->take(1)->first();
        if ($member) {
            return $member->member_owner_user_id;
        }
        return false;
    }


    public function get_users_husband_user_join_account()
    {
        $husbands_user_id = $this->get_users_husbands_user_id(auth()->user()->id, true);
        if ($husbands_user_id) {
            $husbands_user = User::find($husbands_user_id); //$this->get_user_by_id($husbands_user_id);
            if ($husbands_user) {
                return $husbands_user;
            }
        }
        return array();
    }

    public function account_not_logged_in_by_spouse_join($user, $switching_to_join = false)
    {
        // = new SessionModel();
        //$user_session_obj  =  new UserSessionModel();
        //$user_session = $user_session_obj->get_user_session_by_user_id($user['user_id']);
        if ($user) {
            $time = time();
            $recent_active = $user->user_sessions_last_active ? $user->user_sessions_last_active : 0;
            $active_difference = abs($time - $recent_active);

            if ($switching_to_join) { // user is login to husband
                $logged_in_by_spouse_join = $user->spouse_logged == 0
                    && $active_difference < 120;
                if ($logged_in_by_spouse_join) {
                    return false;
                } else {
                    User::find($user->id)->update(['spouse_logged' => 0, 'user_sessions_last_active' => '']);
                    return true;
                }
            } else { // user is login to his account
                $logged_in_by_spouse_join = $user->spouse_logged > 0 && $active_difference < 120;
                if ($logged_in_by_spouse_join) {
                    return false;
                } else {
                    //$user->is_spouse_logged = 0 ;
                    //$user->save();
                    User::find($user->id)->update(['spouse_logged' => 0, 'user_sessions_last_active' => '']);
                    return true;
                }
            }
        } else {
            return true;
        }
    }


}
