<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class ValidatorSettings
{
    public static $estate = [
        'estate_id'=> 'required',
        'estate_name'=>'required',
        'estate_owner_name'=>'required',
    ];

    public static $profile = [
        'profile_first_name'=>'required',
        'profile_last_name'=>'required',
    ];

    public static $spouse = [
        'member_first_name'=>'required',
        'member_last_name'=>'required',
    ];

    public static $site = [
        'site_name'=>'required',
        'site_owners'=>'required',
    ];

    public static $pet = ['pet_name'];

    public static function get($name){
        return self::$$name;
    }
}