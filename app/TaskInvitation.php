<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskInvitation extends Task
{
//(34,35,36,37,38,79)
    public $task_ids = [
        1, 2, 3, 4, 5, 6
    ];

    // task_skip_sub_category = member id
    public function get_tasks_set()
    {
        $task_messages = array();
        $task_skip_messages = array();

        $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids);
        $members = auth()->user()->members;
        foreach ($members as $member) {
            if ($member->member_associated_user > 0) {
                continue;
            }
            if ($member->member_deactivated_his_account($member)) {
                $task = Task::find(5);
                if ($task) {
                    $task->task_skip_sub_category = $member->member_id;
                   /* if (!in_array($task->task_id . '||' . $task->task_skip_sub_category, $task_skip_keys)) {
                        $task_messages[] = $this->prepare_task_message($task, $member);
                    }else{
                        $task_skip_messages[] = $this->prepare_task_message($task, $member);
                    }*/
                    if (self::is_task($task,$task_skip_keys)) {
                        $task_messages[] = $this->prepare_task_message($task, $member);
                    } elseif(self::is_skipped_task($task,$task_skip_keys)) {
                        $task_skip_messages[] = $this->prepare_task_message($task, $member);
                    }
                }
            } else {
                if ($member->member_invitation_status == 1) {
                    $task = Task::find(1);
                    if ($task) {
                        $task->task_skip_sub_category = $member->member_id;
                        /*if (!in_array($task->task_id . '||' . $task->task_skip_sub_category, $task_skip_keys)) {
                            $task_messages[] = $this->prepare_task_message($task, $member);
                        }else{
                            $task_skip_messages[] = $this->prepare_task_message($task, $member);
                        }*/

                        if (self::is_task($task,$task_skip_keys)) {
                            $task_messages[] = $this->prepare_task_message($task, $member);
                        } elseif(self::is_skipped_task($task,$task_skip_keys)) {
                            $task_skip_messages[] = $this->prepare_task_message($task, $member);
                        }
                    }
                } elseif ($member->member_invitation_status == -1) {
                    $task = Task::find(2);
                    if ($task) {
                        $task->task_skip_sub_category = $member->member_id;
                        if (!in_array($task->task_id . '||' . $task->task_skip_sub_category, $task_skip_keys)) {
                            $task_messages[] = $this->prepare_task_message($task, $member);
                        }else{
                            $task_skip_messages[] = $this->prepare_task_message($task, $member);
                        }
                    }
                } elseif ($member->member_invitation_status < -1) {
                    $task = Task::find(3);
                    if ($task) {
                        $task->task_skip_sub_category = $member->member_id;
                       /* if (!in_array($task->task_id . '||' . $task->task_skip_sub_category, $task_skip_keys)) {
                            $task_messages[] = $this->prepare_task_message($task, $member);
                        }else{
                            $task_skip_messages[] = $this->prepare_task_message($task, $member);
                        }*/
                        if (self::is_task($task,$task_skip_keys)) {
                            $task_messages[] = $this->prepare_task_message($task, $member);
                        } elseif(self::is_skipped_task($task,$task_skip_keys)) {
                            $task_skip_messages[] = $this->prepare_task_message($task, $member);
                        }
                    }
                } elseif ($member->member_invitation_status == 0) {
                    $task = Task::find(6);
                    if ($task) {
                        $task->task_skip_sub_category = $member->member_id;
                        /*if (!in_array($task->task_id . '||' . $task->task_skip_sub_category, $task_skip_keys)) {
                            $task_messages[] = $this->prepare_task_message($task, $member);
                        }else{
                            $task_skip_messages[] = $this->prepare_task_message($task, $member);
                        }*/
                        if (self::is_task($task,$task_skip_keys)) {
                            $task_messages[] = $this->prepare_task_message($task, $member);
                        } elseif(self::is_skipped_task($task,$task_skip_keys)) {
                            $task_skip_messages[] = $this->prepare_task_message($task, $member);
                        }
                    }
                }
            }
        }

        $task_set = array(
            'task_messages' => $task_messages,
            'task_skip_messages' => $task_skip_messages
        );

        return $task_set;
    }


    public function prepare_task_message($task, $member)
    {
        $task = $task->toArray();
        $member_full_name = $member->member_first_name . ' ' . $member->member_last_name;
        $member_id = $member->member_id;
        $task_message = array(
            'task_type' => 'invitation_email_task',
            'task_id' => $task['task_id'],
            'message' => auth()->user()->first_name . "  " . str_replace('[member-full-name]', $member_full_name, $task['task_message']),
            'task_row' => $task,
            'task_skip_sub_category' => $member_id,
        );
        if ($task['task_id'] == 6) {
            $task_message['task_row']['task_button_text'] .= " " . $member->member_first_name;
            $task_message['open_data']['class'] = 'member_content_box';
            $task_message['open_data']['member-member-id'] = $member_id;
            $task_message['open_data']['member-type'] = 'member';
        }
        if ($task['task_id'] == 2) {
            $task_message['open_data']['class'] = 'member_content_box';
            $task_message['open_data']['member-member-id'] = $member_id;
            $task_message['open_data']['member-type'] = 'member';
        } elseif ($task['task_id'] == 5) {
            $task_message['message'] = str_replace('[member-full-name]', $member_full_name, $task['task_message']);
        }
        return $task_message;
    }
}
