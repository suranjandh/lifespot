@php
    // include dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/project/lib/includes/header_include.php';
    //$profile_obj = new ProfileModel();
    //$estate_obj = new EstateModel();
    //$userId = $_SESSION->loggedInUser;
    $profile_found = auth()->user()->profile ;//$profile_obj->get_profile_by_profile_user_id($userId);
    $estate_exists = auth()->user()->estate ;//$estate_obj->get_estate_by_estate_user_id($userId);


@endphp
<style>
    .profileNotes {
        resize: none;
    }

    #form_profile_dependent {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 2fr;
        grid-gap: 5px;
        grid-template-areas: "pic gender fName fName fName lName lName" "role role role role relationship relationship bday" "email email email email phone phone phone" "address address address address address address address2" "city city city city state state zip" "notes notes notes notes notes notes docs" "assignedprofile assignedprofile assignedprofile assignedprofile assignedprofile assignedprofile assignedprofile" "btnChangedependents btnChangedependents dependentinviteBtn dependentinviteStatus dependentinviteStatus dependentnextBtn btnClosedependents";

    }

    #profile_close {
        grid-area: btnClosedependents;
    }

    #profile_close a {
        padding-top: 10px;
        float: right;
    }

    #profile_save {
        grid-area: btnChangedependents;
    }

    #profile_invite {
        grid-area: dependentinviteBtn;
    }

    #profile_inviteStatus {
        grid-area: dependentinviteStatus;
    }

    #profile_next {
        grid-area: dependentnextBtn;
    }

    #profileImg {
        grid-area: pic;
    }

    #profileNew-gender {
        grid-area: gender;
    }

    #profileFName {
        grid-area: fName;
    }

    #profileLName {
        grid-area: lName;
    }

    #profileDependent-role {
        grid-area: role;
    }

    #profileEmail {
        grid-area: email;
    }

    #profilePhone {
        grid-area: phone;
    }

    #profileDependent-bday {
        grid-area: bday;
    }


    #profileDependent-relationship {
        grid-area: relationship;
    }

    #profileAddress {
        grid-area: address;
    }

    }
    #profileAddress2 {
        grid-area: address2;
    }

    #profileCity {
        grid-area: city;
    }

    #profileState {
        grid-area: state;
    }

    #profileZip {
        grid-area: zip;
    }

    #profile_docs {
        grid-area: docs;
    }

    #profile_notes {
        grid-area: notes;
        height: 140px;
    }

    #profile_assigned {
        grid-area: assignedprofile;
        margin-left: -20px;
    }

    .special_notes_dependent {
        resize: none;
    }


</style>

<h3>Dependent Information</h3>
<form id="form_profile_dependent">

    <div id="profileImg" class="image-upload">
        <input type="file" id="dependent_picture" name="dependent_picture" class="change_trigger_disabled"/>
        <label for="dependent_picture">
            <div class="img__wrap">
                @php
                    $dependent_image = $dependent && trim($dependent->member_image) != '' ? Config::get('constants.MEMBER_IMG_URL') . $dependent->member_image . '?rand=' . rand(1, 1000) : Config::get('constants.DEFAULT_AVATAR_IMAGE_URL');
                @endphp
                <img class="dependent_img__img img-thumbnail" id="dependent_img__img" src="{{ $dependent_image }}"
                     style="height:75px;width:auto;"
                     alt="">
                <i id="loading" style="display:none" class="ace-icon fa fa-spinner"></i>

                <div class="img__description_layer">
                    <p class="img__description"><i
                                class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br> Click to change
                        photo</p>
                </div>
            </div>
        </label>
    </div>
    <div id="profileNew-gender">
        <input type="hidden" name="dependent_member_id" id="dependent_member_id"
               value="{{ $dependent && $dependent->member_id ? $dependent->member_id : '' }}">
        @php $rand = rand(1, 50000) @endphp
        <div class="custom-control custom-radio custom-control-inline xmt-3 pl-0">
            <input type="radio" id="dependent_genderMale{{ $rand }}" name="dependent_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0"
                   value="Male" {{ $dependent && $dependent->member_gender == 'Male' ? 'checked="checked"' : '' }}>
            <label class="xcustom-control-label form-check-label pl-4"
                   for="dependent_genderMale{{ $rand }}">Male</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline pl-0">
            <input type="radio" id="dependent_genderFemale{{ $rand }}" name="dependent_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0"
                   value="Female" {{ $dependent && $dependent->member_gender == 'Female' ? 'checked="checked"' : '' }} >
            <label class="xcustom-control-label form-check-label pl-4"
                   for="dependent_genderFemale{{ $rand }}">Female</label>
        </div>
    <!-- <div class="custom-control custom-radio custom-control-inline pl-0">
            <input type="radio" id="dependent_genderOther" name="dependent_gender"
                   class="xcustom-control-input form-check-input  with-gap mr-0"
                   value="Other" {{ $dependent && $dependent->member_gender == 'Other' ? 'checked="checked"' : '' }} >
            <label class="xcustom-control-label form-check-label pl-4"
                   for="dependent_genderOther{{ $rand }}">Other</label>
        </div> -->

    </div>
    <div id="profileFName">
        <label for="dependent_first_name">First Name</label>
        <input type="text" class="form-control" id="dependent_first_name"
               value="{{ $dependent ? $dependent->member_first_name : '' }}">
    </div>
    <div id="profileLName">
        <label for="dependent_last_name">Last Name</label>
        <input type="text" class="form-control" id="dependent_last_name"
               value="{{ $dependent ? $dependent->member_last_name : '' }}">
    </div>

    <div id="profileDependent-role">
        <label for="dependent_role_in_estate" class="pr-1">Role In Your Estate</label>

        <select class="colorful-select mdb-select mdb-select-dependent dropdown-primary" id="dependent_role_in_estate"
                multiple
                data-actions-box="true"
                style="display: none">
            <option disabled="disabled"></option>
            {{--@php
            $dependent_role_in_estate_ar = array();
            $roles_array_values = array_values($roles_obj->get_roles());
            foreach ($roles_obj->get_roles() as $k => $v) {
                if ($dependent) {
                    $dependent_role_in_estate_ar = explode('|', $dependent->member_role_in_estate);
                }
                $disabled = $k == 0 ? 'disabled="disabled"': '';
                @endphp
                <option id="dependent_role_in_estate_{{ $k }}" value="{{ $k }}"
                 {{$disabled}}   {{ $dependent && in_array($k, $dependent_role_in_estate_ar) ? 'selected="selected"' : '' }}
                >{{ $v }}</option>
            @php } @endphp
            --}}
            @php $dependent_role_in_estate_ar =array();  @endphp
            @if($dependent)
                @php $dependent_role_in_estate_ar = $dependent->role_ids_array($dependent->roles) ;  @endphp
            @endif
            @foreach(\App\Role::all() as $role)
                <option id="dependent_role_in_estate_{{ $role->role_id }}" value="{{ $role->role_id }}"
                        {{ $dependent && in_array($role->role_id , $dependent_role_in_estate_ar) ? 'selected="selected"' : '' }}
                >{{ $role->role_name }}</option>
            @endforeach
        </select>
    </div>

    <div id="profileDependent-relationship">
        <label for="dependent_relationship_to_owner">Relationship to you</label>
        <input type="text" class="form-control" maxlength="15" id="dependent_relationship_to_owner"
               placeholder="i.e. Son, Grandmother"
               value="{{ $dependent && $dependent->member_relationship_to_owner ? $dependent->member_relationship_to_owner : '' }}"
        >
    </div>
    <div id="profileDependent-bday">
        <label for="dependent_birth_day">Birthdate</label>
        <input type="text" class="white form-control" id="dependent_birth_day"
               value="{{ $dependent && $dependent->member_birth_day ? date('m/d/Y', strtotime($dependent->member_birth_day)) : '' }}">

    </div>

    <div id="profileEmail">
        <label for="dependent_email">Email</label>
        <input type="email" class="form-control member_email" id="dependent_email"
               value="{{ $dependent ? $dependent->member_email : '' }}">
    </div>
    <div id="profilePhone">
        <label for="dependent_phone">Phone</label>
        <!--      <input type="text" class="form-control" id="profilePhoneID" placeholder="">
        --> <input type="text" class="form-control phone_us" id="dependent_phone"
                   value="{{ $dependent ? $dependent->member_phone : '' }}">
    </div>


    <div id="profileAddress">
        <label for="dependent_address">Address</label>

        <input type="text" class="white form-control" id="dependent_address"
               value="{{
               $dependent && $dependent->member_address ? $dependent->member_address : $estate_exists->estate_address
               }}">
    </div>
    <div id="profileAddress2">
        <label for="dependent_address2">Address 2</label>
        <input type="text" class="white form-control" id="dependent_address2"
               value="{{ $dependent && $dependent->member_address2 ? $dependent->member_address2 : $estate_exists->estate_address2 }}">

    </div>


    <div id="profileCity">
        <label for="dependent_city">City</label>
        <input type="text" class="white form-control" id="dependent_city"
               value="{{ $dependent && $dependent->member_city ? $dependent->member_city : $estate_exists->estate_city }}">
    </div>
    <div id="profileState">
        <label for="dependent_state">State</label>
        <input type="text" list="statename_profile" class="white form-control" id="dependent_state"
               value="{{ $dependent && $dependent->member_state ? $dependent->member_state : $estate_exists->estate_state }}">
        <datalist id="statename_profile">
            {{--@php include '../../../About-Me/Estate/states.php'; @endphp--}}
            @include('project.layouts.states')
        </datalist>
    </div>
    <div id="profileZip">
        <label for="dependent_zip">Zip</label>
        <input type="text" class="white form-control" id="dependent_zip"
               value="{{ $dependent && $dependent->member_zip ? $dependent->member_zip : $estate_exists->estate_zip }}">

    </div>
    @php $document_disabled_class = $guardian_member && $guardian_member->member_id ? '' :'documents_disabled' ;@endphp
    <div id="profile_docs">
        <label for="profileDependentDocs">View/Add Documents</label>
        <a id="profileDependentDocs"
           class="btn btn-primary btn-size rounded_5_button documents_disabled document_tabs_open"
           data-document-category="2"
           data-document-category-sub="5"
           data-document-category-sub-sub="{{ $dependent ? $dependent->member_id : '' }}"
           data-document-category-sub-sub-sub="1"
        >Documents</a>
    </div>
    <div id="profile_notes">
        <label for="dependent_special_notes">Notes/Wishes</label>

        <textarea class="form-control profile_notes special_notes_dependent" name="" id="dependent_special_notes"
                  rows="4"
                  placeholder="Notes about this dependent...">{{ $dependent ? $dependent->member_special_notes : '' }}</textarea>

    </div>


    <div id="profile_save">
        <button type="button" class="btn btn-primary btn-sm rounded_5_button disabled" id="btnChange-dependents">
            Update
        </button>
    </div>
    @php
       // $members_user_account = $member_obj->members_user_account($dependent);
      //  $invite_class = $member_obj->member_has_email($dependent) ? '' : 'disabled_invite';

    @endphp
    @php
        use App\Member;$members_user_account = $dependent ? $dependent->member_user_account($dependent) : false;//$member_obj->members_user_account($spouse_found);
        $invite_class = $dependent && $dependent->member_has_email($dependent) ?'':'disabled_invite'; //$member_obj->member_has_email($spouse_found) ?'':'disabled_invite';

    @endphp
    <div id="profile_invite">
        <div id="dependent-inviteBtn" class="content_box"
             data-member-member-id="{{ $dependent && $dependent->member_id ? $dependent->member_id : 0 }}">
            @php $display_invite = $dependent && !$members_user_account ? 'display:block' : 'display:none;' @endphp

            <a id="btnChange-dependentInvite" type="button"
               class="btn btn-default btn-sm  rounded_5_button invite_member_open {{ $invite_class }}"
               style="{{ $display_invite }}"
            >Invite</a>

        </div>
    </div>


    <div id="profile_inviteStatus">
         @if ($members_user_account) {
        <div id="profile_InviteStatusContainer" class="message_member_open"
             data-href="{{ $helper->get_tab_url(100) }}&message_user_id_trigger={{ $members_user_account }}"
             data-toggle="tooltip" title="Message" style="cursor: pointer;">
            <i class="far fa-comment-dots" style="font-size: 30px;margin-top: 15px"></i>
        </div>
        @elseif ($dependent && $dependent->member_invitation_status > 0)
        <a id="profile_InviteStatusContainer" style="{{ $display_invite }};padding-top: 13px;
                color: {{ $members_user_account && $member->member_invitation_status != 4 ? 'green' : 'red' }}"
        >{{ $member_obj->get_member_invitation_status_text($dependent) }}</a>
        @endif
    </div>


    <div id="profile_next">
        <button type="button" class="btn btn-primary btn-sm rounded_5_button" id="btnChangeNext-dependents">Next
        </button>
    </div>
    <div id="profile_close">
        <a class="cancel cancel_button_set" id="btnClose-dependents" data-dismiss="modal">Close</a>
    </div>
</form>