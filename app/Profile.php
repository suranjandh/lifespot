<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $primaryKey = 'profile_id';

    protected $guarded = ['profile_id'];

    use HasFactory, LogsActivity;


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['profile_first_name']);
    }



    public static function boot()
    {
        parent::boot();
        \App\Profile::updated(function ($model) {
            $model->action_on = 'Profile';
            $EmptyLog = new EmptyLog();
            $EmptyLog->process_empty_log($model);
        });
        \App\Profile::created(function ($model) {
            $model->action_on = 'Profile';
            $EmptyLog = new EmptyLog();
            $EmptyLog->process_empty_log($model);
        });
    }

    public function user()
    {
        return $this->belongsTo('App\User','id','profile_user_id');
    }



    public static function is_married()
    {
        //$join = null ;
       /* $execution = $this->select($this->table_name, '*', " profile_user_id = $profile_user_id ", null, null, 1);
        if ($execution) {
            if ($this->numResults == 1) {
                return $this->result[0]['profile_maritalStatus'] == 1;
            }
        }
        return false;*/
       $profile_found = auth()->user()->profile ;
       if($profile_found->profile_maritalStatus == 1){
           return true ;
       }
       return false ;
    }

    public function get_profile_full_name($profile)
    {
        return "{$profile->profile_first_name} {$profile->profile_last_name}";
    }

    public function get_profile_address($profile)
    {
        $address_content = array();
        $address_content_fields = array(
            'profile_address', 'profile_address2', 'profile_city', 'profile_state', 'profile_zip'
        );
        foreach ($address_content_fields as $v) {
            if (trim($profile->$v) != '') $address_content[] = $profile->$v;
        }

        return implode(" , ", $address_content);
    }

    public function get_profile_birthday($profile)
    {

        return $profile->profile_bday > 0 ? date('m/d/Y', strtotime($profile->profile_bday)) : "";

    }

    public function get_profile_image($profile)
    {
        //$profile_user = $this->get_profile_by_profile_user_id($user_id);
        $profile_image = trim($profile->profile_image) != '' ? Config::get('constants.SITE_BASE_URL') . Config::get('constants.PROFILE_IMG_FOLDER') . '/' . $profile->profile_image . '?rand=' . rand(1, 1000) : Config::get('constants.DEFAULT_AVATAR_IMAGE_URL');
        return $profile_image ;
    }


}
