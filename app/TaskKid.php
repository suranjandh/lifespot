<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskKid extends Task
{
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


        // level 1300
        $TaskMember = new TaskMember();
        $task_items = $this->merge_tasks_set($task_items, $TaskMember->get_tasks_set());

        if (count($task_items['task_messages'])) {
            $TaskMore = new TaskMore(1300);
            $tak_more_items = $TaskMore->get_tasks_set();
            $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
            if (count($tak_more_items['task_messages']) > 0) {
                return $task_items;
            }
        }

        // level 1400
        $TaskFriend = new TaskFriend();
        $task_items = $this->merge_tasks_set($task_items, $TaskFriend->get_tasks_set());

        if (count($task_items['task_messages'])) {
            $TaskMore = new TaskMore(1400);
            $tak_more_items = $TaskMore->get_tasks_set();
            $task_items = $this->merge_tasks_set($task_items, $tak_more_items);
            if (count($tak_more_items['task_messages']) > 0) {
                return $task_items;
            }
        }

        // level 1500
        $TaskSite = new TaskSite();
        $task_items = $this->merge_tasks_set($task_items, $TaskSite->get_tasks_set());

        return $task_items;
    }

}
