<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskDependent extends Task
{
    public $task_ids_no_dependents = [
        19
    ];

    public $task_ids_more_than_3 = [
        20
    ];

    public $task_ids_single_field = [
        21
    ];

    public $task_ids_remaining_dependent = [
        22
    ];

    public $task_ids_next_dependent = [
        23
    ];

    public function get_tasks_set()
    {
        $task_messages = array();
        $task_skip_messages = array();

        $profile = auth()->user()->profile;
        $profile_dependents = $profile->profile_dependents;
        $dependents = auth()->user()->dependents;

        if ($dependents == null || count($dependents) == 0) {
            $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_no_dependents);
            $task = Task::find($this->task_ids_no_dependents[0]);
            if ($task) {
                $task->task_skip_sub_category = 'no_dependents_';
                $task_message = $this->prepare_task_message($task, (object)array('member_id'=>0));
                if (self::is_task($task, $task_skip_keys)) {
                    $task_messages[] = $task_message;

                } elseif (self::is_skipped_task($task, $task_skip_keys)) {
                    $task_skip_messages[] = $task_message;
                }
            }
        } else {
            foreach ($dependents as $dependent) {
                $empty_log_row = EmptyLog::where(
                    ['empty_log_table_name' => 'members',
                        'empty_log_row_id' => $dependent->member_id])->first();
                if ($empty_log_row) {
                    $empty_fields_count = $empty_log_row->empty_log_number_of_fields;
                    if ($empty_fields_count >= 3) {
                        $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_more_than_3);
                        $task = Task::find($this->task_ids_more_than_3[0]);
                        $task->task_skip_sub_category = 'dependent_full_' . $dependent->member_id;
                        if (self::is_task($task, $task_skip_keys)) {
                            $task_messages[] = $this->prepare_task_message($task, $dependent);
                        } elseif (self::is_skipped_task($task, $task_skip_keys)) {
                            $task_skip_messages[] = $this->prepare_task_message($task, $dependent);
                        }
                    } elseif ($empty_fields_count > 0) {
                        $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_single_field);
                        $empty_log_fields = json_decode($empty_log_row->empty_log_fields);
                        foreach ($empty_log_fields as $field) {
                            $task = Task::find($this->task_ids_single_field[0]);
                            $task->task_skip_sub_category = 'dependent_single_' . $dependent->member_id . '|' . $field;
                            if (self::is_task($task, $task_skip_keys)) {
                                $task_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $dependent, $field);
                            } elseif (self::is_skipped_task($task, $task_skip_keys)) {
                                $task_skip_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $dependent, $field);
                            }
                        }
                    }

                    if ($empty_log_row->empty_log_image_empty_field != '') {
                        $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_single_field);
                        $task = Task::find($this->task_ids_single_field[0]);
                        $field = $empty_log_row->empty_log_image_empty_field;
                        $task->task_skip_sub_category = 'dependent_single_' . $dependent->member_id . '|' . 'empty_log_image_empty_field';
                        if (self::is_task($task, $task_skip_keys)) {
                            $task_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $dependent, $field, true);
                        } elseif (self::is_skipped_task($task, $task_skip_keys)) {
                            $task_skip_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $dependent, $field, true);
                        }
                    }
                }
            }
        }


        if (count($dependents) > 0 && $profile_dependents > 0 && ($profile_dependents - count($dependents)) == 1) {
            /* $task = $this->get_task_by_id_current_tasks(41);
             if ($task) {
                 $task_message = $this->prepare_task_message($task,0);
             }*/
            $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_remaining_dependent);
            $task = Task::find($this->task_ids_remaining_dependent[0]);
            $task->task_skip_sub_category = 'dependent_remaining_';
            if (self::is_task($task, $task_skip_keys)) {
                $task_messages[] = $this->prepare_task_message($task,  (object)array('member_id'=>0));
            } elseif (self::is_skipped_task($task, $task_skip_keys)) {
                $task_skip_messages[] = $this->prepare_task_message($task,  (object)array('member_id'=>0));
            }
        } elseif (count($dependents) > 0 && $profile_dependents > 0 && ($profile_dependents > count($dependents))) {
            $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_next_dependent);
            $task = Task::find($this->task_ids_next_dependent[0]);
            $task->task_skip_sub_category = 'dependent_next_';
            if (self::is_task($task, $task_skip_keys)) {
                $task_messages[] = $this->prepare_task_message($task,  (object)array('member_id'=>0));
            } elseif (self::is_skipped_task($task, $task_skip_keys)) {
                $task_skip_messages[] = $this->prepare_task_message($task,  (object)array('member_id'=>0));
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
        $member_id = $member->member_id ;
        $task = $task->toArray();
        $message = $task['task_message'];

        $message_data = array(
            'task_id' => $task['task_id'],
            'message' => $this->get_greeting() . ' ' . $message,
            'task_row' => $task,
            'task_skip_sub_category' => $task['task_skip_sub_category'],
        );
        $message_data['open_data']['class'] = 'dependents_content_box';
        $message_data['open_data']['member-id'] = $member_id;
        $message_data['open_data']['member-type'] = 'dependent';
        $message_data['task_row']['task_button_text'] .= $member->member_id  > 0 ? " " . $member->member_first_name:"";
        return $message_data;
    }

    public function prepare_empty_field_task_message($task, $empty_log_row, $member, $field, $image_field = false)
    {
        $member_id = $member->member_id ;
        $task = $task->toArray();
        $table_data = EmptyLog::get_table_data('Dependent');
        $sub_category_name = 'dependent';
        $message_data = array(
            'task_id' => isset($task['task_id']) ? $task['task_id'] : '',
            'empty_log_id' => isset($task['empty_log_id']) ? $task['empty_log_id'] : '',
            'task_skip_sub_category' => isset($task['task_skip_sub_category']) ? $task['task_skip_sub_category'] : '',
            'task_row' => $task
        );

        $field_name = $field;
        $field_label = str_replace($table_data['table_prefix'], ' ', $field_name);
        $field_label = ucwords(str_replace('_', ' ', $field_label));
        $message = "";
        if ($image_field) {
            $message = $this->task_image_messages[array_rand($this->task_image_messages)];
        } else {
            $message = $this->task_input_messages[array_rand($this->task_input_messages)];
        }
        $message = str_replace('[sub-category]', $sub_category_name, $message);
        $message = str_replace('[input-field]', strtolower($field_label), $message);
        $message = $this->get_greeting() . " " . $message;
        $message_data['message'] = $message;
        $message_data['form_type'] = $sub_category_name;
        if (strpos($message, 'photo')) {
            $message_data['task_row']['task_button_text'] = 'Update ' . 'Photo';
        } else {
            $message_data['task_row']['task_button_text'] = 'Update ' . $field_label;
        }

        $message_data['open_data']['class'] = 'dependents_content_box';
        $message_data['open_data']['member-id'] = $member_id;
        $message_data['open_data']['member-type'] = 'dependent';
        $message_data['task_row']['task_button_text'] .= " " . $member->member_first_name;

        return $message_data;
    }


    /*
        public function get_task_messages_dependents()
        {
            $member_obj = new MemberModel();
            $dependents = $member_obj->get_dependents_by_user_id($this->user_id);
            $task_messages_set = array();

            $profile_obj = new ProfileModel();
            $profile = $profile_obj->get_profile_by_profile_user_id($this->user_id);
            $profile_dependents = $profile['profile_dependents'];

            if (count($dependents) == 0) {
                $task = $this->get_task_by_id(39);
                if ($task) {
                    $task_message = $this->prepare_task_message($task);
                    $task_message['open_data']['class'] = 'dependents_content_box';
                    $task_message['open_data']['member-id'] = 0;
                    $task_messages_set[] = $task_message;
                }
            }

            foreach ($dependents as $dependent) {
                $dependent_member_id = $dependent['member_id'];
                $empty_fields_count = $this->get_empty_fields_count('members', "empty_log_row_key = {$dependent_member_id}");
                if ($empty_fields_count >= 3) {
                    $task = $this->get_task_by_id_current_tasks_for_member(12, $dependent_member_id);
                    if ($task) {
                        $task_message = $this->prepare_task_message($task);
                        $task_message['message'] .= " " . $dependent['member_first_name'] . ".";
                        $task_message['task_row']['task_button_text'] .= " " . $dependent['member_first_name'];
                        $task_message['open_data']['class'] = 'member_content_box';
                        $task_message['open_data']['member-member-id'] = $dependent_member_id;
                        $task_message['open_data']['member-type'] = 'current_dependent';
                        $task_message['empty_log_field_name'] = $dependent_member_id;
                        $task_messages_set[] = $task_message;
                    }
                } elseif ($empty_fields_count > 0) {
                    $task_messages = $this->get_empty_field_messages_members('members', $dependent_member_id, 'dependents');
                    foreach ($task_messages as $task_message) {
                        $task_message['message'] .= " " . $dependent['member_first_name'] . ".";
                        $task_message['task_row']['task_button_text'] .= " " . $dependent['member_first_name'];
                        $task_message['task_row']['single_entry'] = 1;
                        $task_message['open_data']['class'] = 'member_content_box';
                        $task_message['open_data']['member-member-id'] = $dependent_member_id;
                        $task_message['open_data']['member-type'] = 'current_dependent';
                        $task_message['empty_log_field_name'] = $task_message['task']['empty_log_id'] . '_' . $dependent_member_id;
                        $task_messages_set[] = $task_message;
                    }
                }
                $empty_field_messages_image = $this->get_empty_field_messages_image_members('members', $dependent_member_id, 'dependents');
                if ($empty_field_messages_image) {
                    $empty_field_messages_image[0]['task_row']['task_button_text'] .= " " . $dependent['member_first_name'];
                    $empty_field_messages_image[0]['open_data']['class'] = 'member_content_box';
                    $empty_field_messages_image[0]['open_data']['member-member-id'] = $dependent_member_id;
                    $empty_field_messages_image[0]['open_data']['member-type'] = 'current_dependent';
                    $empty_field_messages_image[0]['empty_log_field_name'] = $empty_field_messages_image[0]['task']['empty_log_id'] . '_' . $dependent_member_id;
                    $task_messages_set = array_merge($task_messages_set, $empty_field_messages_image);
                }

            }

            if (count($dependents) > 0 && $profile_dependents > 0 && ($profile_dependents - count($dependents)) == 1) {
                $task = $this->get_task_by_id_current_tasks(41);
                if ($task) {
                    $task_message = $this->prepare_task_message($task);
                    $task_message['open_data']['class'] = 'dependents_content_box';
                    $task_message['open_data']['member-id'] = 0;
                    $task_messages_set[] = $task_message;
                }
            } elseif (count($dependents) > 0 && $profile_dependents > 0 && ($profile_dependents > count($dependents))) {
                $task = $this->get_task_by_id_current_tasks(40);
                if ($task) {
                    $task_message = $this->prepare_task_message($task);
                    $task_message['open_data']['class'] = 'dependents_content_box';
                    $task_message['open_data']['member-id'] = 0;
                    $task_messages_set[] = $task_message;
                }
            }


            $task = $this->get_task_by_id_current_tasks(13);
            if ($task) {
                $task_message = $this->prepare_task_message($task);
                $task_messages_set[] = $task_message;
            }

            return $task_messages_set;
        }
        */
}
