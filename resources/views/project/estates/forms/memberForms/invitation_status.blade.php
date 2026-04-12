<ul style="list-style-type: none;">
    @php

        $members_set = \Illuminate\Support\Facades\Input::get('members_set'); // isset($_POST->members_set) ? $_POST->members_set : false;
    @endphp
    @if (!$members_set)
        @php $members_set =  auth()->user()->members ; // $member_obj->get_members_by_owner_user_id($_SESSION->loggedInUser);  @endphp
    @endif

    @if ($members_set)
        @foreach ($members_set as $member)
            @php            $member_is_type_of_member = true;
            $member_has_account = $member->member_associated_user > 0;
            $member_type = 'member';
            @endphp
            @if ($member->member_is_spouse($member))
                @php  $member_type = 'spouse'; @endphp
            @elseif ($member->member_is_dependent($member))
                @php   $member_type = 'dependent'; @endphp
            @endif
            @php $name = $member->member_first_name . ' ' . $member->member_last_name;
            @endphp

            @if ($member_is_type_of_member)
                @php
                    $invitation_status = $member->get_member_invitation_status_text($member);
                    $member_roles = $member->roles ;
                    $main_role =  $member->main_role($member_roles) ;
                        $roles_set_first = $main_role != null  ?  $main_role->role_name : "";
                    $roles_set_first = $roles_set_first ? $roles_set_first : 'No Role';
                @endphp
                <li
                        class="content_box"
                        data-member-name="{{ $name }}{{ $member->member_id }}"
                        data-member-type="{{ $member_type }}" data-member-member-id="{{ $member->member_id }}"

                ><span class="invite_member_open"
                       title="{{ $invitation_status }}">
                    <i class="far fa-dot-circle"
                       style="color: {{ isset($member_has_account) && $member_has_account && $member->member_invitation_status != 4 ? 'green' : 'red' }}"></i>
                </span><span> {{ $name }} </span><span> - {{ $roles_set_first }}</span></li>


            @endif
        @endforeach
    @else
        <li>No Members</li>
    @endif
</ul>


