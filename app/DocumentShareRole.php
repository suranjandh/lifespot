<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentShareRole extends Model
{
    protected $table = 'document_share_roles';

    protected $primaryKey = 'document_share_roles_id';

    protected $guarded = ['document_share_roles_id'];

    public $timestamps = false;

    public static function process_document_share_roles($document, $document_share_roles)
    {
        $document_share_roles_set = array();
        foreach ($document_share_roles as $r) {
            $roles = explode('_', $r);
            $document_share_roles_set = array_merge($document_share_roles_set, $roles);
        }

        $document_share_roles_set = array_unique($document_share_roles_set);
        if ($document_share_roles_set) {
            //$document_obj->share_document_to_roles($document_added, $document_share_roles_set);
            foreach ($document_share_roles_set as $role) {
                $documents_share_roles = array(
                    'document_share_roles_user' => auth()->user()->id,
                    'document_share_roles_role' => $role,
                    'document_share_roles_document' => $document->document_id
                );
                DocumentShareRole::where(['document_share_roles_document' => $document->document_id])->delete();
                DocumentShareRole::create($documents_share_roles);
            }
        }
    }


    public static function get_document_shared_roles($document_id){
       /* $document_shared_roles = array();
        $execution = $this->select($this->table_name,'*'," document_share_roles_document = {$document_id} ");
        if($execution && $this->numResults > 0){
            foreach ($this->result as $share_roles){
                $document_shared_roles[]= $share_roles['document_share_roles_role'];
            }
        }
        return $document_shared_roles ;*/
        $document_shared_roles = array();
        $document_shared = DocumentShareRole::where('document_share_roles_document',$document_id);
        if($document_shared){
            foreach ($document_shared as $share_roles){
                $document_shared_roles[]= $share_roles->document_share_roles_role;
            }
        }
        return $document_shared_roles ;
    }
}
