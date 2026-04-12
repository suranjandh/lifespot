@php
    //include dirname(dirname(dirname(dirname(__FILE__)))) . '/lib/includes/header_include.php';

    $member_card_data_array = array();
    $member_parts = array();

    /*ob_start();
    include EMAIL_FOLDER_PATH . 'invitation_email.php';
    $out = ob_get_contents();
    ob_end_clean();
    return $out;*/
    ob_start();
@endphp
<a id="addNewMember" class="member_content_box" data-member-type="member" data-member-member-id="0">Add Member
    <br>
    <i class="fas fa-plus fa-4x"></i>
</a>
@php
    $member_parts[1000] = ob_get_contents();
    ob_end_clean();
@endphp
@php
    //$profile_obj = new ProfileModel();
    $roles_set_first = "";
    $roles_set_other = array();
    $profile_user = auth()->user()->profile ;//$profile_obj->get_profile_by_profile_user_id($_SESSION->loggedInUser);
    $member_is_type_of_member = false;
@endphp
@if ($profile_user)
    @php $member_is_type_of_member = false;
    $member_has_account = false;

    $member_type = 'profile';


    $name = '';
    $name .= $profile_user->profile_first_name ? $profile_user->profile_first_name : $profile_user->user_first_name;
    $name .= ' ';
    $name .= $profile_user->profile_last_name ? $profile_user->profile_last_name : $profile_user->user_last_name;
    ob_start();
    @endphp
    <a class="member-cardLayout member member_content_box"
       id="member-cardLayout{{ $member_type }}{{ $profile_user->profile_id }}" data-member-name="{{ $name }}"
       data-member-type="{{ $member_type }}" style="overflow:hidden;"
       data-member-member-id="{{ $profile_user->profile_id }}"
       data-member-email-validated="{{ \App\Helpers\Helper::email_address_validated($profile_user->profile_email) }}"
    >
        @php
            $priority_number = 2000;
            $member_card_data_array[] = array(
                $name,
                'member-cardLayout' . $member_type . $profile_user->profile_id
            );
        @endphp
        <div class="row">
            <div class="col-8 member_relationship">
                LifeSpot Owner
            </div>
            <div class="col-4 member_role open_account_overview">
                Overview
            </div>
        </div>
        <div class="row justify-content-start member_image">
            @php $profile_image = trim($profile_user->profile_image) != '' ? Config::get('constants.SITE_BASE_URL') . Config::get('constants.PROFILE_IMG_FOLDER') . '/' . $profile_user->profile_image . '?rand=' . rand(1, 1000) : Config::get('constants.DEFAULT_AVATAR_IMAGE_URL'); @endphp
            <img src="{{ $profile_image }}" class="pic rounded img-fluid img-thumbnail member-img"
                 alt="">
        </div>

        <div class="row justify-content-start member_name">
            {{ $name }}
        </div>


        @php
            $data_document_category = 1;
            $data_document_category_sub = 2;
            $data_document_category_sub_sub = 0;
            $data_document_category_sub_sub_sub = 0;

        @endphp
        <div class="d-flex justify-content-between xmt-4 row icon_set_row">

            {{-- @php include 'member_icons.php' @endphp--}}
            @include('project.estates.forms.memberForms.member_icons')
        </div>
    </a>
    @php
        $member_parts[$priority_number] = isset($member_parts[$priority_number]) ? $member_parts[$priority_number].ob_get_contents() : ob_get_contents();
        ob_end_clean();
    @endphp
@endif
@php
    $members_set = \Illuminate\Support\Facades\Input::get('members_set') ;
    $members_set = $members_set ? $members_set : false ;
@endphp
@if (!$members_set)
    @php   //$member_obj = new MemberModel();
    //$members_set = \App\Member::where('member_owner_user_id',auth()->user()->id)->get();//$member_obj->get_members_by_owner_user_id($_SESSION->loggedInUser);
    $members_set = auth()->user()->members;
    @endphp
@endif


@if ($members_set)
    @foreach ($members_set as $member)
        @php
            $member_is_type_of_member = true;
            $member_has_account = $member->member_associated_user > 0;

            $member_type = '' ;
            $member_type = $member->member_type($member); @endphp
        @if($member_type == 'beneficiary'|| $member_type == 'emergency_contact')@php $member_type = 'member'; @endphp
        @endif
        @php
            $priority_number = 4000; @endphp
        @if ($member->member_is_spouse($member))
            @php
                $priority_number = 3000; @endphp
        @endif
        @if (trim($member->member_first_name) == '') @php continue; @endphp
        @endif
        @php $name = $member->member_first_name . ' ' . $member->member_last_name;
        $name_alphabet_number = \App\Helpers\Helper::get_alphabet_number_of_first_char($name);
        $priority_number += $name_alphabet_number;
        ob_start();
        @endphp
        <a class="member-cardLayout member_content_box content_box sub_sub_category_key_member_{{ $member->member_id }}"
           id="member-cardLayout{{ $member_type }}{{ $member->member_id }}"
           data-member-name="{{ $name }}"
           data-member-type="{{ $member_type }}" data-member-member-id="{{ $member->member_id }}"
           data-member-email-validated="{{ \App\Helpers\Helper::email_address_validated($member->member_email) }}"
           style="overflow:hidden">
            @php
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
                @php $priority_number += $main_role->role_id; @endphp
            @else
                @php
                    $role_id = 900;
                    $priority_number += $role_id;
                @endphp
            @endif

            {{--  @php
      $roles_set_first = "";
      $roles_set_other = array();
      if ($member->member_role_in_estate) {
          $roles_set = explode('|', $member->member_role_in_estate);
          asort($roles_set);
          foreach ($roles_set as $k => $role_id) {
              if ($k == 0){
                  $roles_set_first = $roles_obj->get_role_name_by_role_id($role_id);
                  //$role_id = $role_id == 0 ? $role_id *10 :$role_id;
                  $priority_number += $role_id;//*100;
              }
              else{ $roles_set_other[] = $roles_obj->get_role_name_by_role_id($role_id);}
                      @endphp
                  @php
                  }
              }else{
                  $role_id = 900;
                  $priority_number += $role_id;//*100;
              }@endphp--}}

            @php

                $relation_ship_of_member =  $member->member_relationship_to_owner ? \App\Relationship::get_relationship_name_by_relationship_id($member->member_relationship_to_owner) : '';
                $member_card_data_array[] = array(
                    $name.'|'.$relation_ship_of_member.'|'.$roles_set_first.'|'.implode('|',$roles_set_other),
                    'member-cardLayout' . $member_type . $member->member_id
                );
            @endphp
            <div class="row">
                <div
                        class="col-5 member_relationship">{{ $relation_ship_of_member }}
                </div>
                <div class="col-7 member_role">

                    {{--@php if ($roles_set_first) echo $roles_set_first;
                    else     echo 'No Role';     @endphp--}}
                    {{$roles_set_first}}
                </div>
            </div>

            <div class="row justify-content-start member_image">
                @php
                    $image_folder_url =  Config::get('constants.MEMBER_IMG_URL');
                    $member_image = trim($member->member_image) != '' ? $image_folder_url . $member->member_image . '?rand=' . rand(1, 1000) : Config::get('constants.DEFAULT_AVATAR_IMAGE_URL'); @endphp

                <img src="{{ $member_image }}" class="pic  rounded img-fluid img-thumbnail member-img"
                     alt="">
            </div>

            <div class="row justify-content-start member_name">{{ $name }}</div>
            <div class="row justify-content-start member_name"
                 style="color: rgb(57, 122, 242); font-size: .9rem; line-height:5px; margin-top:5px;">
                {{$member->member_is_dependent($member) ? 'Dependent' : ''}}
            </div>
            <div class="row justify-content-start member_name"
                 style="color: rgb(57, 122, 242); font-size: .9rem; line-height:5px; margin-top:5px;">{{$member->member_join_account_access == 1 ? 'Jointly Shared Account' : ''}}</div>
            @php
                $data_document_category = 1;
                $data_document_category_sub = 2;
                $data_document_category_sub_sub = 0;
                $data_document_category_sub_sub_sub = 0;
            @endphp
            @if($member_type == 'spouse')
                @php    $data_document_category = 2;
                $data_document_category_sub = 4;
                $data_document_category_sub_sub = 0;
                $data_document_category_sub_sub_sub = 0;
                @endphp
            @elseif ($member_type == 'dependent')
                @php   $data_document_category = 2;
                $data_document_category_sub = 5;
                $data_document_category_sub_sub = $member->member_id;
                $data_document_category_sub_sub_sub = 1;
                @endphp

            @elseif ($member_type == 'member')
                @php    $data_document_category = 7;
                $data_document_category_sub = 25;
                $data_document_category_sub_sub = $member->member_id;
                $data_document_category_sub_sub_sub = 0;

                @endphp

            @elseif ($member_type == 'beneficiary')
                @php   $data_document_category = 2;
                $data_document_category_sub = 6;
                $data_document_category_sub_sub = $member->member_id;
                $data_document_category_sub_sub_sub = 0;
                @endphp


            @elseif ($member_type == 'emergency_contact')
                @php    $data_document_category = 1;
                $data_document_category_sub = 3;
                $data_document_category_sub_sub = $member->member_id;
                $data_document_category_sub_sub_sub = 0;
                @endphp

            @endif


            <div class="d-flex justify-content-between xmt-4 row icon_set_row">
                {{-- @php include 'member_icons.php' @endphp--}}
                @include('project.estates.forms.memberForms.member_icons')
            </div>
        </a>
        @php
            $member_parts[$priority_number] = isset($member_parts[$priority_number]) ? $member_parts[$priority_number].ob_get_contents():ob_get_contents();
            ob_end_clean();
        @endphp
    @endforeach
@endif



@php
    ob_start();
@endphp
<script>
    var member_card_data_array = @php echo json_encode($member_card_data_array)@endphp;
</script>
@php
    $member_parts[6000] = ob_get_contents();
    ob_end_clean();

    ksort($member_parts);
    //var_dump(array_keys($member_parts));
    echo implode('',$member_parts);
@endphp

