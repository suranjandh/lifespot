@php
include '../../../../lib/includes/header_include.php';

$profile_obj = new ProfileModel();
$userId = $_SESSION->loggedInUser;
foreach ($_FILES as $file) {
    $path = $file->name;
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    /*$image_extensions = array("jpg","gif","png","jpeg");
    if(!in_array($ext,$image_extensions)){
        $helper->die_error_message_json("Image Upload Error. Unknown Extension !");
    }*/
    if(!getimagesize($file->tmp_name)) {
        $helper->die_error_message_json("Image Upload Error. Unknown Extension !");
    }
    $uploaded_file_name = $userId . '.' . $ext;
    $uploaded_file_full_path = SITE_BASE_PATH. '/'.PROFILE_IMG_FOLDER. '/'. $uploaded_file_name;
    $uploaded_file_url = SITE_BASE_URL .PROFILE_IMG_FOLDER. '/'.$uploaded_file_name.'?'.rand(1,1000);
    if (move_uploaded_file($file->tmp_name, $uploaded_file_full_path)) {
        if($ext == 'jpg'|| $ext =='jpeg') {
            $helper->change_orientation($uploaded_file_full_path);
        }
        $profile_found = $profile_obj->get_profile_by_profile_user_id($userId);
        if($profile_found) {
            $update_done = $profile_obj->update_profile_by_id(array('profile_image'=>$uploaded_file_name),$profile_found->profile_id);
            if($update_done){
                $helper->die_success_message_json("Image Uploaded Successfully", $uploaded_file_url);
            }
        }
        $helper->die_error_message_json("Image Upload Error !");
    } else {
        $helper->die_error_message_json("Image Upload Error !");
    }
}
$helper->die_error_message_json("Image Upload Error !");
