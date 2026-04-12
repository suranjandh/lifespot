@php
$member_is_type_of_member = true;
$member_has_account = $member->member_associated_user > 0;

$document_tabs_open_true = $member_type != 'current_member';
$document_tabs_open = $document_tabs_open_true ? 'document_tabs_open' : 'cancel_click_temp';
$data_document_category = 1;
$data_document_category_sub = 2;
$data_document_category_sub_sub = 0;
$data_document_category_sub_sub_sub = 0;
if ($member_type == 'current_spouse') {
    $data_document_category = 2;
    $data_document_category_sub = 4;
    $data_document_category_sub_sub = 0;
    $data_document_category_sub_sub_sub = 0;

} elseif ($member_type == 'current_dependent') {
    $data_document_category = 2;
    $data_document_category_sub = 5;
    $data_document_category_sub_sub = $member->member_id;
    $data_document_category_sub_sub_sub = 1;

} elseif ($member_type == 'current_beneficiary') {
    $data_document_category = 2;
    $data_document_category_sub = 6;
    $data_document_category_sub_sub = $member->member_id;
    $data_document_category_sub_sub_sub = 1;

} elseif ($member_type == 'current_emergency_contact') {
    $data_document_category = 1;
    $data_document_category_sub = 3;
    $data_document_category_sub_sub = $member->member_id;
    $data_document_category_sub_sub_sub = 1;

}

@endphp
<div class="icon_set icon1 cancel_click_temp" data-toggle="tooltip" data-placement="top" title="Gift">
    <i class="fas fa-gift"></i>
</div>
@php if ($document_tabs_open != 'cancel_click_temp') { @endphp
    <div class="icon_set icon2 {{ $document_tabs_open }}"
         data-document-category="{{ $data_document_category }}"
         data-document-category-sub="{{ $data_document_category_sub }}"
         data-document-category-sub-sub="{{ $data_document_category_sub_sub }}"
         data-document-category-sub-sub-sub="{{ $data_document_category_sub_sub_sub }}"
         data-toggle="tooltip" data-placement="top"
         title="Documents">

        <i class="far fa-file-alt xmr-2"></i>
    </div>
@php } @endphp
@php if ($member_is_type_of_member) {
    $invitation_status = $member_obj->get_member_invitation_status_text($member);
    $members_user_account = $member_obj->members_user_account($member);
    if ($members_user_account) { @endphp
        <div class="icon_set icon3 message_member_open"
             data-href="{{ $helper->get_tab_url(100) }}&message_user_id_trigger={{ $members_user_account }}"
             data-toggle="tooltip" title="Message">
            <i class="far fa-comment-dots"></i>
        </div>
    @php } else { @endphp
        <div class="icon_set icon3 invite_member_open"
             data-toggle="tooltip" data-placement="top" title="{{ $invitation_status }}">
            <i class="far fa-dot-circle"
               style="color: {{ isset($member_has_account) && $member_has_account && $member->member_invitation_status != 4 ? 'green' : 'red' }}"></i>
        </div>
    @php } @endphp
    <div class="icon_set icon4 member_share_modal_open" data-toggle="tooltip" data-placement="top" title="Shared Info">
        <i class="fas fa-share-alt"></i>
    </div>
@php } @endphp

@php if (isset($roles_set_other) && count($roles_set_other) > 0) { @endphp
    <div class="icon_set icon5" data-toggle="tooltip" data-placement="top"
         title="{{ implode(', ', $roles_set_other) }}">
        <!-- more roles -->
        <span style="color: rgb(58, 113, 183);">more&nbsp;roles&nbsp;&nbsp;</span>
        <!-- <span style= "color: rgb(57, 122, 242);">more&nbsp;roles</span> -->
    </div>
@php } else { @endphp
    <div class="icon_set icon5">
        <span style="visibility:hidden;">more&nbsp;roles&nbsp;&nbsp;</span>
    </div>
@php } @endphp
@php if ($member_type == 'current_beneficiary') { @endphp

    <!--<div class="xicon_set icon6 member_content_box_delete" data-member-member-id="<? /*= $member->member_id */ @endphp"
         data-toggle="tooltip" data-placement="top"    title="Delete Beneficiary">
        <i class="fas fa-trash-alt black-text mr-2" style="margin-top:0" ></i>

    </div>-->
    <div class="xicon_set icon6"></div>
@php } @endphp
<div></div>