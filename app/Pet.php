<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Pet extends Model
{
    protected $table = 'pets';

    protected $primaryKey = 'pet_id';

    protected $guarded = ['pet_id'];

    use HasFactory, LogsActivity;


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['pet_name']);
    }



    public static function boot() {
        parent::boot();
        self::creating(function ($model) {
            if(\Auth::check()) {
                $model->pet_owner_user_id = auth()->user()->id;
            }
        });
        \App\Pet::updated(function ($model) {
            $EmptyLog = new EmptyLog();
            $EmptyLog->process_empty_log($model);
        });
        \App\Pet::created(function ($model) {
            $EmptyLog = new EmptyLog();
            $EmptyLog->process_empty_log($model);
        });
    }


    public function process_pet_guardian($pet_id, $pet_guardian, $pet_guardian_first_name, $pet_guardian_last_name)
    {
        $pet_guardian_first_name = trim($pet_guardian_first_name);
        $pet_guardian_last_name = trim($pet_guardian_last_name);
        //$member_obj = new MemberModel();
        if ($pet_guardian_first_name != '' && $pet_guardian_last_name != '') {
            $members = Member::search_member($pet_guardian_first_name, $pet_guardian_last_name);
            if ($members) {
                foreach ($members as $member) {
                    if ($pet_guardian == $member->member_id) {
                        /*$pet = array(
                            'pet_guardian'=>  $pet_guardian
                        );*/
                        Pet::find($pet_id)->update(['pet_guardian' => $pet_guardian]);
                        //$this->update_pet_by_id($pet,$pet_id);
                        return false;
                    }
                }

            }
            // not found pet guardian member in members
            $member_data = array(
                'member_first_name' => $pet_guardian_first_name,
                'member_last_name' => $pet_guardian_last_name,
                'member_owner_user_id' => auth()->user()->id
            );

            //$insert_member_id = $member_obj->insert_member($member);
            $member = Member::create($member_data);
            //  $pet = array(
            //   'pet_guardian'=>  $insert_member_id
            //);
            //   $this->update_pet_by_id($pet,$pet_id);
            Pet::find($pet_id)->update(['pet_guardian' => $member->member_id]);
        }

        return false;
    }

    public static function member_is_caregiver_to_pets($member_id){
                
    }

    public function get_pet_birthday($pet)
    {

        return $pet->pet_birthday > 0 ? date('m/d/Y', strtotime($pet->pet_birthday)) : "";

    }

}
