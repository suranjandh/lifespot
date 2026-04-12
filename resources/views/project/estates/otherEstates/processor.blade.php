@php
include '../../lib/includes/header_include.php';

$userId = $_SESSION->loggedInUser;

if ($_POST->action == 'get_other_estate_shares') {
    //$owners_members =  $member_obj->get_member_tree_counts($userId);
    $other_estate_id = isset($_POST->other_estate_id) ? $database->escape_string($_POST->other_estate_id) : 0;
    if($other_estate_id){
       $estate_obj = new EstateModel();
        $other_estate = $estate_obj->get_estate_by_id($other_estate_id);
       include 'other_estate_box_processor_sharing.php';
    }

    die();
}
elseif ($_POST->action == 'get_other_estate_document_shares') {
    $other_estate_member_id = isset($_POST->other_estate_member_id) ? $database->escape_string($_POST->other_estate_member_id) : 0;
    $document_share_obj = new DocumentShareModel();
    if( $other_estate_member_id) {
       $shared_documents =  $document_share_obj->get_other_estate_documents($other_estate_member_id);
        include 'other_estate_document_sharing.php';
    }
    die();
}




