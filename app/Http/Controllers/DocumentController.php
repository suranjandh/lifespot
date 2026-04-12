<?php

namespace App\Http\Controllers;

use App\Document;
use App\DocumentShareRole;
use App\Helpers\Helper;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class DocumentController extends Controller
{
    use UploadTrait;

    public function ajax_return_view()
    {
        $view = Input::get('view');
        return view($view, Input::all());
    }

    public function add_document(Request $request)
    {
        $file_document = $request->file('document_file');

        $document_file_name = Input::get('document_file_name');
        $document_title = $document_file_name && $document_file_name != '' ? $document_file_name : $file_document->name;
        $document_notes = Input::get('document_notes') ? Input::get('document_notes') : '';
        $document_category = Input::get('document_category') && Input::get('document_category') > 0 ? Input::get('document_category') : 0;
        $document_category_sub = Input::get('document_category_sub') && Input::get('document_category_sub') > 0 ? Input::get('document_category_sub') : 0;
        $document_category_sub_sub = Input::get('document_category_sub_sub') && Input::get('document_category_sub_sub') > 0 ? Input::get('document_category_sub_sub') : 0;
        $document_content_type = Input::get('document_content_type') && Input::get('document_content_type') > 0 ? Input::get('document_content_type') : 0;
        $document_share_members_all = Input::get('document_share_members_all') && Input::get('document_share_members_all') == 1 ? 1 : 0;

        $document_created = Input::get('document_created') && Input::get('document_created') != '' ? Input::get('document_created') : date('Y-m-d');

        /*        $document_file = $_FILES['document_file'];*/
        $document_fields = array(
            'document_title' => $document_title,
            'document_notes' => $document_notes,
            'document_owner_user_id' => intval(auth()->user()->id),
            'document_category' => intval($document_category),
            'document_category_sub' => intval($document_category_sub),
            'document_category_sub_sub' => intval($document_category_sub_sub),
            'document_content_type' => $document_content_type,
            'document_created' => $document_created,
            'document_share_members_all' => $document_share_members_all
        );

        $document = Document::create($document_fields);

        $folder = '/' . Config::get('constants.DOCUMENT_FOLDER') . '/';
        $name = $document->document_id;
        $nameWithExtension = $name . '.' . $file_document->getClientOriginalExtension();
        // Upload file
        $this->uploadOne($file_document, $folder, 'public', $name);
        $document->document_file = $nameWithExtension;
        $document->save();

        $document_share_roles = Input::get('document_share_role');
        if ($document_share_roles) {
            DocumentShareRole::process_document_share_roles($document, $document_share_roles);
        }
        return Helper::success_message("File Uploaded !");
    }

    public function ajax_set_not_applicable()
    {
        $not_applicable = Input::get('not_applicable');
        $not_applicable_hash = Input::get('not_applicable_hash');
        $documents_not_applicable = array(
            'documents_not_applicable_hash' => $not_applicable_hash,
            'documents_not_applicable_user_id' => auth()->user()->id
        );
        if ($not_applicable == 1) {
            DB::table('documents_not_applicable')->insert($documents_not_applicable);
            return Helper::success_message("Document Marked Not Applicable");
        } else {
            DB::table('documents_not_applicable')->where($documents_not_applicable)->delete();
            return Helper::success_message("Document Marked Applicable");

        }
    }

    public function ajax_document_delete(){
        Document::find(Input::get('document_id'))->delete();
        return Helper::success_message("Document Deleted !");
    }

    public function ajax_search_document(){

        $search_title = Input::get('search_title');
        $select = 'DISTINCT document_id as document_id , document_title , document_file ,profile_first_name , profile_last_name , document_updated ';
        $document_search_result = Document::select(DB::raw($select))
        ->where('document_title','LIKE',"%{$search_title}%")
            ->where('document_owner_user_id',auth()->user()->id)
            ->orderBy('document_updated','desc')
            ->join('profiles','profiles.profile_user_id','=','documents.document_owner_user_id')
            ->take(5)
            ->get();
        return view('project.estates.forms.documentForms.document-new.document_search_result',
            compact('document_search_result'));
    }

}
