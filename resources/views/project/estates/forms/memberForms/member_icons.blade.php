<style>
    .cardIconSet {
        /* margin-left: 98px; */
        /* display: flex; */
    }

    .delIcon {
        /* justify-content: end; */
    }
</style>
<div class="icon_set icon1 cancel_click_temp"
     data-toggle="tooltip" title="Gift"
>
    <i class="fas fa-gift"></i>
</div>
<div class="icon_set icon2 document_share_modal_open"
     data-toggle="tooltip" title="Documents">

    <i class="far fa-file-alt xmr-2"></i>
</div>

@if ($member_is_type_of_member)
    @php  $invitation_status = $member->get_member_invitation_status_text($member);
    $members_user_account = $member->members_user_account;@endphp
    @if ($members_user_account)
        <div class="icon_set icon3 message_member_open"
             data-href="{{--{{ $session_class->is_kid()? $helper->get_tab_url_kid(100) : $helper->get_tab_url(100)--}} }}&message_user_id_trigger={{$members_user_account}}"
             data-toggle="tooltip" title="Message">
            <i class="far fa-comment-dots"></i>
        </div>
    @else
        <div data-toggle="tooltip" title="{{ $invitation_status }}" class="icon_set icon3 invite_member_open">
            <i class="far fa-dot-circle"
               style="color: {{ isset($member_has_account) && $member_has_account && $member->member_invitation_status != 4 ? 'green' : 'red' }}"></i>
        </div>
    @endif
    <div class="icon_set icon4 member_share_modal_open" data-toggle="tooltip" title="Shared Info">
        <i class="fas fa-share-alt"></i>
    </div>

@else
    <div class="icon_set icon3 invite_member_overview_modal_open" data-toggle="tooltip"
         title="Invitation Status">
        <i class="far fa-dot-circle"></i>
    </div>
    <div class="icon_set icon4 open_account_info_share_overview" data-toggle="tooltip"
         title="Shared Info">
        <i class="fas fa-share-alt"></i>
    </div>
@endif

@if (isset($roles_set_other) && count($roles_set_other) > 0)
    <div class="icon_set icon5" data-toggle="tooltip"
         title="{{ implode(', ', $roles_set_other) }}">
        <!-- more roles -->
        <span style="color: rgb(58, 113, 183);">more&nbsp;roles</span>
        <!-- <span style= "color: rgb(57, 122, 242);">more&nbsp;roles</span> -->
    </div>
@else
    <div class="icon_set icon5">
        <span style="visibility:hidden;">more&nbsp;roles</span>
    </div>
@endif
@if ($member_is_type_of_member)

    <div class="icon_set_trash icon6 member_content_box_delete" data-member-member-id="{{ $member->member_id }}"
         data-toggle="tooltip" title="Delete Member">
        <i class="fas fa-trash-alt xblack-text xblack-text mr-2" style="margin-top:0"></i>
    </div>
@else
    <div class="icon_set_trash icon6 lifespot_content_box_delete tooltips"
         data-member-member-id="{{ $profile_user->profile_id }}"
         data-toggle="tooltip" title="Delete LfeSpot Account">
        <i class="fas fa-trash-alt xblack-text mr-2" style="margin-top:0"></i>
    </div>
@endif
<div>
</div>



