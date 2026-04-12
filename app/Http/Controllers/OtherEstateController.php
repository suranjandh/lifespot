<?php

namespace App\Http\Controllers;

use App\DocumentShare;
use App\Estate;
use App\Spouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class OtherEstateController extends Controller
{
    public function index()
    {
        $estate_found = Estate::where('estate_user_id', auth()->user()->id)->first();
        $spouse_found = Spouse::all();
        $data = compact('estate_found', 'spouse_found');
        return view('project.estates.index', $data);
    }

    public function other_estate_shares(){
        $other_estate_id = Input::get('other_estate_id');//isset($_POST->other_estate_id) ? $database->escape_string($_POST->other_estate_id) : 0;
        if($other_estate_id){
            $other_estate = Estate::find($other_estate_id); //$estate_obj->get_estate_by_id($other_estate_id);
            //include 'other_estate_box_processor_sharing.php';
            return view('project.estates.otherEstates.other_estate_box_processor_sharing',compact('other_estate'));
        }
        return '';
    }

    public function other_estate_document_shares(){
        $other_estate_member_id = Input::get('other_estate_member_id');//isset($_POST['other_estate_member_id']) ? $database->escape_string($_POST['other_estate_member_id']) : 0;
        $document_share_obj = new DocumentShare();
        if( $other_estate_member_id) {
            $shared_documents =  $document_share_obj->get_other_estate_documents($other_estate_member_id);
            //include 'other_estate_document_sharing.php';
            return view('project.estates.otherEstates.other_estate_document_sharing',compact('shared_documents'));
        }
        return '';
    }
}
