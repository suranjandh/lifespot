<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskEmergencyContact extends Task
{
    public $task_ids_no_ememrgency_contacts = [
        27
    ];

    public $task_ids_more_than_3 = [
        28
    ];

    public $task_ids_single_field = [
        29
    ];


    public function get_tasks_set()
    {
        $task_messages = array();
        $task_skip_messages = array();

        $ememrgency_contacts = auth()->user()->ememrgency_contacts;

        if ($ememrgency_contacts == null || count($ememrgency_contacts) == 0) {
            $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_no_ememrgency_contacts);
            $task = Task::find($this->task_ids_no_ememrgency_contacts[0]);
            if ($task) {
                $task->task_skip_sub_category = 'no_ememrgency_contacts_';
                $task_message = $this->prepare_task_message($task, (object)array('member_id'=>0));
                if (self::is_task($task, $task_skip_keys)) {
                    $task_messages[] = $task_message;

                } elseif (self::is_skipped_task($task, $task_skip_keys)) {
                    $task_skip_messages[] = $task_message;
                }
            }
        } else {
            foreach ($ememrgency_contacts as $ememrgency_contact) {
                $empty_log_row = EmptyLog::where(
                    ['empty_log_table_name' => 'members',
                        'empty_log_row_id' => $ememrgency_contact->member_id])->first();
                if ($empty_log_row) {
                    $empty_fields_count = $empty_log_row->empty_log_number_of_fields;
                    if ($empty_fields_count >= 3) {
                        $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_more_than_3);
                        $task = Task::find($this->task_ids_more_than_3[0]);
                        $task->task_skip_sub_category = 'ememrgency_contact_full_' . $ememrgency_contact->member_id;
                        if (self::is_task($task, $task_skip_keys)) {
                            $task_messages[] = $this->prepare_task_message($task, $ememrgency_contact);
                        } elseif (self::is_skipped_task($task, $task_skip_keys)) {
                            $task_skip_messages[] = $this->prepare_task_message($task, $ememrgency_contact);
                        }
                    } elseif ($empty_fields_count > 0) {
                        $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_single_field);
                        $empty_log_fields = json_decode($empty_log_row->empty_log_fields);
                        foreach ($empty_log_fields as $field) {
                            $task = Task::find($this->task_ids_single_field[0]);
                            $task->task_skip_sub_category = 'ememrgency_contact_single_' . $ememrgency_contact->member_id . '|' . $field;
                            if (self::is_task($task, $task_skip_keys)) {
                                $task_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $ememrgency_contact, $field);
                            } elseif (self::is_skipped_task($task, $task_skip_keys)) {
                                $task_skip_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $ememrgency_contact, $field);
                            }
                        }
                    }

                    if ($empty_log_row->empty_log_image_empty_field != '') {
                        $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_single_field);
                        $task = Task::find($this->task_ids_single_field[0]);
                        $field = $empty_log_row->empty_log_image_empty_field;
                        $task->task_skip_sub_category = 'ememrgency_contact_single_' . $ememrgency_contact->member_id . '|' . 'empty_log_image_empty_field';
                        if (self::is_task($task, $task_skip_keys)) {
                            $task_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $ememrgency_contact, $field, true);
                        } elseif (self::is_skipped_task($task, $task_skip_keys)) {
                            $task_skip_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $ememrgency_contact, $field, true);
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
        $message = $task['task_message'];

        $message_data = array(
            'task_id' => $task['task_id'],
            'message' => $this->get_greeting() . ' ' . $message,
            'task_row' => $task,
            'task_skip_sub_category' => $task['task_skip_sub_category'],
        );
        $message_data['open_data']['class'] = 'member_content_box';
        $message_data['open_data']['member-id'] = $member->member_id;
        $message_data['open_data']['member-type'] = 'member';
        $message_data['task_row']['task_button_text'] .= $member->member_id  > 0 ? " " . $member->member_first_name:"";
        return $message_data;
    }

    public function prepare_empty_field_task_message($task, $empty_log_row, $member, $field, $image_field = false)
    {
        $task = $task->toArray();
        $table_data = EmptyLog::get_table_data('ememrgency_contact');
        $sub_category_name = 'ememrgency_contact';
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

        $message_data['message'] .= " " . $member->member_first_name . ".";
        $message_data['task_row']['task_button_text'] .= " " . $member->member_first_name;
        $message_data['open_data']['class'] = 'member_content_box';
        $message_data['open_data']['member-member-id'] = $member->member_id;
        $message_data['open_data']['member-type'] = 'member';
        $message_data['empty_log_field_name'] = $member->member_id;
        return $message_data;
    }


}

