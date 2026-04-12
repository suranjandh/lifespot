<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskRole extends Task
{
    public $task_ids_empty_role = [
        36
    ];

    public $task_ids_dependent_guardian_role = [
        37
    ];

    public $task_skip_messages = array();
    public $task_messages = array();

    public function get_tasks_set()
    {
        $dependents_has_no_guardian = array();
        $roles_in_members = array();
        $roles_keys_for_empty_check = Role::get_roles_for_empty_check();
        $guardian_role = Role::get_role_guardian();
        $users_members = auth()->user()->members;
        foreach ($users_members as $member) {
            $member_roles = $member->roles;//$member['member_role_in_estate'];
            if ($member_roles) {
                $member_roles_array = $member->role_ids_array($member_roles);
                if ($member_roles_array) {
                    foreach ($member_roles_array as $role_id) {
                        if ($member->member_is_spouse($member) &&
                            $role_id == Role::get_role_co_trustee()) {
                            continue;
                        }
                        $roles_in_members[] = $role_id;
                    }
                }
            }
            if ($member->member_is_dependent($member)) {
                if (!($member['member_guardian_member_id'] > 0)) {
                    $dependents_has_no_guardian[] = $member->member_id;
                }
            }
        }

        $roles_in_members = array_unique($roles_in_members);
        $roles_empty_check_triggered = array_diff($roles_keys_for_empty_check, $roles_in_members);

        $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_empty_role);
        $task = Task::find($this->task_ids_empty_role[0]);


        //1st Check for Executor AND/OR Check for Co-Executors
        $task->task_skip_sub_category = 100;
        $this->trigger_task($task, $roles_empty_check_triggered, $task_skip_keys);

        // 2nd Check for Trustee AND/OR Co-Trustee
        $task->task_skip_sub_category = 200;
        $this->trigger_task($task, $roles_empty_check_triggered, $task_skip_keys);

        if($dependents_has_no_guardian){
            $dependent_guardian_task = Task::find($this->task_ids_dependent_guardian_role[0]);
            $dependent_guardian_task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_dependent_guardian_role);
            foreach ($dependents_has_no_guardian as $dependent_ids){
                $dependent = Dependent::find($dependent_ids);
                $dependent_guardian_task->task_skip_sub_category = $dependent->member_id;
                if (self::is_task($dependent_guardian_task, $dependent_guardian_task_skip_keys)) {
                    $this->task_messages[] = $this->prepare_dependent_guardian_roles_task_message($dependent_guardian_task,$dependent);
                } elseif (self::is_skipped_task($dependent_guardian_task, $dependent_guardian_task_skip_keys)) {
                    $this->task_skip_messages[] = $this->prepare_dependent_guardian_roles_task_message($dependent_guardian_task,$dependent);
                }
            }
        }

        // 4th Check for Emergency Contact(s)
        $task->task_skip_sub_category = 500;
        $this->trigger_task($task, $roles_empty_check_triggered, $task_skip_keys);
        // 5th Check for Beneficiary(s)
        $task->task_skip_sub_category = 300;
        $this->trigger_task($task, $roles_empty_check_triggered, $task_skip_keys);
        // 5.5th Check for 'Successors Trustee',
        $task->task_skip_sub_category = 350;
        $this->trigger_task($task, $roles_empty_check_triggered, $task_skip_keys);
        //  6th Check for Heir(s)
        $task->task_skip_sub_category = 450;
        $this->trigger_task($task, $roles_empty_check_triggered, $task_skip_keys);

        $task_set = array(
            'task_messages' => $this->task_messages,
            'task_skip_messages' => $this->task_skip_messages
        );

        return $task_set;
    }


    function prepare_dependent_guardian_roles_task_message($task,$dependent)
    {
        $task = $task->toArray();
        $member_id = $task['task_skip_sub_category'];
        //$dependent = $member_obj->get_member_by_id($member_id);
        $dependent_name = $dependent->member_first_name;
        $task_message = array(
            'task_type' => 'dependent_guardian_roles_task',
            'task_id' => $task['task_id'],
            'message' => $this->get_greeting() . "  " . str_replace('[dependent-name]', $dependent_name, $task['task_message']),
            'task_row' => $task,
            'task_skip_sub_category' => $task['task_skip_sub_category']
        );
        // $task_message['task_row']['task_button_text'] .= " " . $dependent['member_first_name'];
        $task_message['task_row']['single_entry'] = 1;
        $task_message['open_data']['class'] = 'member_content_box';
        $task_message['open_data']['member-member-id'] = $member_id;
        $task_message['open_data']['member-type'] = 'current_dependent';

    }
        public function trigger_task($task, $roles_empty_check_triggered, $task_skip_keys)
    {
        if ($this->check_task_trigger($task->task_skip_sub_category, $roles_empty_check_triggered)) {
            if (self::is_task($task, $task_skip_keys)) {
                $this->task_messages[] = $this->prepare_roles_task_message($task);
            } elseif (self::is_skipped_task($task, $task_skip_keys)) {
                $this->task_skip_messages[] = $this->prepare_roles_task_message($task);
            }
        }
    }

    public function check_task_trigger($task_skip_sub_category, $roles_empty_check_triggered)
    {
        $role_task_sub_categories = Role::get_role_task_sub_categories();
        $checking_roles_array = $role_task_sub_categories[$task_skip_sub_category];
        foreach ($checking_roles_array as $checking_role_array) {
            $search = array_search($checking_role_array, $roles_empty_check_triggered);
            if (!$search) {
                return false;
            }
        }
        return true;
    }

    function prepare_roles_task_message($task)
    {
        $task = $task->toArray();
        $role_id = $task['task_skip_sub_category'];
        $role = Role::find($role_id);
        $task['task_button_text'] = str_replace('[role]', $role->role_name, $task['task_button_text']);
        return array(
            'task_type' => 'roles_task',
            'task_id' => $task['task_id'],
            'message' => $this->get_greeting() . "  " . str_replace('[role]', $role->role_name, $task['task_message']),
            'task_row' => $task,
            'task_skip_sub_category' => $task['task_skip_sub_category']
        );
    }



}
