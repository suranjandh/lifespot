<?php

namespace App\Http\Controllers;

use App\Estate;
use App\Helpers\Helper;
use App\Message;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class MessageController extends Controller
{
    use UploadTrait;

    public function index()
    {
        $estate_found = Estate::where('estate_user_id', auth()->user()->id)->first();
        $spouse_found = auth()->user()->spouse;
        $data = compact('estate_found', 'spouse_found');
        if(auth()->user()->user_access == 1){
            return view('project.kid.index', $data);
        }
        return view('project.estates.index', $data);
    }

    public function message_left_panel()
    {
        return view('project.estates.messageCenterA.cards.message_list_tab_left', Input::all());
    }

    public function message_box_display()
    {

        $message_obj = new Message();
        $member_user_id = Input::get('member_user_id');//isset($_POST['member_user_id']) ? $database->escape_string($_POST['member_user_id']) : '';
        $messages_with_member_user = $message_obj->get_messages_with_member_user($member_user_id);
        $message_channel_data = array(
            'message_channel_type' => 1,
            'message_channel_owner_user' => auth()->user()->id,
            'message_channel_sender' => $member_user_id
        );
        $message_obj->reset_message_channels($message_channel_data);
        $data = compact('member_user_id', 'messages_with_member_user', 'message_channel_data');
        return view('project.estates.messageCenterA.cards.message_box_display', $data)->with(Input::all());

    }

    public function message_group_box_display()
    {
        $message_obj = new Message();
        $message_group_id = Input::get('message_group_id');//isset($_POST['message_group_id']) ? $database->escape_string($_POST['message_group_id']) : '';
        $message_group = $message_obj->get_message_group_by_id($message_group_id);
        $message_group_members = $message_obj->get_message_group_members($message_group_id);
        if ($message_group && $message_group_members) {
            $messages_with_group = $message_obj->get_messages_with_message_group($message_group_id);

            $message_channel_data = array(
                'message_channel_type' => 2,
                'message_channel_owner_user' => auth()->user()->id,
                'message_channel_sender' => $message_group_id
            );
            $message_obj->reset_message_channels($message_channel_data);
            $data = compact('message_group_id', 'message_group', 'message_group_members', 'messages_with_group', 'message_channel_data');
            return view('project.estates.messageCenterA.cards.message_group_box_display', $data)->with(Input::all());
        }
        return '';
    }

    public function message_create_group_message()
    {
        $message_obj = new Message();
        $message_message_group_id = Input::get('message_message_group_id');// isset($_POST['']) ? $database->escape_string($_POST['message_message_group_id']) : 0;
        $message_content = Input::get('message_content');// //isset($_POST['message_content']) ? $database->escape_string(trim($_POST['message_content'])) : '';
        if ($message_message_group_id && $message_content) {
            $message = array(
                'message_content' => $message_content,
                'message_from_user' => auth()->user()->id,
                'message_message_group_id' => $message_message_group_id
            );

            $message_id = $message_obj->insert_message($message);
            if ($message_id) {
                $message = $message_obj->get_message_by_id_advanced($message_id);
                //ob_start();
                //include 'cards/group_message_single.php';
                //$out = ob_get_contents();
                //ob_end_clean();
                $data = compact('message');
                $out = view('project.estates.messageCenterA.cards.group_message_single', $data)->with(Input::all());
                return Helper::success_message("", $out);
            } else {
                return Helper::error_message("Error Occurred. Please Retry !");
            }
        }
    }

    public function message_create()
    {
        $message_obj = new Message();
        $message_to_user = Input::get('message_to_user');//isset($_POST['message_to_user']) ? $database->escape_string($_POST['message_to_user']) : 0;
        $message_content = Input::get('message_content');//isset($_POST['message_content']) ? $database->escape_string(trim($_POST['message_content'])) : '';
        if ($message_to_user && $message_content) {
            $message = array(
                'message_content' => $message_content,
                'message_from_user' => auth()->user()->id,
                'message_to_user' => $message_to_user
            );

            $message_id = $message_obj->insert_message($message);
            if ($message_id) {
                $message = $message_obj->get_message_by_id_advanced($message_id);
                /* ob_start();
                 include 'cards/message_single.php';
                 $out = ob_get_contents();
                 ob_end_clean();
                 $helper->die_success_message_json("", $out);
             } else {
                 $helper->die_error_message_json("Error Occurred. Please Retry !");
             }*/
                $data = compact('message');
                // $out = view('project.estates.messageCenterA.cards.group_message_single', $data)->with(Input::all());
                $out = (string)View::make('project.estates.messageCenterA.cards.group_message_single', $data)->with(Input::all());
                return Helper::success_message("", $out);
            } else {
                return Helper::error_message("Error Occurred. Please Retry !");
            }
        }
    }

    public function message_groups_select()
    {
        $message_obj = new Message();
        $message_groups = $message_obj->get_message_groups_by_user_id();
        $data = compact('message_groups');
        //include 'cards/message_groups_select.php';
        return view('project.estates.messageCenterA.cards.message_groups_select', $data)->with(Input::all());
    }

    public function message_group_create()
    {
        $message_obj = new Message();
        $message_group_name = Input::get('message_group_name');// isset($_POST['message_group_name'])
        // ? $database->escape_string($_POST['message_group_name']) : '';
        $message_group_members_user_ids = Input::get('message_group_members_user_ids'); // isset($_POST['message_group_members_user_ids'])
        // ? $database->escape_string(trim($_POST['message_group_members_user_ids'])) : '';
        $message_group_members_user_ids_array = $message_group_members_user_ids ? explode(',', $message_group_members_user_ids) : array();
        sort($message_group_members_user_ids_array);
        if ($message_group_name && $message_group_members_user_ids_array && count($message_group_members_user_ids_array) > 0) {
            $message_group_members_user_ids_array[] = auth()->user()->id;
            $message_group = array(
                'message_group_name' => $message_group_name,
                'message_group_members_user_ids' => implode('|', $message_group_members_user_ids_array),
                'message_group_owner_user_id' => auth()->user()->id
            );
            $message_group_exsists = $message_obj->message_group_exsists($message_group);
            if ($message_group_exsists) {
               return Helper::error_message("Message Group exists. Check Group : " . $message_group_exsists->message_group_name);
            } elseif ($message_group_exsists == 0) {
                $message_group_id = $message_obj->create_message_group($message_group);
                if ($message_group_id) {
                    $message_obj->update_message_group_members($message_group, $message_group_id);
                    return Helper::success_message("Message group created !");
                } else {
                    return Helper::error_message("Error Occurred. Please Retry !");
                }
            } else {
                return Helper::error_message("Error Occurred. Please Retry !");
            }
        } else {
            return Helper::error_message("Error Occurred. Please Retry !");
        }
    }

    public function delete_message_group()
    {
        $message_obj = new Message();
        $message_message_group_id = Input::get('message_message_group_id');//isset($_POST['message_message_group_id'])
        // ? $database->escape_string($_POST['message_message_group_id']) : 0;
        if ($message_message_group_id) {
            $deleted_group = $message_obj->delete_message_group($message_message_group_id);
            if ($deleted_group) {
                return Helper::success_message("Group Deleted !");
            } else {
                return Helper::error_message("Error occurred !");
            }
        } else {
            return Helper::error_message("Error occurred !");
        }
    }

    public function message_image(Request $request)
    {
        $message_obj = new Message();
        $message_message_group_id = Input::get('message_message_group_id'); // isset($_POST['message_message_group_id'])
        //? $database->escape_string($_POST['message_message_group_id']) : 0;
        $message_to_user = Input::get('message_to_user');//isset($_POST['message_to_user'])
        //? $database->escape_string(trim($_POST['message_to_user'])) : 0;
        $message_attachment_string = Input::get('message_attachment_string');
        $message_content = Input::get('message_content'); // isset($_POST['message_content']) ? trim($_POST['message_content']) : '';
        $message_content = str_replace($message_attachment_string, "###attachment###", $message_content);
        //$message_content = $database->escape_string($message_content);
        if ($message_message_group_id || $message_to_user) {
            $image = $request->file('message_attachment');
            if (!getimagesize($image)) {
                return Helper::error_message("Image Upload Error. Unknown Extension !");
            } else {
                $message = array(
                    'message_content' => $message_content,
                    'message_from_user' => auth()->user()->id,
                    'message_to_user' => $message_to_user,
                    'message_message_group_id' => $message_message_group_id
                );
                // $message_id = $message_obj->insert_message($message);
                $message_created = Message::create($message);
                if ($message_created) {
                    $message_id = $message_created->message_id;
                    $message_found = Message::find($message_id);
                    // $uploaded_file_full_path = SITE_BASE_PATH . '/' . MESSAGE_IMG_FOLDER . '/' . $uploaded_file_name;
                    // $uploaded_file_url = SITE_BASE_URL . MESSAGE_IMG_FOLDER . '/' . $uploaded_file_name . '?' . rand(1, 1000);
                    $folder = '/' . Config::get('constants.MESSAGE_IMG_FOLDER') . '/';
                    $name = $message_found->message_id;
                    $nameWithExtension = $name . '.' . $image->getClientOriginalExtension();
                    $filePathUrl = Config::get('constants.MESSAGE_IMG_URL') . $nameWithExtension;
                    // Upload image
                    $this->uploadOne($image, $folder, 'public', $name);
                    // Set user profile image path in database to filePath
                    $message_found->message_image = $nameWithExtension;
                    $message_found->save();

                    $message = $message_obj->get_message_by_id_advanced($message_id);

                    if ($message) {
                        $data = compact('message');
                        // $out = view('project.estates.messageCenterA.cards.group_message_single', $data)->with(Input::all());
                        $out = '';
                        if ($message_message_group_id > 0) {
                            //include 'cards/group_message_single.php';
                            $out = (string)View::make('project.estates.messageCenterA.cards.group_message_single', $data)->with(Input::all());
                        } else {
                            // include 'cards/message_single.php';
                            $out = (string)View::make('project.estates.messageCenterA.cards.message_single', $data)->with(Input::all());

                        }
                        return Helper::success_message("", $out);
                    }
                }

            }
        }
        return Helper::error_message("Message Error or Image Upload Error !");
    }


    public function message_attachment(Request $request)
    {
        $message_obj = new Message();

        $message_message_group_id = Input::get('message_message_group_id');//isset($_POST['message_message_group_id'])
            //? $database->escape_string($_POST['message_message_group_id']) : 0;
        $message_to_user = Input::get('message_to_user');//isset($_POST['message_to_user'])
           // ? $database->escape_string(trim($_POST['message_to_user'])) : 0;
        $message_content = Input::get('message_content');//isset($_POST['message_content']) ? trim($_POST['message_content']) : '';
        $message_attachment_string = Input::get('message_attachment_string');//
        $message_content = str_replace($message_attachment_string,"###attachment###",$message_content);
        // $message_content = $database->escape_string($message_content);

        if ($message_message_group_id || $message_to_user) {
            $message = array(
                'message_content' => $message_content,
                'message_from_user' => auth()->user()->id,
                'message_to_user' => $message_to_user,
                'message_message_group_id' => $message_message_group_id
            );
            //$document_file = $_FILES['message_attachment'];
            //$message_id = $message_obj->insert_document($message, $document_file);
            $message_created = Message::create($message);
            if ($message_created) {
                $file = $request->file('message_attachment');
                $message_id = $message_created->message_id;
                $message_found = Message::find($message_id);
                // $uploaded_file_full_path = SITE_BASE_PATH . '/' . MESSAGE_IMG_FOLDER . '/' . $uploaded_file_name;
                // $uploaded_file_url = SITE_BASE_URL . MESSAGE_IMG_FOLDER . '/' . $uploaded_file_name . '?' . rand(1, 1000);
                $folder = '/' . Config::get('constants.MESSAGE_ATTACHMENT_FOLDER') . '/';
                $name = $message_found->message_id;
                $nameWithExtension = $name . '.' . $file->getClientOriginalExtension();
                $filePathUrl = Config::get('constants.MESSAGE_ATTACHMENT_URL') . $nameWithExtension;
                // Upload image
                $this->uploadOne($file, $folder, 'public', $name);
                // Set user profile image path in database to filePath
                $message_found->message_attachment = $nameWithExtension;
                $message_found->save();

                $message = $message_obj->get_message_by_id_advanced($message_id);

                if ($message) {
                    $data = compact('message');
                    // $out = view('project.estates.messageCenterA.cards.group_message_single', $data)->with(Input::all());
                    $out = '';
                    if ($message_message_group_id > 0) {
                        //include 'cards/group_message_single.php';
                        $out = (string)View::make('project.estates.messageCenterA.cards.group_message_single', $data)->with(Input::all());
                    } else {
                        // include 'cards/message_single.php';
                        $out = (string)View::make('project.estates.messageCenterA.cards.message_single', $data)->with(Input::all());
                    }
                    return Helper::success_message("", $out);
                }
            }
        }
        return Helper::error_message("Message Error or Attachment Upload Error !");

    }

}
