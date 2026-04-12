<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentShare extends Model
{

    protected $table = 'documents_share';

    protected $primaryKey = 'document_share_id';

    protected $guarded = ['document_share_id'];

    public $timestamps = false;

    public static function is_shared($document_share_set, $document_share_document_id, $document_share_member_id, $document_share_member_type)
    {
        return isset($document_share_set[$document_share_document_id . '||' . $document_share_member_id . '||' . $document_share_member_type]);
    }

    public static function make_share_key($document_share)
    {
        $key = $document_share->document_share_document_id . '||' . $document_share->document_share_member_id . '||' . $document_share->document_share_member_type;
        return $key;
    }


    public function add_share($documents_share)
    {
        /*$this->delete_share($documents_share);
        $shared = $this->insert($this->table_name, array_values($documents_share), array_keys($documents_share));
        return $shared;*/

    }

    public function delete_share($documents_share)
    {
        /*$where = $this->remove_false_condition_and_prepare_sub_query($documents_share, ' AND ');
        $share_delete = $this->delete($this->table_name, $where);
        return $share_delete;*/
    }

    public static function get_document_shares_set($document_share_document_id)
    {
     /*   $where = " document_id = $document_share_document_id ";
        $join = " JOIN " . $this->table_name . " ON  " . $this->table_name . ".document_share_document_id
         = " . $this->table_name_documents . ".document_id ";
        $execution = $this->select($this->table_name_documents, '*', $where, null, $join);
        $document_share_set = array();
        if ($execution && $this->numResults) {
            foreach ($this->result as $document_share) {
                $document_share_set[$this->make_share_key($document_share)] = $document_share;
            }
        }
        return $document_share_set;*/
        $document_share_set = array();
        $document_shares = Document::join('documents_share','documents_share.document_share_document_id','=','documents.document_id')
->where('document_id',$document_share_document_id)->get();
        if($document_shares) {
            foreach ($document_shares as $document_share) {
                $document_share_set[self::make_share_key($document_share)] = $document_share;
            }
        }
        return $document_share_set;
    }

    public function other_estate_documents_by_member_share($other_estate_member_id)
    {
      /*  $where = " document_share_member_id =  $other_estate_member_id ";
        $join = " JOIN {$this->table_name_documents} ON document_id = document_share_document_id";
        $execution = $this->select($this->table_name, '*', $where, null, $join);
        $document_share_set = array();
        if ($execution && $this->numResults) {
            $document_share_set = $this->result;
        }
        return $document_share_set;*/
        $other_estate_documents_by_member_share = DocumentShare::join('documents','documents.document_id','=','documents_share.document_share_document_id')
            ->where('document_share_member_id',$other_estate_member_id)->get();
        if($other_estate_documents_by_member_share){
          return  $other_estate_documents_by_member_share->toArray();
        }
        return array();
    }

    public function other_estate_documents_by_member_share_all($other_estate_member_id)
    {
       /* $member_obj = new MemberModel();
        $member = $member_obj->get_member_by_id($other_estate_member_id);
        $where = " document_share_members_all =  1 AND document_owner_user_id = {$member['member_owner_user_id']} ";
        $execution = $this->select($this->table_name_documents, '*', $where);
        $document_share_set = array();
        if ($execution && $this->numResults) {
            $document_share_set = $this->result;
        }
        return $document_share_set;*/
       $member = Member::find($other_estate_member_id);
       $other_estate_documents_by_member_share_all = Document::where('document_share_members_all',1)
            ->where('document_owner_user_id',$member->member_owner_user_id)
            ->get();
        if($other_estate_documents_by_member_share_all){
            return  $other_estate_documents_by_member_share_all->toArray();
        }
        return array();
    }

    public function other_estate_documents_by_roles_share($other_estate_member_id)
    {

     /*   $member_obj = new MemberModel();
        $document_share_roles_obj = new DocumentShareRolesModel();
        $where = " member_id =  $other_estate_member_id ";
        $join = " JOIN {$document_share_roles_obj->table_name} ON members.member_role_in_estate LIKE CONCAT('%',document_share_roles_role,'%') ";
        $join .= " JOIN {$this->table_name_documents} ON document_share_roles_document =  document_id ";
        $execution = $this->select($member_obj->table_name, '*', $where, null, $join);
        $document_share_set = array();
        if ($execution && $this->numResults) {
            $document_share_set = $this->result;
        }
        return $document_share_set;*/

        $other_estate_documents_by_roles_share =  Document::join('document_share_roles','document_share_roles.document_share_roles_document','=','documents.document_id')
            ->join('roles_members','roles_members.roles_members_role','=','document_share_roles.document_share_roles_role')
            ->where('roles_members_member','=',$other_estate_member_id)
            ->get();
        if($other_estate_documents_by_roles_share){
            return  $other_estate_documents_by_roles_share->toArray();
        }
        return array();
    }

    public function get_other_estate_documents($other_estate_member_id)
    {
        $other_estate_documents1 = $this->other_estate_documents_by_member_share($other_estate_member_id);
        $other_estate_documents2 = $this->other_estate_documents_by_roles_share($other_estate_member_id);
        $other_estate_documents3 = $this->other_estate_documents_by_member_share_all($other_estate_member_id);

        $other_estate_documents = (object)array_merge($other_estate_documents1, $other_estate_documents2,$other_estate_documents3);
        $other_estate_documents_set = array();
        if ($other_estate_documents) {
            foreach ($other_estate_documents as $document) {
                $other_estate_documents_set[$document['document_id']] = $document;
            }
        }
        return $other_estate_documents_set;
    }

    public function share_to_members_set($document_id, $members_to_share)
    {
      /*  $member_obj = new MemberModel();
        foreach ($members_to_share as $member_to_share) {
            $document_share = array(
                'document_share_document_id' => $document_id,
                'document_share_member_id' => $member_to_share['member_id'],
                'document_share_member_type' => 'current_' . $member_obj->get_member_type($member_to_share)
            );
            $this->add_share($document_share);
        }*/
    }
}
