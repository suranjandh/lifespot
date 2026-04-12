<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class EmptyLog extends Model
{
    protected $table = 'empty_logs';

    protected $primaryKey = 'empty_log_id';

    protected $guarded = ['empty_log_id'];

    public $timestamps = false ;


    public $Member_fields = array(
        'member_id',
        'member_owner_user_id',
        'member_first_name',
        'member_last_name',
        'member_email',
        'member_phone',
        'member_address',
        'member_address2',
        'member_city',
        'member_state',
        'member_zip',
        'member_gender',
        'member_role_in_estate',
        'member_relationship_to_owner',
        'member_birth_day',
        'member_image',
       // 'member_invitation_status'
    );

    public $Spouse_fields = array(
        'member_id',
        'member_owner_user_id',
        'member_first_name',
        'member_last_name',
        'member_email',
        'member_phone',
        'member_gender',
        'member_birth_day',
        'member_role_in_estate',
        'member_relationship_to_owner',
        'member_anniversary',
        //'member_spacial_notes',
        //'member_is_spouse',
        'member_image',
        //'member_invitation_status'

    );

    public $Beneficiary_fields = array(
        'member_id',
        'member_owner_user_id',
        'member_first_name',
        'member_last_name',
        'member_email',
        'member_phone',
        'member_gender',
        'member_birth_day',
        'member_anniversary',
        'member_role_in_estate',
        //'member_is_beneficiary',
        'member_image',
       // 'member_invitation_status',
       // 'member_gifts'
    );

    public $EmergencyContact_fields = array(
        'member_id',
        'member_owner_user_id',
        'member_first_name',
        'member_last_name',
        'member_email',
        'member_phone',
        'member_gender',
        'member_role_in_estate',
        //'member_is_emergency_contact',
        'member_image',
        //'member_invitation_status',
    );

    public $Dependent_fields = array(
        'member_id',
        'member_owner_user_id',
        'member_first_name',
        'member_last_name',
        'member_email',
        'member_phone',
        'member_gender',
        'member_birth_day',
        'member_address',
        'member_address2',
        'member_city',
        'member_state',
        'member_zip',
        //'isAssociatedWithSpouse',
        'member_role_in_estate',
        'member_relationship_to_owner',
        //'member_spacial_notes',
        'member_is_dependent',
        'member_image',
        //'member_invitation_status'
    );


    public $Friend_fields =  array(
        'member_id',
        'member_owner_user_id',
        'member_first_name',
        'member_last_name',
        'member_email',
        'member_phone',
        'member_gender',
        //'member_is_friend',
        'member_image',
    );

    public $Estate_fields = array(
        'estate_user_id',
        'estate_name' ,
        'estate_owner_name' ,
        'estate_address' ,
        'estate_address2' ,
        'estate_city' ,
        'estate_zip' ,
        'estate_state' ,
        //'estate_notes' ,
        //'estate_is_primary_residence' ,
        //'estate_does_own_home',
        'estate_image'
    );

    public $Profile_fields = array(
        'profile_user_id',
        'profile_gender',
        'profile_first_name',
        'profile_last_name',
        'profile_email',
        'profile_phone',
        'profile_birth_day',
        'profile_maritalStatus',
        'profile_dependents',
        //'profile_ethnicity',
        'profile_nickName',
        //'profile_profile_notes',
        'profile_image'
    );

    public $Site_fields = array(
        'site_owner_user_id' ,
        'site_name' ,
        'site_owners'
    );

    public $Pet_fields = array(
        'pet_owner_user_id' ,
        'pet_gender' ,
        'pet_name' ,
        'pet_clinic_name' ,
        'pet_description' ,
        'pet_tag_id' ,
        'pet_veterinarian_phone' ,
        'pet_birth_day' ,
        'pet_doctor_name' ,
        'pet_guardian' ,
        'pet_notes'
    );

    public function process_empty_log($model){
        $action_on = Input::get('action_on');
        if($action_on == null){
            if($model->getTable() == 'estates'){
                $action_on = 'Estate';
            }
            if($model->getTable() == 'profiles'){
                $action_on = 'Profile';
            }
        }
        if($action_on) {
            $field_name = $action_on.'_fields';
            $fields_set = isset($this->$field_name)? $this->$field_name : false;
            if($fields_set) {
               // EmptyLog::create(['empty_log_fields' => $model]);
                $number_of_empty_fields = 0 ;
                $empty_fields = array();
                $empty_log_image_empty_field = '';
                $table_data = self::get_table_data($action_on);
                foreach ($fields_set as $field){
                    if($model->$field == ''){
                        if($table_data['row_image_name'] == $field){
                            $empty_log_image_empty_field = $field ;
                        }else {
                            $number_of_empty_fields = $number_of_empty_fields + 1 ;
                            $empty_fields[] = $field;
                        }
                    }
                }
                $empty_log_data = array(
                    'empty_log_action_on'=>$action_on ,
                    'empty_log_table_name'=>$table_data['table_name'] ,
                    'empty_log_row_id'=> $model[$table_data['row_primary_key']],
                    'empty_log_number_of_fields'=>$number_of_empty_fields ,
                    'empty_log_fields'=> json_encode($empty_fields),
                    'empty_log_image_empty_field'=>$empty_log_image_empty_field
                );
                $empty_log = EmptyLog::where(['empty_log_table_name'=>$table_data['table_name'] ,
                    'empty_log_row_id'=> $model[$table_data['row_primary_key']]])->get();
                if(count($empty_log) > 0){
                    EmptyLog::where(['empty_log_table_name'=>$table_data['table_name'] ,
                        'empty_log_row_id'=> $model[$table_data['row_primary_key']]])->delete();
                }
                EmptyLog::create($empty_log_data);
            }
        }
    }

    public static function get_table_data($action_on){
        $row_primary_key = 'member_id';
        $table_name = 'members';
        $row_image_name = 'member_image';
        $table_prefix = 'member_';

        if($action_on == 'Estate'){
            $row_primary_key = 'estate_id';
            $table_name = 'estates';
            $row_image_name = 'estate_image';
            $table_prefix = 'estate_';
        }
        elseif($action_on == 'Profile'){
            $row_primary_key = 'profile_id';
            $table_name = 'profiles';
            $row_image_name = 'profile_image';
            $table_prefix = 'profile_';
        }
        elseif($action_on == 'Pet'){
            $row_primary_key = 'pet_id';
            $table_name = 'pets';
            $row_image_name = 'pet_image';
            $table_prefix = 'pet_';
        }
        elseif($action_on == 'Site'){
            $row_primary_key = 'site_id';
            $table_name = 'sites';
            $row_image_name = 'site_image';
            $table_prefix = 'site_';
        }
       // return $row_primary_key ;
        return compact('table_name','row_primary_key','row_image_name','table_prefix');
    }

    /*
     public function get_empty_log_row($model,$action_on){
        $row_primary_key = $this->get_primary_key($action_on);
        if($row_primary_key){

        }
    }*/

}
