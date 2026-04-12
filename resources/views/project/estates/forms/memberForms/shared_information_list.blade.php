@php
    $member_share_obj = new \App\MemberShare();

    $this_estate_member_id = \Illuminate\Support\Facades\Input::get('member_id');

    $share_count = 0;

@endphp
<ul style="list-style: disc">
    @php
        $estate = auth()->user()->estate ; ; // $estate_obj->get_estate_by_estate_user_id($this_estate_user_id);
    @endphp
    @if ($estate)
        @php    $member_type = 'estate';
        $is_shared = $member_share_obj->is_shared($this_estate_member_id, $estate->estate_id, $member_type);
        @endphp
        @if ($is_shared)
            @php  $share_count++;
            $name = $estate->estate_name
            @endphp
            <li>

                <span>Estate - </span>
                <span>{{ $name }}</span>
            </li>
        @endif
    @endif
    @php $profile_user = auth()->user()->profile ; // $profile_obj->get_profile_by_profile_user_id($this_estate_user_id);
    @endphp
    @if ($profile_user)
        @php $member_type = 'profile';
        $is_shared = $member_share_obj->is_shared($this_estate_member_id, $profile_user->profile_id, $member_type);
        @endphp
        @if ($is_shared)
            @php
                $share_count++;
            @endphp
            <li>

                <span>LifeSpot Owner -</span>
                @php
                    $name = '';
                    $name .= $profile_user->profile_first_name ? $profile_user->profile_first_name : $profile_user->user_first_name;
                    $name .= ' ';
                    $name .= $profile_user->profile_last_name ? $profile_user->profile_last_name : $profile_user->user_last_name;
                @endphp
                <span>{{ $name }}</span>
            </li>

        @endif
    @endif
    @php
        $members_set = auth()->user()->members ;// $member_obj->get_members_by_owner_user_id($this_estate_user_id);
    @endphp
    @if ($members_set)
        @foreach ($members_set as $member)
            @php $member_label = 'Member'; @endphp
            @if ($this_estate_member_id == $member->member_id) @php continue;  // no need of showing himself @endphp @endif
            @php $member_type = 'member';
            @endphp
            @if ($member->member_is_spouse($member))
                @php   $member_type = 'spouse';
                $member_label = 'Spouse';
                @endphp
            @elseif ($member->member_is_dependent($member))
                @php   $member_type = 'dependent';
                $member_label = 'Dependent';
                @endphp
            @endif
            @php $is_shared = $member_share_obj->is_shared($this_estate_member_id, $member->member_id, $member_type); @endphp
            @if (!$is_shared) @php continue; @endphp @endif
            @php  $share_count++;
            @endphp
            <li>

                <span>{{ $member_label }} -</span>

                <span>{{ $member->member_first_name . ' ' . $member->member_last_name }}</span>
            </li>
        @endforeach
    @endif
    @if($share_count == 0)
        <li>Nothing Shared With Member</li>
    @endif
</ul>
