<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskWelcome extends Task
{
    //(1,2,3)
    public $task_ids = [
       7,8
    ];

    // task_skip_sub_category =
    public function get_tasks_set()
    {
        $task_messages = array();
        $task_skip_messages = array();

        $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids);

        foreach (Task::whereIn('task_id',$this->task_ids)->get() as $task){
          /*  if(!in_array($task->task_id.'||',$task_skip_keys)){
                $task_messages[] = $this->prepare_task_message($task);
            }else{
                $task_skip_messages[] = $this->prepare_task_message($task);
            }*/

            if (self::is_task($task,$task_skip_keys)) {
                $task_messages[] = $this->prepare_task_message($task);
            } elseif(self::is_skipped_task($task,$task_skip_keys)) {
                $task_skip_messages[] = $this->prepare_task_message($task);
            }
        }

        $task_set = array(
            'task_messages' => $task_messages,
            'task_skip_messages' => $task_skip_messages
        );

        return $task_set;
    }


    public function prepare_task_message($task)
    {
        $task = $task->toArray();
        $message = $task['task_message'];
        $message_data = array(
            'task_id' => $task['task_id'],
            'message' => $this->get_greeting() . ' ' . $message,
            'task_row' => $task
        );
        return $message_data;
    }
}
