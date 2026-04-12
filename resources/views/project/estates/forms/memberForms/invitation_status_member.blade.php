@php
    $member_id = \Illuminate\Support\Facades\Input::get('member_id'); // isset($_POST['member_id']) ? $database->escape_string($_POST['member_id']) : 0;
@endphp
@if ($member_id)
    @php
        $member = \App\Member::find($member_id); // $member_obj->get_member_by_id($member_id);
    @endphp
    @if ($member)
        @php
            $member_has_account = $member->member_associated_user > 0;
            $invitation_status = $member->get_member_invitation_status_text($member);
        @endphp
        <span
                class="content_box"
                data-member-member-id="{{$member->member_id}}"

        ><span class="invite_member_open">
                    <i class="far fa-dot-circle"
                       style="color: <?= isset($member_has_account) && $member_has_account && $member['member_invitation_status'] != 4 ? 'green' : 'red' ?>"></i> <?= $invitation_status ?>
                </span></span>
    @endif
@endif
