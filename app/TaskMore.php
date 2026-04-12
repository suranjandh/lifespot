<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskMore extends Task
{
    public $task_ids_more_levels = [
        38
    ];

    public $task_level = 0 ;

    public function __construct($task_level)
    {
        parent::__construct();
        $this->task_level = $task_level ;
    }


    // task_skip_sub_category = member id
    public function get_tasks_set()
    {
        $task_messages = array();
        $task_skip_messages = array();

            $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_more_levels);
            $task = Task::find($this->task_ids_more_levels[0]);
            $task->task_skip_sub_category = $this->task_level;
            if (self::is_task($task, $task_skip_keys)) {
                $task_messages[] = $this->prepare_task_message($task);
            } /*elseif (self::is_skipped_task($task, $task_skip_keys)) {
                $task_skip_messages[] = $this->prepare_task_message($task);
            }*/


        $task_set = array(
            'task_messages' => $task_messages,
            'task_skip_messages' => $task_skip_messages
        );

        return $task_set;
    }


    public function prepare_task_message($task)
    {
        $task = $task->toArray();
        $task_message = array(
            'task_type' => $task['task_category'],
            'task_id' => $task['task_id'],
            'message' =>  $task['task_message'],
            'task_row' => $task,
            'task_skip_sub_category' => $task['task_skip_sub_category']
        );
        $task_message['open_data']['class'] = 'delete_task';

        return $task_message;
    }
}
