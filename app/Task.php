<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $primaryKey = 'task_id';

    protected $guarded = ['task_id'];

    protected $task_greetings = array("", "Hi", "Hey", "Did you know");

    protected $task_image_messages = array(
        "photos make your [sub-category] more interesting.",
        "you can add a photo to your [sub-category]... it's easy!",
        "you are able to personalize your LifeSpot [sub-category] with a photo."
    );
    protected $task_input_messages = array(
        "your [sub-category] missing the [input-field].",
        "the  [input-field] is missing from [sub-category].",
        "your LifeSpot account is missing the  [input-field] info from [sub-category]."
    );

    public $task_ids = [];

    public function merge_tasks_set($task_items, $task_items_more)
    {
        return $task_items = array(
            'task_messages' => array_merge($task_items['task_messages'], $task_items_more['task_messages']),
            'task_skip_messages' => array_merge($task_items['task_skip_messages'], $task_items_more['task_skip_messages'])
        );
    }


    public function get_greeting()
    {
        return $this->task_greetings[array_rand($this->task_greetings)] . ' ' . auth()->user()->first_name;
    }

    public function is_task($task, $task_skip_keys)
    {
        if (!in_array($task->task_id . '||' . $task->task_skip_sub_category, $task_skip_keys[0])) {
            return true;
        }
        return false;
    }

    public function is_skipped_task($task, $task_skip_keys)
    {
        if (in_array($task->task_id . '||' . $task->task_skip_sub_category, $task_skip_keys[1])) {
            return true;
        }
        return false;
    }

    public function tasks_on_dashboard()
    {
        $task_items = array(
            'task_messages' => array(),
            'task_skip_messages' => array()
        );


        // level 100
        $TaskInvitation = new TaskInvitation();
        $task_items = $this->merge_tasks_set($task_items, $TaskInvitation->get_tasks_set());

        if (count($task_items['task_messages'])) {
            $TaskMore = new TaskMore(100);
            $tak_more_items = $TaskMore->get_tasks_set();
            $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
            if (count($tak_more_items['task_messages']) > 0) {
                return $task_items;
            }
        }

        // level 200
        $TaskWelcome = new TaskWelcome();
        $task_items = $this->merge_tasks_set($task_items, $TaskWelcome->get_tasks_set());

        if (count($task_items['task_messages'])) {
            $TaskMore = new TaskMore(200);
            $tak_more_items = $TaskMore->get_tasks_set();
            $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
            if (count($tak_more_items['task_messages']) > 0) {
                return $task_items;
            }
        }

        // level 300
        $TaskEstate = new TaskEstate();
        $task_items = $this->merge_tasks_set($task_items, $TaskEstate->get_tasks_set());

        if (count($task_items['task_messages'])) {
            $TaskMore = new TaskMore(300);
            $tak_more_items = $TaskMore->get_tasks_set();
            $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
            if (count($tak_more_items['task_messages']) > 0) {
                return $task_items;
            }
        }

        // level 400
        $TaskProfile = new TaskProfile();
        $task_items = $this->merge_tasks_set($task_items, $TaskProfile->get_tasks_set());

        if (count($task_items['task_messages'])) {
            $TaskMore = new TaskMore(400);
            $tak_more_items = $TaskMore->get_tasks_set();
            $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
            if (count($tak_more_items['task_messages']) > 0) {
                return $task_items;
            }
        }

        // level 500
        $TaskSpouse = new TaskSpouse();
        $task_items = $this->merge_tasks_set($task_items, $TaskSpouse->get_tasks_set());

        if (count($task_items['task_messages'])) {
            $TaskMore = new TaskMore(500);
            $tak_more_items = $TaskMore->get_tasks_set();
            $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
            if (count($tak_more_items['task_messages']) > 0) {
                return $task_items;
            }
        }


        // level 600
        $TaskDocument = new TaskDocument();
        $task_items = $this->merge_tasks_set($task_items, $TaskDocument->get_tasks_set());

        if (count($task_items['task_messages'])) {
            $TaskMore = new TaskMore(600);
            $tak_more_items = $TaskMore->get_tasks_set();
            $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
            if (count($tak_more_items['task_messages']) > 0) {
                return $task_items;
            }
        }

        // level 700
        $TaskRole = new TaskRole();
        $task_items = $this->merge_tasks_set($task_items, $TaskRole->get_tasks_set());

        if (count($task_items['task_messages'])) {
            $TaskMore = new TaskMore(700);
            $tak_more_items = $TaskMore->get_tasks_set();
            $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
            if (count($tak_more_items['task_messages']) > 0) {
                return $task_items;
            }
        }

        // level 800
        $TaskDependent = new TaskDependent();
        $task_items = $this->merge_tasks_set($task_items, $TaskDependent->get_tasks_set());

        if (count($task_items['task_messages'])) {
            $TaskMore = new TaskMore(800);
            $tak_more_items = $TaskMore->get_tasks_set();
            $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
            if (count($tak_more_items['task_messages']) > 0) {
                return $task_items;
            }
        }

        // level 900
        $TaskBeneficiary = new TaskBeneficiary();
        $task_items = $this->merge_tasks_set($task_items, $TaskBeneficiary->get_tasks_set());

        if (count($task_items['task_messages'])) {
            $TaskMore = new TaskMore(900);
            $tak_more_items = $TaskMore->get_tasks_set();
            $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
            if (count($tak_more_items['task_messages']) > 0) {
                return $task_items;
            }
        }

        // level 1000
        $TaskEmergencyContact = new TaskEmergencyContact();
        $task_items = $this->merge_tasks_set($task_items, $TaskEmergencyContact->get_tasks_set());

        if (count($task_items['task_messages'])) {
            $TaskMore = new TaskMore(1000);
            $tak_more_items = $TaskMore->get_tasks_set();
            $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
            if (count($tak_more_items['task_messages']) > 0) {
                return $task_items;
            }
        }

        // level 1100
        $TaskPet = new TaskPet();
        $task_items = $this->merge_tasks_set($task_items, $TaskPet->get_tasks_set());

        if (count($task_items['task_messages'])) {
            $TaskMore = new TaskMore(1100);
            $tak_more_items = $TaskMore->get_tasks_set();
            $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
            if (count($tak_more_items['task_messages']) > 0) {
                return $task_items;
            }
        }

        // level 1200
        $TaskExpiredDocument = new TaskExpiredDocument();
        $task_items = $this->merge_tasks_set($task_items, $TaskExpiredDocument->get_tasks_set());

        if (count($task_items['task_messages'])) {
            $TaskMore = new TaskMore(1200);
            $tak_more_items = $TaskMore->get_tasks_set();
            $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
            if (count($tak_more_items['task_messages']) > 0) {
                return $task_items;
            }
        }

        // level 1300
        $TaskMember = new TaskMember();
        $task_items = $this->merge_tasks_set($task_items, $TaskMember->get_tasks_set());

        /*$TaskMore = new TaskMore(1300);
        $tak_more_items = $TaskMore->get_tasks_set();
        $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
        if (count($tak_more_items['task_messages']) > 0) {
            return $task_items;
        }*/

        return $task_items;
    }


}
