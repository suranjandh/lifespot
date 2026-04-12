<?php
include '../../lib/includes/header_include.php';

$message_obj = new MessageModel();
$userId = $_SESSION['loggedInUser'];
if (!$userId) die();

if ($_POST['action'] == 'message_left_panel') {
    include 'cards/message_list_tab_left.php';
} elseif ($_POST['action'] == 'message_box_display') {
    $member_user_id = isset($_POST['member_user_id']) ? $database->escape_string($_POST['member_user_id']) : '';
    $messages_with_member_user = $message_obj->get_messages_with_member_user($member_user_id);
    $message_channel_data = array(
        'message_channel_type' => 1,
        'message_channel_owner_user' => $userId,
        'message_channel_sender' => $member_user_id
    );
    $message_obj->reset_message_channels($message_channel_data);
    include 'cards/message_box_display.php';
} elseif ($_POST['action'] == 'message_group_box_display') {
    $message_group_id = isset($_POST['message_group_id']) ? $database->escape_string($_POST['message_group_id']) : '';
    $message_group = $message_obj->get_message_group_by_id($message_group_id);
    $message_group_members = $message_obj->get_message_group_members($message_group_id);
    if ($message_group && $message_group_members) {
        $messages_with_group = $message_obj->get_messages_with_message_group($message_group_id);

        $message_channel_data = array(
            'message_channel_type' => 2 ,
            'message_channel_owner_user' => $userId,
            'message_channel_sender' => $message_group_id
        );
        $message_obj->reset_message_channels($message_channel_data);

        include 'cards/message_group_box_display.php';
    }
    echo '';
}
elseif ($_POST['action'] == 'message_enabled_users') {
    $message_enabled_users = $message_obj->get_message_enable_users_data();
    include 'cards/group_member_select.php';
} elseif ($_POST['action'] == 'message_group_create') {
    $message_group_name = isset($_POST['message_group_name'])
        ? $database->escape_string($_POST['message_group_name']) : '';
    $message_group_members_user_ids = isset($_POST['message_group_members_user_ids'])
        ? $database->escape_string(trim($_POST['message_group_members_user_ids'])) : '';
    $message_group_members_user_ids_array = $message_group_members_user_ids ? explode(',', $message_group_members_user_ids) : array();
    sort($message_group_members_user_ids_array);
    if ($message_group_name && $message_group_members_user_ids_array && count($message_group_members_user_ids_array) > 0) {
        $message_group_members_user_ids_array[] = $userId;
        $message_group = array(
            'message_group_name' => $message_group_name,
            'message_group_members_user_ids' => implode('|', $message_group_members_user_ids_array),
            'message_group_owner_user_id' => $userId
        );
        $message_group_exsists = $message_obj->message_group_exsists($message_group);
        if (is_array($message_group_exsists)) {
            $helper->die_error_message_json("Message Group exists. Check Group : " . $message_group_exsists['message_group_name']);
        } elseif ($message_group_exsists == 0) {
            $message_group_id = $message_obj->create_message_group($message_group);
            if ($message_group_id) {
                $message_obj->update_message_group_members($message_group, $message_group_id);
                $helper->die_success_message_json("Message group created !");
            } else {
                $helper->die_error_message_json("Error Occurred. Please Retry !");
            }
        } else {
            $helper->die_error_message_json("Error Occurred. Please Retry !");
        }
    } else {
        $helper->die_error_message_json("Error Occurred. Please Retry !");
    }

} elseif ($_POST['action'] == 'message_groups_select') {
    $message_grous = $message_obj->get_message_groups_by_user_id($userId);
    include 'cards/message_groups_select.php';
}

elseif ($_POST['action'] == 'unread_messages_counts') {
    $unread_messages_counts = $message_obj->get_unread_messages_counts();
    $helper->die_success_message_json("", $unread_messages_counts);
}
elseif ($_POST['action'] == 'message_create') {
    $message_to_user = isset($_POST['message_to_user']) ? $database->escape_string($_POST['message_to_user']) : 0;
    $message_content = isset($_POST['message_content']) ? $database->escape_string(trim($_POST['message_content'])) : '';
    if ($message_to_user && $message_content) {
        $message = array(
            'message_content' => $message_content,
            'message_from_user' => $userId,
            'message_to_user' => $message_to_user
        );

        $message_id = $message_obj->insert_message($message);
        if ($message_id) {
            $message = $message_obj->get_message_by_id_advanced($message_id);
            ob_start();
            include 'cards/message_single.php';
            $out = ob_get_contents();
            ob_end_clean();
            $helper->die_success_message_json("", $out);
        } else {
            $helper->die_error_message_json("Error Occurred. Please Retry !");
        }
    }
}
elseif ($_POST['action'] == 'message_create_group_message') {
    $message_message_group_id = isset($_POST['message_message_group_id']) ? $database->escape_string($_POST['message_message_group_id']) : 0;
    $message_content = isset($_POST['message_content']) ? $database->escape_string(trim($_POST['message_content'])) : '';
    if ($message_message_group_id && $message_content) {
        $message = array(
            'message_content' => $message_content,
            'message_from_user' => $userId,
            'message_message_group_id' => $message_message_group_id
        );

        $message_id = $message_obj->insert_message($message);
        if ($message_id) {
            $message = $message_obj->get_message_by_id_advanced($message_id);
            ob_start();
            include 'cards/group_message_single.php';
            $out = ob_get_contents();
            ob_end_clean();
            $helper->die_success_message_json("", $out);
        } else {
            $helper->die_error_message_json("Error Occurred. Please Retry !");
        }
    }
}
elseif ($_POST['action'] == 'message_image') {
    $message_message_group_id = isset($_POST['message_message_group_id'])
        ? $database->escape_string($_POST['message_message_group_id']) : 0;
    $message_to_user = isset($_POST['message_to_user'])
        ? $database->escape_string(trim($_POST['message_to_user'])) : 0;

    $message_content = isset($_POST['message_content']) ? trim($_POST['message_content']) : '';
    $message_content = str_replace($_POST['message_attachment_string'],"###attachment###",$message_content);
    $message_content = $database->escape_string($message_content);
    if ($message_message_group_id || $message_to_user) {
        foreach ($_FILES as $file) {
            $path = $file['name'];
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $image_extensions = array("jpg", "gif", "png", "jpeg");
            if (!in_array($ext, $image_extensions)) {
                $helper->die_error_message_json("Image Upload Error. Unknown Extension !");
            }
            $message = array(
                'message_content' => $message_content,
                'message_from_user' => $userId,
                'message_to_user' => $message_to_user,
                'message_message_group_id' => $message_message_group_id
            );
            $message_id = $message_obj->insert_message($message);
            if ($message_id) {
                $uploaded_file_name = $message_id . '.' . $ext;
                $uploaded_file_full_path = SITE_BASE_PATH . '/' . MESSAGE_IMG_FOLDER . '/' . $uploaded_file_name;
                $uploaded_file_url = SITE_BASE_URL . MESSAGE_IMG_FOLDER . '/' . $uploaded_file_name . '?' . rand(1, 1000);
                if (move_uploaded_file($file['tmp_name'], $uploaded_file_full_path)) {

                    //$message_found = $message_obj->get_message_by_id_advanced($message_id);
                    //if ($message_found) {
                    $update_done = $message_obj->update_message_by_id(array('message_image' => $uploaded_file_name), $message_id);
                    $message = $message_obj->get_message_by_id_advanced($message_id);
                    if ($update_done && $message_id && $message) {
                        ob_start();
                        if($message_message_group_id > 0 ) {
                            include 'cards/group_message_single.php';
                        }else{
                            include 'cards/message_single.php';
                        }
                        $out = ob_get_contents();
                        ob_end_clean();
                        $helper->die_success_message_json("", $out);
                    } else {
                        $helper->die_error_message_json("Error Occurred. Please Retry !");
                        // }
                        // }
                    }
                    $helper->die_error_message_json("Image Upload Error !");

                }
                $helper->die_error_message_json("Image Upload Error !");
            } else {
                $helper->die_error_message_json("Image Upload Error !");
            }
        }
        $helper->die_error_message_json("Image Upload Error !");
    }
    $helper->die_error_message_json("Image Upload Error !");
}
elseif ($_POST['action'] == 'message_attachment') {
    $message_message_group_id = isset($_POST['message_message_group_id'])
        ? $database->escape_string($_POST['message_message_group_id']) : 0;
    $message_to_user = isset($_POST['message_to_user'])
        ? $database->escape_string(trim($_POST['message_to_user'])) : 0;
    $message_content = isset($_POST['message_content']) ? trim($_POST['message_content']) : '';
    $message_content = str_replace($_POST['message_attachment_string'],"###attachment###",$message_content);
    $message_content = $database->escape_string($message_content);

    if ($message_message_group_id || $message_to_user) {

        $message = array(
            'message_content' => $message_content,
            'message_from_user' => $userId,
            'message_to_user' => $message_to_user,
            'message_message_group_id' => $message_message_group_id
        );

        $document_file = $_FILES['message_attachment'];

        $message_id = $message_obj->insert_document($message, $document_file);
        if($message_id){
            $message = $message_obj->get_message_by_id_advanced($message_id);
            if ($message) {
                ob_start();
                if($message_message_group_id > 0 ) {
                    include 'cards/group_message_single.php';
                }else{
                    include 'cards/message_single.php';
                }                $out = ob_get_contents();
                ob_end_clean();
                $helper->die_success_message_json("", $out);
            } else {
                $helper->die_error_message_json($message_obj->attachment_error);
            }
        } else {
            $helper->die_error_message_json($message_obj->attachment_error);
        }
    }else {
        $helper->die_error_message_json("Error occurred !");
    }

}
elseif ($_POST['action'] == 'delete_message_group') {
        $message_message_group_id = isset($_POST['message_message_group_id'])
        ? $database->escape_string($_POST['message_message_group_id']) : 0;
        if($message_message_group_id) {
            $deleted_group = $message_obj->delete_message_group($message_message_group_id);
            if ($deleted_group) {
                $helper->die_success_message_json("Group Deleted !");
            } else {
                $helper->die_error_message_json("Error occurred !");
            }
        }else {
            $helper->die_error_message_json("Error occurred !");
        }
}

