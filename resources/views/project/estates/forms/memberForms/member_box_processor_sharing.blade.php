@php
    //include dirname(dirname(dirname(dirname(__FILE__)))) . '/lib/includes/header_include.php';
    //$member_share_obj = new MemberShareModel();
@endphp
<ul class="list-group">
    @php
        //  $estate_obj = new EstateModel();
          $estate = auth()->user()->estate; // $estate_obj->get_estate_by_estate_user_id($_SESSION->loggedInUser);
    @endphp
    @if ($estate)
        @php
            $member_type = 'estate';
        @endphp
        <li class="list-group-item member-share-li"
            data-share-to-member-id="{{\Illuminate\Support\Facades\Input::get('member_id') }}"
            data-member-type="{{ $member_type }}" style="overflow:hidden"
            data-member-member-id="{{ $estate->estate_id }}">
            <input type="checkbox" class="form-check-input share_member_details"
                   id="share_member_details_{{ $member_type }}_{{ $estate->estate_id }}"
                    {{ \App\MemberShare::is_shared(\Illuminate\Support\Facades\Input::get('member_id'), $estate->estate_id, $member_type) ? 'checked="checked"' : '' }}
            >
            <label class="form-check-label"
                   for="share_member_details_{{ $member_type }}_{{ $estate->estate_id }}">

                <span>Estate -</span>
                @php
                    $name = $estate->estate_name ;
                @endphp
                <span>{{ $name }}</span>
            </label>
        </li>
    @endif
    @php
        //  $profile_obj = new ProfileModel();
      $profile_user = auth()->user()->profile ; //$profile_obj->get_profile_by_profile_user_id($_SESSION->loggedInUser);
    @endphp
    @if ($profile_user)
        @php
            $member_type = 'profile';
        @endphp
        <li class="list-group-item member-share-li"
            data-share-to-member-id="{{ \Illuminate\Support\Facades\Input::get('member_id') }}"
            data-member-type="{{ $member_type }}" style="overflow:hidden"
            data-member-member-id="{{ $profile_user->profile_id }}">
            <input type="checkbox" class="form-check-input share_member_details"
                   id="share_member_details_{{ $member_type }}_{{ $profile_user->profile_id }}"
                    {{  \App\MemberShare::is_shared(\Illuminate\Support\Facades\Input::get('member_id'), $profile_user->profile_id, $member_type) ? 'checked="checked"' : '' }}            >
            <label class="form-check-label"
                   for="share_member_details_{{ $member_type }}_{{ $profile_user->profile_id }}">

                <span>LifeSpot Owner -</span>
                @php
                    $name = '';
                    $name .= $profile_user->profile_first_name ? $profile_user->profile_first_name : $profile_user->user_first_name;
                    $name .= ' ';
                    $name .= $profile_user->profile_last_name ? $profile_user->profile_last_name : $profile_user->user_last_name;
                @endphp
                <span>{{ $name }}</span>
            </label>
        </li>
    @endif
    @php

        //$member_obj = new MemberModel();
        $members_set = auth()->user()->members;//$member_obj->get_members_by_owner_user_id($_SESSION->loggedInUser);
    @endphp
    @if ($members_set)
        @foreach ($members_set as $member)
            @php
                $member_label = 'Member';
            $member_type = 'member';
            @endphp
            @if (\Illuminate\Support\Facades\Input::get('member_id') == $member->member_id) @php continue; @endphp         @endif
            @if ($member->member_is_spouse($member))
                @php $member_type = 'spouse';
                    $member_label = 'Spouse';
                @endphp
                @if (trim($member->member_first_name) == '')  @php continue; @endphp;
                @endif
            @elseif ($member->member_is_dependent($member))
                @php $member_type = 'dependent';
                    $member_label = 'Dependent';
                @endphp
            @endif
            <li class="list-group-item member-share-li"
                data-share-to-member-id="{{\Illuminate\Support\Facades\Input::get('member_id') }}"
                data-member-type="{{ $member_type }}" data-member-member-id="{{ $member->member_id }}"
                style="overflow:hidden">

                <input type="checkbox" class="form-check-input share_member_details"
                       id="share_member_details_{{ $member_type }}_{{ $member->member_id }}"
                         {{  \App\MemberShare::is_shared(\Illuminate\Support\Facades\Input::get('member_id'), $member->member_id, $member_type) ? 'checked="checked"' : '' }}
                >
                <label class="form-check-label"
                       for="share_member_details_{{ $member_type }}_{{ $member->member_id }}">
                    <span>{{$member_label}} -</span>

                    <span>{{ $member->member_first_name . ' ' . $member->member_last_name }}</span>
                </label>
            </li>
        @endforeach
    @endif
</ul>
