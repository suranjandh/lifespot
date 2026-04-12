<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskEstate extends Task
{
    // 6
    public $task_ids_more_than_3 = [
        10
    ];

    public $task_ids_single_field = [
        11
    ];

    public function get_tasks_set()
    {
        $task_messages = array();
        $task_skip_messages = array();

        $estate_found = auth()->user()->estate;
        $empty_log_row = EmptyLog::where(
            ['empty_log_table_name' => 'estates',
                'empty_log_row_id' => $estate_found->estate_id])->first();
        if ($empty_log_row) {
            $empty_fields_count = $empty_log_row->empty_log_number_of_fields;
            if ($empty_fields_count >= 3) {
                $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_more_than_3);
                $task = Task::find(10);
                if (self::is_task($task,$task_skip_keys)) {
                    $task_messages[] = $this->prepare_task_message($task);
                } elseif(self::is_skipped_task($task,$task_skip_keys)) {
                    $task_skip_messages[] = $this->prepare_task_message($task);
                }
            } elseif ($empty_fields_count > 0) {
                $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_single_field);
                $empty_log_fields = json_decode($empty_log_row->empty_log_fields);
                foreach ($empty_log_fields as $field) {
                    $task = Task::find(11);
                    $task->task_skip_sub_category = $field;
                 /*   if (!in_array($task->task_id . '||' . $task->task_skip_sub_category, $task_skip_keys)) {
                        $task_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $field);
                    } else {
                        $task_skip_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $field);
                    }*/
                    if (self::is_task($task,$task_skip_keys)) {
                        $task_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $field);
                    } elseif(self::is_skipped_task($task,$task_skip_keys)) {
                        $task_skip_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $field);
                    }
                }
            }

            if($empty_log_row->empty_log_image_empty_field != ''){
                $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_single_field);
                $task = Task::find($this->task_ids_single_field[0]);
                $field = $empty_log_row->empty_log_image_empty_field;
                $task->task_skip_sub_category = 'empty_log_image_empty_field';
               /* if (!in_array($task->task_id . '||' . $task->task_skip_sub_category, $task_skip_keys)) {
                    $task_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $field,true);
                } else {
                    $task_skip_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $field,true);
                }*/
                if (self::is_task($task,$task_skip_keys)) {
                    $task_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $field,true);
                } elseif(self::is_skipped_task($task,$task_skip_keys)) {
                    $task_skip_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $field,true);
                }
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
        $message_data['open_data']['class'] = 'member_content_box';
        $message_data['open_data']['member-member-id'] = 0;
        $message_data['open_data']['member-type'] = 'estate';
        return $message_data;
    }

    public function prepare_empty_field_task_message($task, $empty_log_row, $field, $image_field = false)
    {
        $task = $task->toArray();
        $table_data = EmptyLog::get_table_data('Estate');
        $sub_category_name = 'estate';
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

        $message_data['open_data']['class'] = 'member_content_box';
        $message_data['open_data']['member-member-id'] = 0;
        $message_data['open_data']['member-type'] = 'estate';
        return $message_data;
    }
    /*
        public function prepare_empty_field_task_message($task, $role = false)
        {
            $message_array = array(
                'task_id' => isset($task['task_id']) ? $task['task_id'] : '',
                'empty_log_id' => isset($task['empty_log_id']) ? $task['empty_log_id'] : '',
                'empty_log_field_name' => isset($task['empty_log_field_name']) ? $task['empty_log_field_name'] : '',
                'message' => null,
                'form_type' => null,
                'switch_to' => array(
                    'category' => 0,
                    'sub_category' => 0,
                    'sub_sub_category' => 0
                ),
                'task' => $task
            );
            $sub_category = $this->get_sub_category_of_row(
                $task['empty_log_table_name'],
                $this->empty_log_tables[$task['empty_log_table_name']]['primary_key'],
                $task['empty_log_row_key'], $role);
            $sub_category_name = $sub_category ? $sub_category['category_sub_name'] : ' ';
            $field_name = $task['empty_log_field_name'];
            $field_label = str_replace($this->empty_log_tables[$task['empty_log_table_name']]['table_prefix'], ' ', $field_name);
            $field_label = ucwords(str_replace('_', ' ', $field_label));
            $message = "";
            if ($field_name ==
                $this->empty_log_tables[$task['empty_log_table_name']]['image_field']
            ) {
                $message = $this->task_image_messages[array_rand($this->task_image_messages)];
                if ($sub_category['type_of_sub_category'] == 'current_spouse') {
                    $message = str_replace('members', 'spouse', $message);
                }
            } else {
                $message = $this->task_input_messages[array_rand($this->task_input_messages)];
            }
            $message = str_replace('[sub-category]', strtolower($sub_category_name), $message);
            $message = str_replace('[input-field]', strtolower($field_label), $message);
            $message = $this->get_greeting() . " " . $message;
            $message_array['message'] = $message;
            $message_array['form_type'] = $sub_category_name;
            if (strpos($message, 'photo')) {
                $message_array['task_row']['task_button_text'] = 'Update ' . 'Photo';
            } else {
                // $message_array['task_row']['task_button_text'] = 'Update ' . $sub_category_name;
                $message_array['task_row']['task_button_text'] = 'Update ' . $field_label;
            }
            $message_array['switch_to'] = array(
                'category' => $sub_category['category_key'],
                'sub_category' => $sub_category['category_sub_id'],
                'sub_sub_category_key' => isset($sub_category['sub_sub_category_key']) ? $sub_category['sub_sub_category_key'] : 0,
                'sub_sub_sub_category_key' => isset($sub_category['sub_sub_sub_category_key']) ? $sub_category['sub_sub_sub_category_key'] : 0,
            );
            $message_array['open_data']['class'] = 'member_content_box';
            $message_array['open_data']['member-member-id'] = $task['empty_log_row_key'];
            $message_array['open_data']['member-type'] = $sub_category['type_of_sub_category'];
            return $message_array;
        }
    */
    /*
        public function get_table_task_messages($table, $where = '')
        {
            $empty_fields_count = $this->get_empty_fields_count($table, $where);
            $task_messages_set = array();
            if ($empty_fields_count >= 3) {
                switch ($table) {
                    case 'estates':
                        $task = $this->get_task_by_id_current_tasks(6);
                        if ($task) {
                            $task_message = $this->prepare_task_message($task);
                            $task_message['open_data']['class'] = 'member_content_box';
                            $task_message['open_data']['member-member-id'] = 0;
                            $task_message['open_data']['member-type'] = 'current_estate';
                            $task_messages_set[] = $task_message;
                        }
                        break;
                    case 'profiles':
                        $task = $this->get_task_by_id_current_tasks(8);
                        if ($task) {
                            $task_message = $this->prepare_task_message($task);
                            $profile_obj = new ProfileModel();
                            $profile = $profile_obj->get_profile_by_profile_user_id($this->user_id);
                            $task_message['open_data']['class'] = 'member_content_box';
                            $task_message['open_data']['member-member-id'] = $profile['profile_id'];
                            $task_message['open_data']['member-type'] = 'current_profile';
                            $task_messages_set[] = $task_message;
                        }
                        break;
                    case 'members':
                        if ($where == 'member_is_spouse = 1') {
                            $task = $this->get_task_by_id_current_tasks(10);
                            if ($task) {
                                $task_message = $this->prepare_task_message($task);
                                $member_obj = new MemberModel();
                                $member = $member_obj->find_spouse($this->user_id);
                                $task_message['open_data']['class'] = 'member_content_box';
                                $task_message['open_data']['member-member-id'] = $member['member_id'];
                                $task_message['open_data']['member-type'] = 'current_spouse';
                                $task_messages_set[] = $task_message;
                            }
                        }
                        break;
                }
            } elseif ($empty_fields_count > 0) {
                $empty_field_messages = $this->get_empty_field_messages($table);
                if ($empty_field_messages)
                    $task_messages_set = array_merge($task_messages_set, $empty_field_messages);
            }
            $empty_field_messages_image = $this->get_empty_field_messages_image($table, $where);
            if ($where == 'member_is_spouse = 1') {
                $member_obj = new MemberModel();
                $member = $member_obj->find_spouse($this->user_id);
                $empty_field_messages_image = $this->get_empty_field_messages_image_members("members", $member['member_id'], "spouses");
                if ($empty_field_messages_image) {
                    $empty_field_messages_image[0]['open_data']['class'] = 'member_content_box';
                    $empty_field_messages_image[0]['open_data']['member-member-id'] = $member['member_id'];
                    $empty_field_messages_image[0]['open_data']['member-type'] = 'current_spouse';
                    //$empty_log_field_name =
                    //$empty_field_messages_image[0]['empty_log_field_name'] = 'member_image_' . $member['member_id'];
                    $empty_field_messages_image[0]['empty_log_field_name'] = $empty_field_messages_image[0]['task']['empty_log_id'] . '_' . $member['member_id'];
                }

                //  $empty_field_messages_image[0]['task_row']['task_button_text'] .= " " . $dependent['member_first_name'];
                // $empty_field_messages_image[0]['open_data']['class'] = 'member_content_box';
                // $empty_field_messages_image[0]['open_data']['member-member-id'] = $dependent_member_id;
                ///  $empty_field_messages_image[0]['open_data']['member-type'] = 'current_dependent';
                // $empty_field_messages_image[0]['empty_log_field_name'] = $empty_field_messages_image[0]['task']['empty_log_id'] . '_' . $dependent_member_id;
                //     $task_messages_set = array_merge($task_messages_set, $empty_field_messages_image);

                //$task_messages_set[] = $empty_field_messages_image;
            }
            if ($empty_field_messages_image)
                $task_messages_set = array_merge($task_messages_set, $empty_field_messages_image);
            switch ($table) {
                case 'estates':
                    $task = $this->get_task_by_id_current_tasks(7);
                    if ($task)
                        $task_messages_set[] = $this->prepare_task_message($task);
                    break;
                case 'profiles':
                    $task = $this->get_task_by_id_current_tasks(9);
                    if ($task)
                        $task_messages_set[] = $this->prepare_task_message($task);
                    break;
            }
            return $task_messages_set;
        }
    */


}
