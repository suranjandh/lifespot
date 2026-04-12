@php

function compressImage($source, $destination, $quality) {
    $image = null ;
    $info = getimagesize($source);

    if ($info->mime == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($info->mime == 'image/gif')
        $image = imagecreatefromgif($source);

    elseif ($info->mime == 'image/png')
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

}

include '../../../../lib/includes/header_include.php';

$site_obj = new SiteModel();

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
    $uploaded_file_full_path = SITE_BASE_PATH. '/'.SITE_IMG_FOLDER. '/'. $uploaded_file_name;
    $uploaded_file_url = SITE_BASE_URL .SITE_IMG_FOLDER. '/'.$uploaded_file_name.'?'.rand(1,1000);

    if (move_uploaded_file($file->tmp_name, $uploaded_file_full_path)) {
       // compressImage($uploaded_file_full_path,$uploaded_file_full_path,60);
        if($ext == 'jpg'|| $ext =='jpeg') {
            $helper->change_orientation($uploaded_file_full_path);
        }
        $site_found = $site_obj->get_sites_by_owner_user_id($userId);
        if($site_found) {
            $update_done = $site_obj->update_site_by_id(array('site_image'=>$uploaded_file_name),$site_found->site_id);
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

