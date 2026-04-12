@php
include '../../lib/includes/header_include.php';

$userId = isset($_SESSION->loggedInUser) ?$_SESSION->loggedInUser: 0;
$print_content = false ;
if(!$userId){
    die('error');
}
if (isset($_POST->action) && $_POST->action == 'read_estate') {
    $estate = new EstateModel();
    $estate = $estate->get_estate_by_estate_user_id($userId);
    if ($estate) {
        Helper::die_success_message_json("", $estate);
    }
    Helper::die_error_message_json("");
}
if (isset($_POST->action) && $_POST->action == 'read_estate_card') {
    include 'cards/estate.php';
    die();
}
if (isset($_POST->action) && $_POST->action == 'read_profile_card') {
    include 'cards/profile.php';
    die();
}
if (isset($_POST->action) && $_POST->action == 'read_spouse_card') {
    include 'cards/spouse.php';
    die();
}
if (isset($_POST->action) && $_POST->action == 'read_dependents_card') {
    include 'cards/dependents.php';
    die();
}
if (isset($_POST->action) && $_POST->action == 'read_emergency_contact_card') {
    include 'cards/emergency_contact.php';
    die();
}
if (isset($_POST->action) && $_POST->action == 'read_beneficiary_card') {
    include 'cards/beneficiary.php';
    die();
}
if (isset($_POST->action) && $_POST->action == 'read_pet_card') {
    include 'cards/pet.php';
    die();
}
if (isset($_GET->action) && $_GET->action == 'print_content') {
    // http://localhost/tnnskid/lifespot_bitbucket/project/estates/Snapshots/processor.php?action=print_content&print=estate
    $print_content = true ;
    $print_content_file = $_GET->print;
    ob_start();
    include"cards/print/styles_set.php";
    include "cards/print/{$print_content_file}.php";
    $out = ob_get_contents();
    ob_end_clean();
    @include SITE_BASE_PATH.'/project/lib/includes/MPDF_6_0/mpdf60/mpdf.php';
    @$mpdf = new mPDF();
    @$mpdf->WriteHTML($out);
    @$mpdf->Output();

}