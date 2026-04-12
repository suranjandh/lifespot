<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskDocument extends Task
{
//(34,35,36,37,38,79)
    public $task_ids_main_all = [
        17
    ];

    public $task_ids_main_no_spouse = [
        16
    ];

    public $task_ids_sub_all = [
        18
    ];

    // task_skip_sub_category = member id
    public function get_tasks_set()
    {
        $task_messages = array();
        $task_skip_messages = array();


        $estate_no_doc = Document::get_document_counts_by_category_sub(1) > 0 ? false : true;
        $profile_no_doc = Document::get_document_counts_by_category_sub(2) > 0 ? false : true;
        $spouse_no_doc = Document::get_document_counts_by_category_sub(4) > 0 ? false : true;
        if ($estate_no_doc && $profile_no_doc) {
            if (Profile::is_married() && $spouse_no_doc) {
                $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_main_all);
                $task = Task::find($this->task_ids_main_all[0]);
                $task->task_skip_sub_category = 'no_doc_category_main_all';
                if (self::is_task($task, $task_skip_keys)) {//(!in_array($task->task_id . '||' . $task->task_skip_sub_category, $task_skip_keys[0])) {
                    $task_messages[] = $this->prepare_task_message($task);
                } elseif (self::is_skipped_task($task, $task_skip_keys)) {//if(in_array($task->task_id . '||' . $task->task_skip_sub_category, $task_skip_keys[1])) {
                    $task_skip_messages[] = $this->prepare_task_message($task);
                }
            } else {
                $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_main_no_spouse);
                $task = Task::find($this->task_ids_main_no_spouse[0]);
                $task->task_skip_sub_category = 'no_doc_category_main_no_spouse';
                if (self::is_task($task, $task_skip_keys)) {
                    $task_messages[] = $this->prepare_task_message($task);
                } elseif (self::is_skipped_task($task, $task_skip_keys)) {
                    $task_skip_messages[] = $this->prepare_task_message($task);
                }
            }
        }


        $beneficiary_no_doc = Document::get_document_counts_by_category_sub(6) > 0 ? false : true;//$this->get_no_document_messages_by_category_sub(6);
        $er_no_doc = Document::get_document_counts_by_category_sub(3) > 0 ? false : true;// $this->get_no_document_messages_by_category_sub(3);
        $dependent_no_doc = Document::get_document_counts_by_category_sub(5) > 0 ? false : true;// $this->get_no_document_messages_by_category_sub(5);
        $pets_no_doc = Document::get_document_counts_by_category_sub(7) > 0 ? false : true; // $this->get_no_document_messages_by_category_sub(7);

        if ($beneficiary_no_doc && !$er_no_doc && $dependent_no_doc && $pets_no_doc) {
            $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_sub_all);
            $task = Task::find($this->task_ids_sub_all[0]);
            $task->task_skip_sub_category = 'no_doc_category_sub_all';
            if (self::is_task($task, $task_skip_keys)) {//(!in_array($task->task_id . '||' . $task->task_skip_sub_category, $task_skip_keys[0])) {
                $task_messages[] = $this->prepare_task_message($task);
            } elseif (self::is_skipped_task($task, $task_skip_keys)) {//if(in_array($task->task_id . '||' . $task->task_skip_sub_category, $task_skip_keys[1])) {
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
        $task_message = array(
            'task_type' => $task['task_category'],
            'task_id' => $task['task_id'],
            'message' => $this->first_name . $task['task_message'],
            'task_row' => $task,
            'task_skip_sub_category' => $task['task_skip_sub_category']
        );
        // $task_message['task_row']['task_button_text'] = "Got It";
        // $task_message['task_row']['task'] = array();
        $task_message['open_data']['class'] = 'delete_task';

        return $task_message;
    }

//    public function get_no_document_sub_categories(){
//        $category_obj = new CategoryModel();
//        $document_obj = new DocumentModel();
//        $profile_obj = new ProfileModel();
//        $join = " LEFT JOIN (SELECT document_category_sub , document_owner_user_id , count(document_id) as document_count FROM {$document_obj->table_name} WHERE document_owner_user_id = {$this->user_id} GROUP BY document_category_sub ) A
//        ON A.document_category_sub = {$category_obj->sub_category_table}.category_sub_id";
//        $join .= " LEFT JOIN {$this->task_skip_table} ON {$this->task_skip_table}.task_skip_sub_category =  {$category_obj->sub_category_table}.category_sub_id AND task_skip_user_id = {$this->user_id}
//        AND task_skip_task_id =  4 ";
//        $category_sub_where = " category_sub_id = $category_sub_id  ";
//        $where = " {$category_sub_where}  AND  A.document_count IS null  AND task_skip_sub_category is null  ";
//        $no_document_sub_categories = array();
//        $execution = $this->select($category_obj->sub_category_table, '*', $where, null, $join, null);
//        if ($execution && $this->numResults > 0) {
//            $no_document_sub_categories = $this->result;
//        }
//    }


    /*  public function get_document_task_messages_main(){
         $estate_no_doc =  $this->get_no_document_messages_by_category_sub(1);
         $profile_no_doc =  $this->get_no_document_messages_by_category_sub(2);
         $spouse_no_doc = array();
         $profile_obj = new ProfileModel();
         $taks_message = " dont forget to upload documents about your estate, yourself . Please go back to those forms and upload your important documents.  ";
         if ($profile_obj->is_married($this->user_id)) {
             $spouse_no_doc = $this->get_no_document_messages_by_category_sub(4);
             $taks_message = " dont forget to upload documents about your estate, yourself or your marriage. Please go back to those forms and upload your important documents.  ";
         }
         //$task = $this->get_task_by_id(80);
         $task_message = array(
             'task_type' => 'no_doc_main',
             'task_id' => 200,
             'message' => $this->first_name . $taks_message ,
             'task_row' => array(
                 'task_id'=>200
             ),
             'empty_log_field_name' => ''
         );
         $task_message['task_row']['task_button_text'] = "Got It";
         $task_message['task_row']['task'] = array();
         $task_message['open_data']['class'] = 'delete_task';
         $execution = $this->select_query("select * from task_skips where task_skip_user_id = {$this->user_id} AND task_skip_task_id = 200");
         if($execution && $this->numResults > 0){
             return array();
         }
         if(count($estate_no_doc) > 0 && count($profile_no_doc) > 0  ) {
             if($profile_obj->is_married($this->user_id) && count($spouse_no_doc) == 0 ) {
                 return array();
             }
             return $task_message;
         }
         return array();
     }

     public function get_document_task_messages_sub(){
         $beneficiary_no_doc =  $this->get_no_document_messages_by_category_sub(6);
         $er_no_doc =  $this->get_no_document_messages_by_category_sub(3);
         $dependent_no_doc =  $this->get_no_document_messages_by_category_sub(5);
         $pets_no_doc =  $this->get_no_document_messages_by_category_sub(7);

         $taks_message = " dont forget to upload documents for your dependents, beneficiaries, pets, and emergency contacts. Please go back to those forms and upload your important documents. ";

         //$task = $this->get_task_by_id(80);
         $task_message = array(
             'task_type' => 'no_doc_main',
             'task_id' => 300,
             'message' => $this->first_name . $taks_message ,
             'task_row' => array(
                 'task_id'=>300
             ),
             'empty_log_field_name' => ''
         );
         $task_message['task_row']['task_button_text'] = "Got It";
         $task_message['task_row']['task'] = array();
         $task_message['open_data']['class'] = 'delete_task';
         $execution = $this->select_query("select * from task_skips where task_skip_user_id = {$this->user_id} AND task_skip_task_id = 300");
         if($execution && $this->numResults > 0){
             return array();
         }
         if(count($beneficiary_no_doc) > 0  && count($er_no_doc) > 0
             && count($pets_no_doc) > 0
             && count($dependent_no_doc) > 0  ) {

             return $task_message;
         }
         return array();
     }
 }*/

}
