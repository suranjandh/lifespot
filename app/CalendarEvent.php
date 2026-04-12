<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CalendarEvent extends Model
{
    public $calendar_event_type = array(
        0 => 'Birthday',
        1 => 'Anniversary'
    );

    public $calendar_event_settings = array(
        0 => array(
            'table' => 'profiles',
            'primary_key' => 'profile_id',
            'user_key' => 'profile_user_id',
            'person_name_columns' => 'profile_first_name|profile_last_name',
            'event_column' => 'profile_birth_day',
            'event_type' => 0
        ),
        1 => array(
            'table' => 'members',
            'primary_key' => 'member_id',
            'user_key' => 'member_owner_user_id',
            'person_name_columns' => 'member_first_name|member_last_name',
            'event_column' => 'member_birth_day',
            'event_type' => 0
        ),
        2 => array(
            'table' => 'members',
            'primary_key' => 'member_id',
            'user_key' => 'member_owner_user_id',
            'person_name_columns' => 'member_first_name|member_last_name',
            'event_column' => 'member_anniversary',
            'event_type' => 1
        ),
    );

    public $user_id;
    public $full_name;
    public $calendar_events_set = array();

    public function __construct()
    {
        parent::__construct();
        $this->user_id = auth()->user()->id;
        $this->full_name = auth()->user()->first_name . ' ' . auth()->user()->last_name;
        $this->prepare_all_calendar_events();
    }

    public function prepare_all_calendar_events()
    {
        foreach ($this->calendar_event_settings as $k => $event_data) {
            $this->get_calendar_events_by_column($event_data);
        }
    }

    public function get_calendar_events_by_column($event_data)
    {
        // $execution = $this->select($event_data['table'], "*", " {$event_data['user_key']} = {$this->user_id} AND {$event_data['event_column']} > 0 ");
       $calendar_events = DB::table($event_data['table'])
            ->where($event_data['user_key'], '=', $this->user_id)
            ->where($event_data['event_column'], '>', 0)->get();

       foreach ($calendar_events as $row){
           $row = (array)$row ;
           $this->set_calendar_event($event_data, $row);
       }
        /* if ($execution && $this->numResults > 0) {
             foreach ($this->result as $row) {
                 $this->set_calendar_event($event_data, $row);
             }
         }*/
    }

    public function set_calendar_event($event_data, $row)
    {
        $calendar_event = array();
        $event_date = $row[$event_data['event_column']];
        $next_same_date = $this->get_next_same_date(date('Y-m-d', strtotime($event_date)));
        $calendar_event['timestamp'] = strtotime($next_same_date);
        if ($calendar_event['timestamp']) {
            $calendar_event['date'] = date('Y M d', strtotime($next_same_date));
            $message = "";
            $event_years_from_today = date('Y', strtotime($next_same_date)) - date('Y', strtotime($event_date));
            $person_name_columns = explode('|', $event_data['person_name_columns']);
            $name_of_person = $row[$person_name_columns[0]] . ' ' . $row[$person_name_columns[1]];
            if ($event_data['event_type'] == 0) {
                $message = $this->addOrdinalNumberSuffix($event_years_from_today ).' '. $this->calendar_event_type[$event_data['event_type']];
                $message .= " of " . $name_of_person;
            } elseif ($event_data['event_type'] == 1) {
                $message = $this->addOrdinalNumberSuffix($event_years_from_today ).' ' . $this->calendar_event_type[$event_data['event_type']];
                $message .= " of {$this->full_name} & " . $name_of_person;
            }
            $calendar_event['message'] = $message;
            $this->calendar_events_set[] = $calendar_event;
        }
    }


    function get_next_same_date($day)
    {
        $date = new DateTime($day);
        $date->modify('+' . date('Y') - $date->format('Y') . ' years');
        if ($date < new DateTime()) {
            $date->modify('+1 year');
        }
        return $date->format('Y-m-d');
    }


    function addOrdinalNumberSuffix($num) {
        if (!in_array(($num % 100),array(11,12,13))){
            switch ($num % 10) {
                // Handle 1st, 2nd, 3rd
                case 1:  return $num.'st';
                case 2:  return $num.'nd';
                case 3:  return $num.'rd';
            }
        }
        return $num.'th';
    }
}
