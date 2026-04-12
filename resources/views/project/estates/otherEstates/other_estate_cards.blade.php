@php


$current_invitations = \App\Member::get_invited_estates_list_for_user();
$other_estate_card_data_array = array();

@endphp

@foreach ($current_invitations as $invitation)
    <a class="other-estate-cardLayout"
       id="other-estate-cardLayout{{ $invitation->estate_id }}"
       style="overflow: hidden"
       data-other-estate-id="{{ $invitation->estate_id }}"
       data-other-estate-name="{{ $invitation->estate_name }}"
       data-other-estate-member-id="{{ $invitation->member_id }}"
        >
        @php
        $other_estate_card_data_array[] = array(
            $invitation->estate_name,
            'other-estate-cardLayout' . $invitation->estate_id
        );
        @endphp
        @php
        $invitations_image = $invitation && trim($invitation->estate_image) != '' ? Config::get('constants.SITE_BASE_URL') . Config::get('constants.ESTATE_IMG_FOLDER') . '/' . $invitation->estate_image . '?rand=' . rand(1, 1000) : Config::get('constants.PROJECT_IMAGE_URL').'generic_Defaultfamily.png';
        @endphp
        <div class="row  estate_image">
            <img src="{{ $invitations_image }}" class="pic img-fluid img-thumbnail other-estate-img"
                 alt="">
        </div>

        <div class="row  estate_name">
            {{ $invitation->estate_name }}
        </div>
        @php
            $member = \App\Member::find($invitation->member_id);
            $roles_set_other = array();
            $member_roles = $member->roles ;
            $main_role =  $member->main_role($member_roles) ;
                $roles_set_first = $main_role != null  ?  $main_role->role_name : "";
            $roles_set_first = $roles_set_first ? $roles_set_first : 'No Role';
        @endphp
        @if(count($member_roles))
            @foreach ($member_roles as $role)
                @if($role->role_id != $main_role->role_id)
                    @php
                        $roles_set_other[] = $role->role_name ;
                    @endphp
                @endif
            @endforeach
        @endif
        {{--@php
        $roles_set_first = "";
        $roles_set_other = array();
        @endphp
        @if ($invitation->member_role_in_estate)
            @foreach (explode('|', $invitation->member_role_in_estate) as $k => $role_id)
                @if ($k == 0) @php $roles_set_first = $roles_obj->get_role_name_by_role_id($role_id); @endphp
                @else @php $roles_set_other[] = $roles_obj->get_role_name_by_role_id($role_id)
                @endphp
          @endforeach
        @endif--}}
        <div class="row estate_member_role">
            {{$roles_set_first}}
        </div>

        <div class="row icon_set_row">
            <div class="icon_set cancel_click_temp" title="Gift">
                <i class="fas fa-gift"></i>
            </div>

            <div class="icon_set" title="Documents">
                <i class="far fa-file-alt mr-2 other_estates_document_share_open"></i>
            </div>
            @php
            $more_roles_string = "";

            $more_roles_title_string = "";
            if (isset($roles_set_other) && count($roles_set_other) > 0) {
                $more_roles_title_string = implode(',', $roles_set_other);
                $more_roles_string = "More Roles";
            }@endphp
            <div class="icon_set" title="{{ $more_roles_title_string }}">
                {{ $more_roles_string }}
            </div>

            <div class="icon_set other_estates_share_open" title="Shared Info">
                <i class="fas fa-share-alt"></i>
            </div>
        </div>


    </a>
@endforeach
<script>
    var other_estate_card_data_array =    @php echo json_encode($other_estate_card_data_array) @endphp;
    $('.bind_other_estate_count').html(' @php echo count($other_estate_card_data_array) @endphp ');
</script>
