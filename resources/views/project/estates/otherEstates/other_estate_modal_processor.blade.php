@php
include dirname(dirname(dirname(__FILE__))) . '/lib/includes/header_include.php';

$member_invitation_obj = new MemberInvitationModel();
$userId = $_SESSION->loggedInUser;
$other_estate_id = $_POST->other_estate_id;
$invitation = $member_invitation_obj->getCurrentInvitationFromEstate($userId,$other_estate_id);

@endphp
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Welcome {{$_SESSION->first_name}} to: <br> {{$invitation->estate_name}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @php
    $roles_set_card_temp = array();

    if($invitation->member_role_in_estate){
        foreach (explode('|', $invitation->member_role_in_estate) as $role_id) { @endphp
            @php $roles_set_card_temp[] = $roles_obj->get_role_name_by_role_id($role_id) @endphp
        @php }

    } @endphp
    <p>{{$invitation->invitation_sender_user_first_name.' '. $invitation->invitation_sender_user_last_name}} has invited you to be the {{implode(' , ',$roles_set_card_temp);}} in his/her estate.</p>
    <p>Here is a list of any documents {{$invitation->invitation_sender_user_first_name}} has made available to you.</p>
    <ul>
        <li><a href="#">"My Will"</a></li>
    </ul>

    <br>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>