<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    public static $relationship_array = array(
        0 => 'No Relationship',
        /*1 => 'Husband', 2 => 'Wife',*/
        3 => 'Son', 4 => 'Daughter',
        5 => 'Father', 6 => 'Mother',
        7 => 'Brother', 8 => 'Sister',
        9 => 'Grandfather', 10 => 'Grandmother',
        11 => 'Grandson', 12 => 'Granddaughter',
        13 => 'Uncle', 14 => 'Aunt',
        15 => 'Nephew', 16 => 'Niece',
        17 => 'Cousin',
        18=> 'Spouse'
    );

    public static function get_relationships()
    {
        return self::$relationship_array;
    }

    public static function get_spouse_relationships(){

        return array(self::$relationship_array[18]);
    }

    public static function get_spouse_relationship_keys(){

        return array(18); // return wife husband keys
    }

    public static function get_relationship_name_by_relationship_id($relationship_id)
    {
        if($relationship_id > 0)
            return array_key_exists($relationship_id,self::$relationship_array)?self::$relationship_array[$relationship_id]:$relationship_id;
        else return $relationship_id ;
    }
}
