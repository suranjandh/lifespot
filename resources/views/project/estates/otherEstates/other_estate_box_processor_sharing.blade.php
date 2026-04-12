@php
    // include dirname(dirname(dirname(__FILE__))) . '/lib/includes/header_include.php';
     //$member_share_obj = new MemberShareModel();
     // $estate_obj = new EstateModel();
     // $profile_obj = new ProfileModel();
     // $member_obj = new MemberModel();
     $other_estate_user_id = $other_estate->estate_user_id;
     $other_estate_member_id = \Illuminate\Support\Facades\Input::get('other_estate_member_id');

     $share_count = 0;

@endphp
<style>
    .member-share-li-content {
        display: none;
    }
</style>
<ul class="list-group list-group-estate-share-box">
    @php
        $estate = \App\Estate::where('estate_user_id',$other_estate_user_id)->first();//$estate_obj->get_estate_by_estate_user_id($other_estate_user_id);
    @endphp  @if ($estate)
        @php    $member_type = 'estate';
        $is_shared = \App\MemberShare::is_shared($other_estate_member_id, $estate->estate_id, $member_type);
        @endphp        @if ($is_shared)
            @php $share_count++;
            @endphp
            <li class="list-group-item member-share-li"
                data-share-to-member-id="{{ $other_estate_member_id }}"
                data-member-type="{{ $member_type }}" style="overflow:hidden;cursor:pointer;"
                data-member-member-id="{{ $estate->estate_id }}">
                <span class="other_estate_arrows">
                    <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                    <i class="fa fa-angle-double-up" aria-hidden="true" style="display: none;color: blue"></i>
                </span>

                <span>Estate -</span>
                @php
                    $name = $estate->estate_name;
                @endphp
                <span>{{ $name }}</span>
            </li>
            <li class="member-share-li-content"
                id="member-share-li-content_{{ $member_type }}_{{ $estate->estate_id }}"></li>
        @endif
    @endif
    @php
        $profile_user = \App\Profile::where('profile_user_id',$other_estate_user_id)->first(); // $profile_obj->get_profile_by_profile_user_id($other_estate_user_id);
    @endphp
    @if ($profile_user)
        @php   $member_type = 'profile';
        $is_shared = \App\MemberShare::is_shared($other_estate_member_id, $profile_user->profile_id, $member_type);
        @endphp    @if ($is_shared)
            @php  $share_count++;
            @endphp
            <li class="list-group-item member-share-li"
                data-share-to-member-id="{{ $other_estate_member_id }}"
                data-member-type="{{ $member_type }}" style="overflow:hidden;cursor:pointer;"
                data-member-member-id="{{ $profile_user->profile_id }}">
                <span class="other_estate_arrows">
                    <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                    <i class="fa fa-angle-double-up" aria-hidden="true" style="display: none;color: blue"></i>
                </span>
                <span>LifeSpot Owner -</span>
                @php
                    $name = '';
                    $name .= $profile_user->profile_first_name ? $profile_user->profile_first_name : $profile_user->user_first_name;
                    $name .= ' ';
                    $name .= $profile_user->profile_last_name ? $profile_user->profile_last_name : $profile_user->user_last_name;
                @endphp
                <span>{{ $name }}</span>
            </li>
            <li class="member-share-li-content"
                id="member-share-li-content_{{ $member_type }}_{{ $profile_user->profile_id }}"></li>
        @endif
    @endif
    @php
        $members_set = \App\Member::where('member_owner_user_id',$other_estate_user_id)->get(); // $member_obj->get_members_by_owner_user_id($other_estate_user_id);
    @endphp
    @if ($members_set)
        @foreach ($members_set as $member)
            @php  $member_label = 'Member'; @endphp
            @if ($other_estate_member_id == $member->member_id) @php continue;   // no need of showing himself @endphp
            @endif   @php $member_type = 'member'; @endphp
            @if ($member->member_is_spouse($member))
                @php  $member_type = 'spouse';
                $member_label = 'Spouse'; @endphp
            @endif
            @if (trim($member->member_first_name) == '') @php  continue; @endphp
            @elseif ($member->member_is_dependent($member))
                @php  $member_type = 'dependent';
                $member_label = 'Dependent';
                @endphp
            @endif
            @php
                $is_shared = \App\MemberShare::is_shared($other_estate_member_id, $member->member_id, $member_type);
            @endphp
            @if (!$is_shared) @php continue; @endphp @endif
            @php $share_count++;
            @endphp
            <li class="list-group-item member-share-li"
                data-share-to-member-id="{{ $other_estate_member_id }}"
                data-member-type="{{ $member_type }}" data-member-member-id="{{ $member->member_id }}"
                style="overflow:hidden;cursor:pointer;">
               <span class="other_estate_arrows">
                    <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                    <i class="fa fa-angle-double-up" aria-hidden="true" style="display: none;color: blue"></i>
                </span>
                <span>{{ $member_label }} -</span>

                <span>{{ $member->member_first_name . ' ' . $member->member_last_name }}</span>
            </li>
            <li class="member-share-li-content"
                id="member-share-li-content_{{ $member_type }}_{{ $member->member_id }}"></li>
        @endforeach
    @endif
</ul>
@if($share_count == 0)
    <h5>Nothing Shared Yet</h5>
@endif
