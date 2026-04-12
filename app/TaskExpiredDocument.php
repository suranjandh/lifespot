<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaskExpiredDocument extends Task
{

    private $task_ids_expired_doc = [
        35
    ];


    public function get_tasks_set($days = 365)
    {
        $task_messages = array();
        $task_skip_messages = array();

   /*    $sql = "SELECT  CONCAT(document_category,'|' , document_category_sub ,'|' ,  document_category_sub_sub,'|' , document_content_types.document_content_type_id)  as task_skip_sub_category ,  document_category , document_category_sub , document_category_sub_sub , document_content_type_id , document_content_type_name  ,member_id , document_id, document_title, max(document_created) as document_created_latest
FROM documents JOIN document_content_types ON  document_content_type_id = document_content_type
        LEFT JOIN members ON  member_id = document_content_type_sub_category
 WHERE   document_owner_user_id = " . auth()->user()->id . " AND  DATEDIFF(NOW(), document_created) > {$days}
 GROUP BY document_content_type_id ,member_id ";*/

       /*$expired_documents = DB::table('documents')
            ->select(DB::raw("CONCAT(document_category,'|' , document_category_sub ,'|' ,  document_category_sub_sub,'|' , document_content_types.document_content_type_id)  as task_skip_sub_category ,  document_category , document_category_sub , document_category_sub_sub , document_content_type_id , document_content_type_name  ,member_id , document_id, document_title, max(document_created) as document_created_latest"))
            ->join('document_content_types','document_content_types.document_content_type_id','=','documents.document_content_type')
            ->leftJoin('members','members.member_id','=','document_content_types.document_content_type_sub_category')
            ->where("document_owner_user_id" ,"=" , auth()->user()->id  )
            ->where(DB::raw("DATEDIFF(NOW(), max(document_created)) > $days "))
            ->groupBy(["document_content_type_id"])
            ->get();*/

        $sql = "SELECT * FROM (SELECT  CONCAT(document_category,'|' , document_category_sub ,'|' ,  document_category_sub_sub,'|' , document_content_types.document_content_type_id)  as task_skip_sub_category ,  document_category , document_category_sub , document_category_sub_sub , document_content_type_id , document_content_type_name  ,member_id , document_id, document_title, max(document_created) as document_created_latest
FROM documents JOIN document_content_types ON  document_content_type_id = document_content_type
        LEFT JOIN members ON  member_id = document_content_type_sub_category
 WHERE   document_owner_user_id = ". auth()->user()->id ."
 GROUP BY document_content_type_id ,member_id ) sub_query 
      where  DATEDIFF(NOW(), document_created_latest) > {$days} ";

       $expired_documents = DB::select($sql);
        if ($expired_documents) {
            foreach ($expired_documents as $expired_document) {
                $task_skip_keys = TaskSkip::task_skip_keys($this->task_ids_expired_doc);
                $task = Task::find($this->task_ids_expired_doc[0]);
                $task->task_skip_sub_category = $expired_document->task_skip_sub_category;
                /*   if (!in_array($task->task_id . '||' . $task->task_skip_sub_category, $task_skip_keys)) {
                       $task_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $field);
                   } else {
                       $task_skip_messages[] = $this->prepare_empty_field_task_message($task, $empty_log_row, $field);
                   }*/
                if (self::is_task($task, $task_skip_keys)) {
                    $task_messages[] = $this->prepare_expired_document_message_content_type($expired_document, $task);
                } elseif (self::is_skipped_task($task, $task_skip_keys)) {
                    $task_skip_messages[] = $this->prepare_expired_document_message_content_type($expired_document, $task);
                }

            }
        }

        $task_set = array(
            'task_messages' => $task_messages,
            'task_skip_messages' => $task_skip_messages
        );

        return $task_set;
    }

    public function prepare_expired_document_message_content_type($out_dated_document, $task)
    {
        $task = $task->toArray();
        $date = date('F d, Y', strtotime($out_dated_document->document_created_latest));
        $message = str_replace('[document-created-date]', $date, $task['task_message']);
        $message = str_replace('[document-name]', $out_dated_document->document_title, $message);
        $message = $this->get_greeting() . str_replace('[document-content-type]', $out_dated_document->document_content_type_name, $message);
        $member_name_replace = '';
        if ($out_dated_document->document_category_sub_sub > 0) {
            $member = Member::find($out_dated_document->document_category_sub_sub);
            if ($member)
                $member_name_replace = ' member "' . $member->member_first_name . '"';
        } else {
            $member_name_replace = '';
        }
        $message = str_replace('[member-first-name]', $member_name_replace, $message);
        $message_data = array(
            'task_id' => $task['task_id'],
            'message' => $message,
            'task_row' => $task,
            'task_button_text' => $task['task_button_text'],
            'switch_to' => array(
                'category' => $out_dated_document->document_category,
                'sub_category' => $out_dated_document->document_category_sub,
                'sub_sub_category' => $out_dated_document->document_category_sub_sub
            )
        );
        $message_data['open_data']['class'] = 'document_tabs_open';
        $message_data['open_data']['document-category'] = $out_dated_document->document_category;
        $message_data['open_data']['document-category-sub'] = $out_dated_document->document_category_sub;
        $message_data['open_data']['document-category-sub-sub'] = $out_dated_document->document_category_sub_sub;
        $message_data['open_data']['document-content-type'] = $out_dated_document->document_content_type_id;
        $message_data['task_skip_sub_category'] = $out_dated_document->document_category . '|' . $out_dated_document->document_category_sub . '|' . $out_dated_document->document_category_sub_sub . '|' . $out_dated_document->document_content_type_id;

        return $message_data;
    }

   /* public function get_expired_document_messages_content_types_skipped($days = 365) // ($days = 365)
    {
        $task = $this->get_task_by_id(80);

        $expired_document_messages = array();
        $sql = "SELECT * FROM (SELECT  CONCAT(document_category,'|' , document_category_sub ,'|' ,  document_category_sub_sub,'|' , document_content_types.document_content_type_id)  as empty_log_field_name ,  document_category , document_category_sub , document_category_sub_sub , document_content_type_id , document_content_type_name  ,member_id , document_id, document_title, max(document_created) as document_created_latest
FROM documents JOIN document_content_types ON  document_content_type_id = document_content_type
        LEFT JOIN members ON  member_id = document_content_type_sub_category
 WHERE   document_owner_user_id = {$this->user_id}
 GROUP BY document_content_type_id ,member_id ) sub_query LEFT JOIN task_skips ON task_skip_sub_category =  sub_query.empty_log_field_name
      where  DATEDIFF(NOW(), document_created_latest) > {$days} AND task_skip_sub_category IS NOT NULL";
        $execution = $this->select_query($sql);
        if ($execution && $this->numResults > 0) {
            foreach ($this->result as $document_content_type_expire) {
                $expired_document_messages[] = $this->prepare_expired_document_message_content_type($document_content_type_expire, $task);
            }
            //return $this->result;
        }
        return $expired_document_messages;
    }

    public function prepare_expired_document_message_content_type($out_dated_document, $task)
    {
        $member_obj = new MemberModel();
        $date = date('F d, Y', strtotime($out_dated_document['document_created_latest']));
        $message = str_replace('[document-created-date]', $date, $task['task_message']);
        $message = str_replace('[document-name]', $out_dated_document['document_title'], $message);
        $message = $this->get_greeting() . str_replace('[document-content-type]', $out_dated_document['document_content_type_name'], $message);
        $member_name_replace = '';
        if ($out_dated_document['document_category_sub_sub'] > 0) {
            $member = $member_obj->get_member_by_id($out_dated_document['document_category_sub_sub']);
            if($member)
                $member_name_replace = ' member "' . $member['member_first_name'] . '"';
        } else {
            $member_name_replace = '';
        }
        $message = str_replace('[member-first-name]', $member_name_replace, $message);
        $message_data = array(
            'task_id' => $task['task_id'],
            'message' => $message,
            'task_row' => $task,
            'task_button_text' => $task['task_button_text'],
            'switch_to' => array(
                'category' => $out_dated_document['document_category'],
                'sub_category' => $out_dated_document['document_category_sub'],
                'sub_sub_category' => $out_dated_document['document_category_sub_sub']
            )
        );
        $message_data['open_data']['class'] = 'document_tabs_open';
        $message_data['open_data']['document-category'] = $out_dated_document['document_category'];
        $message_data['open_data']['document-category-sub'] = $out_dated_document['document_category_sub'];
        $message_data['open_data']['document-category-sub-sub'] = $out_dated_document['document_category_sub_sub'];
        $message_data['open_data']['document-content-type'] = $out_dated_document['document_content_type_id'];
        $message_data['empty_log_field_name'] = $out_dated_document['document_category'].'|'.$out_dated_document['document_category_sub'].'|'.$out_dated_document['document_category_sub_sub'].'|'.$out_dated_document['document_content_type_id'];

        return $message_data;
    }*/

}

