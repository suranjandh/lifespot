@php

//$custom_message = isset($mail_settings['custom_message']) && trim($mail_settings['custom_message']) != '' ? $mail_settings['custom_message'] : '';
//$user_main_role = isset($mail_settings['user_main_role']) ? "the ".$mail_settings['user_main_role'] : 'a member';
//$member_id = isset($mail_settings['member_id']) ? $mail_settings['member_id'] : 0;
//$accept_buttons = isset($mail_settings['accept_buttons']) ? $mail_settings['accept_buttons'] : false;
//$sender_name = isset($mail_settings['sender_name']) ? $mail_settings['sender_name'] : '';
$inviter_name =  trim($mail_settings['template_bindings']['sender_name']);
$inviter_name_array = explode(" ",$inviter_name);
$inviter_first_name = $inviter_name_array[0];
@endphp
<style>
    .table_main {
        width: 800px;
        line-height: 1.5em;
        padding: 5px;
        font-size: 1.2em;
        color: #6a7178;
    }

   

    .table_para {
        text-align: justify;
    }

    .button {
        background-color: #008CBA; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
</style>
<table class="table_main table_head">
    <tr>
        <td><img style="width:250px" src="{{ Config::get('constants.PROJECT_LOGO_IMAGE_URL') }}lifeSpot.png"></td>
    </tr>
</table>

<table class="table_main">
    <tr>
        <td>Hi {{ $mail_settings['template_bindings']['first_name'] }} ,</td>
    </tr>
</table>


<table class="table_main table_para">
    <tr>
        <td>
            I have requested you to be {{  $mail_settings['template_bindings']['user_main_role'] }}  for my estate. I have found this awesome program
            called LifeSpot (<a class="invite_process_buttons" href="{{ Config::get('constants.SITE_BASE_URL') }}">LifeSpot.com.</a>) to store my important documents that will
            pertain to you.
            LifeSpot is allowing me to safely store all my estate information including Will & Trust
            documents, assets, and wishes for my family. This is so important to me, I want to give
            you access, and the ability to share my most current documents that I have for my Estate.
        </td>
    </tr>
</table>

<table class="table_main table_para">
    <tr>
        <td>Please accept my invitation by becoming a member with <a class="invite_process_buttons" href="{{ Config::get('constants.SITE_BASE_URL') }}">LifeSpot.com.</a> and
            consider
            saving, sharing and growing your own estate. Please let me know if you have any
            questions.
        </td>
    </tr>
</table>


<table class="table_main table_foot">
    <tr>
        <td>
            Thank You<br>
            {{ $mail_settings['template_bindings']['sender_name'] }}<br><br>
            <a class="invite_process_buttons" href="{{ Config::get('constants.SITE_BASE_URL') }}project/estates/emails/processor.php?member_id={{ $mail_settings['template_bindings']['member_id'] }}&action=click_invitation_accept">
                <button class="button">Accept Invitation</button>
            </a>
        </td>
    </tr>
</table>
@if ($mail_settings['template_bindings']['custom_message'])
    <table class="table_main table_para">
        <tr>
            <td>
                PS:<br>
                {{ $mail_settings['template_bindings']['custom_message'] }}
            </td>
        </tr>
    </table>
@endif

<table class="table_main table_para">
    <tr>
        <td>
            If you have any questions please visit the LifeSpot Help Center at <a class="invite_process_buttons" href="http://LifeSpot.com/help">LifeSpot.com/help</a><br><br>
            Not Interested?<br>
            <a class="invite_process_buttons" href="{{ Config::get('constants.SITE_BASE_URL') }}project/estates/emails/processor.php?member_id={{ $mail_settings['template_bindings']['member_id'] }}&action=click_invitation_decline">Decline
                this invitation</a> if you don&#39;t want to be {{ $inviter_first_name }}&#39;s {{  $mail_settings['template_bindings']['user_main_role'] }}.<br>
            We will let {{ $inviter_first_name }} know and confirm with the account holder.
        </td>
    </tr>
</table>
@if ($mail_settings['template_bindings']['member_id'])
    <table class="table_main table_para">
        <tr>
            <td>
                <img style="width: 1px;height: 1px"
                     src="{{ Config::get('constants.SITE_BASE_URL')}}project/estates/emails/processor.php?member_id={{ $mail_settings['template_bindings']['member_id'] }}&action=invitation_email_opened"/>
            </td>
        </tr>
    </table>
@endif
