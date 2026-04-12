<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use DateTime;

class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function error_message($message = null, $result = null)
    {
        $result = array("error" => 1, "message" => $message, "result" => $result);
        return json_encode($result);
    }

    public static function success_message($message = null, $result = null)
    {

        $result = array("error" => 0, "message" => $message, "result" => $result);
        return json_encode($result);

    }

    public static function success_message_no_display($message = null, $result = null)
    {

        $result = array("error" => 2, "message" => $message, "result" => $result);
        return json_encode($result);

    }

    public static function error_message_no_display($message = null, $result = null)
    {

        $result = array("error" => 3, "message" => $message, "result" => $result);
        return json_encode($result);

    }

    public static function get_marital_status_set()
    {
        $statuses = array(0 => '', 1 => 'Married', 2 => 'Single', 3 => 'Divorced', 4 => 'Widowed', 5 => 'Separated', 6 => 'Significant Other');
        return $statuses;
    }

    public static function email_address_validated($email_address)
    {
        if (filter_var($email_address, FILTER_VALIDATE_EMAIL))
            return 1;
        else return 0;
    }

    public static function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public static function school_grades()
    {
        return array(
            'No Grade',
            'Kindegarten',
            '1st',
            '2nd',
            '3rd',
            '4th',
            '5th',
            '6th',
            '7th',
            '8th',
            '9th',
            '10th',
            '11th',
            '12th',
            'College'
        );
    }

    public static function get_alphabet_number_of_first_char($string)
    {
        $alphabet = range('A', 'Z');
        return array_search(strtoupper($string[0]), $alphabet);
    }

    public static function fill_empty_string($string, $type = '')
    {
        if (trim($string) == '') {
            switch ($type) {
                case 'date':
                    return '<span style="color: red">??/??/????</span>';
                case 'number':
                    return '<span style="color: red">#</span>';
                case 'phone':
                    return '<span style="color: red">(???)-???-????</span>';
                default:
                    return '<span style="color: red">?</span>';
            }
        } else {
            return $string;
        }
    }

    public static function get_marital_status_name($key)
    {
        if (trim($key) == '') {
            return '';
        } else {
            $statuses = self::get_marital_status_set();
            return $statuses[$key];
        }
    }

    public static function  get_age_years($bithdayDate){  // yyyy-mm-dd
        $date = new DateTime($bithdayDate);
        $now = new DateTime();
        $interval = $now->diff($date);
        return $interval->y;
    }

    public static function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    public static function age_month_day_to_date($value){// age-month-day
        $value_array = explode('-',$value);
        $age = (int)$value_array[0] >= 0 ? $value_array[0] : "" ;
        if($age == ""){
            return NULL ;
        }
        $month = (int)$value_array[1] > 0 ? $value_array[1] : 1 ;
        $date = (int)$value_array[2] > 0 ? $value_array[2] : 1 ;
        $year = (int)date('Y')-$age ;
        if($month > (int)date('m') ||( $month == (int)date('m') && $date > (int)date('d')) ){
            $year = $year-1 ;
        }
        return $year.'-'.$month.'-'.$date ;
    }

    public static function age_month_day_to_json($value){// age-month-day
        $value_array = explode('-',$value);
        $age = (int)$value_array[0] >= 0 ? $value_array[0] : "" ;
        /*if($age == ""){
            return NULL ;
        }*/
        $month = (int)$value_array[1] > 0 ? $value_array[1] : "";
        $date = (int)$value_array[2] > 0 ? $value_array[2] : "" ;
        /*$year = (int)date('Y')+$age ;
        if($month < (int)date('m') ||( $month == (int)date('m') && $date < (int)date('d')) ){
            $year = $year+1 ;
        }*/
        return json_encode(array('a'=>$age,'m'=>$month,'d'=>$date)) ;
    }
}