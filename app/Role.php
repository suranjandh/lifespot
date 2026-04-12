<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'role_id';

  /*  public function shops()
    {
        return $this->belongsToMany('App\Shop');
    }*/

    public function members()
    {
        return $this->belongsToMany('App\Member');
    }

    public static function  get_roles_spouse_default()
    {
        return array(250); //[250 => 'Co-Trustee'];
    }

    public  static function get_role_executor()
    {
        return 100; //   100 => 'Executor',
    }

    public static function get_role_co_executor()
    {
        return 150; //    150=>'Co Executor',
    }

    public static function get_role_trustee()
    {
        return 200; //   'Trustee',
    }

    public static function get_role_co_trustee()
    {
        return 250; //   250 => 'Co-Trustee',
    }

    public static function get_role_beneficiary()
    {
        return 300; //    300 => 'Beneficiary',
    }

    public static function get_role_successors_trustee(){
        return 350; //    350 => 'Successors Trustee',
    }

    public static function get_role_guardian()
    {
        return 400; //  400 => 'Legal Guardian',
    }

    public static function get_role_heir()
    {
        return 450; //    450 => 'Heir',
    }

    public static function get_role_emergency_contact(){
        return 500; //  500 => 'Emergency Contact',
    }

    public static function role_colors($key)
    {
        $color_ar = array(
            '#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#000075', '#808080', '#ffffff', '#000000');
        $key_color = intval($key/50);
        return $color_ar[$key_color];
    }


    public static function get_roles_for_empty_check()
    {
        $roles = Role::all();
        $roles_array = array();
        foreach ($roles as $role){
            $roles_array[] = $role->role_id ;
        }
        $main_roles = $roles_array;
        unset($main_roles[400]);
        unset($main_roles[0]);
        return $main_roles;
    }


    public static function get_role_task_sub_categories(){
        return $role_task_sub_categories = array(
            100=>array(100,150),
            200=>array(200,250),
            500=>array(500),
            300=>array(300),
            350=>array(350),
            450=>array(450)
        );
    }


}
