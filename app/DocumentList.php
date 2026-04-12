<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class DocumentList extends Document
{
    /*public $table_name = 'documents';
    public $table_name_document_content_types = 'document_content_types';
    private $table_name_documents_not_applicable = 'documents_not_applicable';*/







    public static function get_documents_not_applicable_hash($document)
    {
         $select_not_applicable = array("member_id",
        "document_content_type_id"
    ); // add to end only - do not remove any
        $hash_set = array();
        foreach ($select_not_applicable as $field) {
            $hash_set[] = $field . ":" . $document->$field;
        }
        return implode('|', $hash_set);
    }


    public static function get_documents_full_list()
    {
        $select_array = array("document_id",
            "document_notes", "document_file", "member_id",
            "member_first_name", "document_content_type_name",
            "document_content_type_id", "document_title",
            "document_created", "document_content_type_sub_category"
        , "category_key", "member_is_dependent", "document_owner_user_id"
        ); // add to end only - do not remove any

        $user_id = auth()->user()->id;
        $documents = null;
        $member_ids = Input::get('member_ids');//isset($_POST['member_ids']) && $_POST['member_ids'] != "" ? $_POST['member_ids'] : "";
        $where_adds = array(
            'missing_docs' => " AND document_id IS NULL ",
            'estate_key_docs' => " AND document_content_type_sub_category = 1 ",
            'by_member_ids' => " AND member_id IN(" . $member_ids . ")  ",
            'by_pet_ids' => " AND pet_id IN(" . $member_ids . ") ",
            'profile_docs' => " AND document_content_type_sub_category = 2 ",
            'spouse_docs' => " AND document_content_type_sub_category = 4 ",
            'dependent_docs' => " AND document_content_type_sub_category = 5 ",
            'not_applicable_docs' => " AND document_id IS NULL ",
        );

        $type = Input::get('type') != "" ? Input::get('type') : false;
        if ($type == 'no_data') {
            return array();
        }
        $where_add = $type ? $where_adds[$_POST['type']] : '';
        $select = implode(',', $select_array);
        $select_pet_array = $select_array;
        $select_pet_array[3] = " pet_id as member_id ";
        $select_pet_array[4] = " pet_name as member_first_name ";
        $select_pet_array[11] = " 0 as member_is_dependent ";

        $join_main = " LEFT JOIN documents_not_applicable ON 
 documents_not_applicable_hash = concat('member_id:',if(main_query.member_id>0,main_query.member_id,''),'|document_content_type_id:',document_content_type_id)
          AND documents_not_applicable_user_id = {$user_id}";
        $where_adds_main = array(
            'missing_docs' => "  documents_not_applicable_id IS NULL ",
            'not_applicable_docs' => " documents_not_applicable_id IS NOT NULL ",

        );
        $where_add_main = " WHERE ( document_owner_user_id = {$user_id} OR  document_owner_user_id IS NULL ) ";
        $where_add_main .= isset($where_adds_main[$type]) ? ' AND ' . $where_adds_main[$type] : '';

        $select_pet = implode(',', $select_pet_array);
        $sql = "
SELECT * FROM (SELECT {$select}
        FROM documents
          LEFT JOIN document_content_types ON document_content_type_id = document_content_type
  LEFT JOIN categories_sub on category_sub_id = document_content_type_sub_category
  LEFT JOIN members ON member_id = document_category_sub_sub
  WHERE document_content_type_sub_category IS NULL {$where_add}
UNION
SELECT {$select}
        FROM document_content_types
  LEFT JOIN categories_sub on category_sub_id = document_content_type_sub_category
  LEFT JOIN documents ON document_content_type_id = document_content_type
  LEFT JOIN members ON member_id = NULL
  WHERE document_content_type_sub_category IN(1,2) {$where_add}
UNION
SELECT {$select}  FROM document_content_types
  LEFT JOIN categories_sub on category_sub_id = document_content_type_sub_category
  LEFT JOIN documents ON document_content_type_id = document_content_type
  LEFT JOIN members ON member_id = document_category_sub_sub
  WHERE document_content_type_sub_category IN(4) {$where_add}
UNION
SELECT {$select}
 FROM members
  LEFT JOIN document_content_types ON
  document_content_type_sub_category IN(3)
  LEFT JOIN categories_sub on category_sub_id = document_content_type_sub_category
  LEFT JOIN documents ON document_content_type_id = document_content_type
  WHERE member_is_emergency_contact = 1 AND ( document_category_sub_sub = member_id OR document_category_sub_sub IS NULL) {$where_add}
UNION
SELECT {$select}
 FROM members
  LEFT JOIN document_content_types ON
  document_content_type_sub_category IN(5)
  LEFT JOIN categories_sub on category_sub_id = document_content_type_sub_category
  LEFT JOIN documents ON document_content_type_id = document_content_type
  WHERE member_is_dependent = 1 AND ( document_category_sub_sub = member_id OR document_category_sub_sub IS NULL)  {$where_add}
UNION
SELECT {$select}
 FROM members
  LEFT JOIN document_content_types ON
  document_content_type_sub_category IN(6)
  LEFT JOIN categories_sub on category_sub_id = document_content_type_sub_category
  LEFT JOIN documents ON document_content_type_id = document_content_type
  WHERE member_is_beneficiary = 1 AND ( document_category_sub_sub = member_id OR document_category_sub_sub IS NULL) {$where_add}
";
        if ($type != 'by_member_ids') {
            $sql .= "UNION
SELECT {$select_pet}
 FROM pets
  LEFT JOIN document_content_types ON
  document_content_type_sub_category IN(7)
  LEFT JOIN categories_sub on category_sub_id = document_content_type_sub_category
  LEFT JOIN documents ON document_content_type_id = document_content_type
  WHERE  ( document_category_sub_sub = pet_id OR document_category_sub_sub IS NULL)  {$where_add}";
        }

        if ($type == 'by_pet_ids') {
            $sql = "SELECT * FROM (SELECT {$select_pet}
 FROM pets
  LEFT JOIN document_content_types ON
  document_content_type_sub_category IN(7)
  LEFT JOIN categories_sub on category_sub_id = document_content_type_sub_category
  LEFT JOIN documents ON document_content_type_id = document_content_type
  ";
        }
        $sql .= " ) main_query {$join_main} {$where_add_main}";

        $result = DB::select(DB::raw($sql));
        if (count($result)) {
            $documents = $result;
        }
        return $documents;
    }

    /* public function process_document_not_applicable($not_applicable, $not_applicable_hash)
     {
         if ($not_applicable == 1) {
             $documents_not_applicable = array(
                 'documents_not_applicable_hash' => $not_applicable_hash,
                 'documents_not_applicable_user_id' => $this->user_id
             );
             $execution = $this->insert($this->table_name_documents_not_applicable,
                 array_values($documents_not_applicable), array_keys($documents_not_applicable));
         } else {
             $execution = $this->delete($this->table_name_documents_not_applicable, " documents_not_applicable_hash = '{$not_applicable_hash}' AND documents_not_applicable_user_id = {$this->user_id}");
         }
     }

 */
    public static function get_not_applicable_documents()
    {
        /* $documents_not_applicable = array();
         $execution = $this->select($this->table_name_documents_not_applicable, '*', " documents_not_applicable_user_id = {$this->user_id} ");
         if ($execution && $this->numResults > 0) {
             foreach ($this->result as $r) {
                 $documents_not_applicable[] = $r['documents_not_applicable_hash'];
             }
         }
         return $documents_not_applicable;*/
        $documents_not_applicable = array();
        $not_applicables = DB::table('documents_not_applicable')
            ->where('documents_not_applicable_user_id',auth()->user()->id)
            ->get();
        if($not_applicables) {
            foreach ($not_applicables as $document) {
                $documents_not_applicable[] = $document->documents_not_applicable_hash;
            }
        }
        return $documents_not_applicable;
    }
}