@php
use Illuminate\Support\Facades\Config;
$current_users_message = $message->message_from_user == auth()->user()->id ? true : false ;
$start_end = $current_users_message ? 'justify-content-end' : 'justify-content-start';
$current_users_message_class = $current_users_message ? 'current_users_message':'other_users_message';

$message_content = $message->message_image ?
    str_replace('###attachment###','<img src="'.Config::get('constants.MESSAGE_IMG_URL') . '/' . $message->message_image . '?' . rand(1, 1000).'" class="message_image_img">',$message->message_content) : $message->message_content;

$message_content = !$message->message_image && $message->message_attachment ?
    str_replace('###attachment###','<a href="'.Config::get('constants.MESSAGE_ATTACHMENT_URL').$message->message_attachment.'" class="message_attachment_show"><button>Click to view / download attached file</button></a>',$message->message_content)  :  $message_content;



@endphp
<div class="row {{ $start_end }} {{$current_users_message_class}}">
    <div class="col-8 message_content">
        <div class="message_content_inner">
            {!!  $message_content !!}
        </div>
        <span>{{date('D d h:i a',strtotime($message->message_created_time ))}}</span>
    </div>
</div>