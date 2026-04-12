@php

    // include dirname(dirname(dirname(dirname(__FILE__)))) . '/lib/includes/header_include.php';

    $member_id = \Illuminate\Support\Facades\Input::get('member_member_id');// isset($_POST->member_member_id) && $_POST->member_member_id ? $_POST->member_member_id : 0;
    $member = array();
    //$member_obj = new MemberModel();
    $guardians_dependents_member_ids = array();

    $pets_guardian = "";
    //$pet_obj = new PetModel();
        $dependents = auth()->user()->dependents; // $member_obj->get_dependents_by_user_id($_SESSION->loggedInUser);

@endphp
@if ($member_id > 0)
    @php
        $member = \App\Member::find($member_id);//$member_obj->get_member_by_id($member_id);
        $guardians_dependents_member_ids = $member->guardians_dependents_member_ids_set($member_id);
        $caregiver_to_pets = App\Pet::member_is_caregiver_to_pets($member_id);
        //$guardian_member_obj = new GuardianMemberModel();
       //  ??? $guardians_dependents_member_ids = $guardian_member_obj->get_guardians_dependents_member_ids_set($member_id);

      // ???  $caregiver_to_pets = $pet_obj->member_is_caregiver_to_pets($member_id);
      /* ????  if($caregiver_to_pets){
            $caregiver_to_pets_set = array();
            foreach ($caregiver_to_pets as $caregiver_to_pet){
                $caregiver_to_pets_set[] = $caregiver_to_pet->pet_name;
            }
            if($caregiver_to_pets_set){
                $pets_guardian = "Caregiver to Pet(s) : ".implode(' , ',$caregiver_to_pets_set);
            }
        }*/
    @endphp
@endif
<style>
    .memberNewNotes {
        resize: none;
    }

    .form-check-input[type=checkbox][class*=filled-in]:checked + label:after, label.btn input[type=checkbox][class*=filled-in]:checked + label:after {
        top: 0;
        border-color: rgb(57, 122, 242);
        background-color: rgb(57, 122, 242);
        z-index: 0;
    }

    .select-wrapper input.select-dropdown {
        display: block;
        height: auto;
        width: 100%;
        padding: 0 .75rem;
        margin: 0;
        font-size: 1rem;
        line-height: 2.25;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .linkColor {
        color: rgb(57, 122, 242);
    }

    #form-memberNew {
        display: grid;
        /* grid-template-columns: repeat(5 1fr); */
        /* grid-template-columns: 1fr 1fr 2fr 2fr 2fr; */
        /* grid-template-columns: repeat(6 1fr); */
        grid-template-columns: 1fr 1fr 1fr 2fr 2fr 2fr;
        grid-gap: 5px;
        grid-template-areas: "pic  gender fName fName lName lName" "role role role role relationship bday" "email email email email phone phone" "dependentSelect dependentSelect dependentSelect dependentSelect dependentSelect dependentSelect" "address address address address address address2" "city city city city state zip" "notes notes notes notes notes docs" "btn btn invite inviteStatus . cancel";
    }

    #memberNew-header {
        grid-area: header;
        padding: 0;
    }

    #memberNew-select {
        grid-area: header;
        position: relative;
    }

    #memberNew-pic {
        grid-area: pic;
        position: relative;
    }

    #memberNew-gender {
        grid-area: gender;
        /* width: 30%; */
    }

    #memberNew-relationship {
        grid-area: relationship;
    }

    #memberNew-role {
        grid-area: role;
    }

    #memberNew-fName {
        grid-area: fName;
        /* width: 130%; */
    }

    #memberNew-lName {
        grid-area: lName;
    }

    #memberNew-email {
        grid-area: email;
    }

    #memberNew-GuardianDependentSelect {
        grid-area: dependentSelect;
    }

    #memberNew-phone {
        grid-area: phone;
    }

    #memberNew-address {
        grid-area: address;
    }

    #memberNew-address2 {
        grid-area: address2;
    }

    #memberNew-city {
        grid-area: city;
    }

    #memberNew-state {
        grid-area: state;
    }

    #memberNew-zip {
        grid-area: zip;
    }

    #memberNew-bday {
        grid-area: bday;
    }

    #memberNew-maritalStatus {
        grid-area: maritalStatus;
    }

    #memberNew-anniversary {
        grid-area: anniversary;
    }

    #memberNew-docs {
        grid-area: docs;
    }

    #memberNew-docs a {
        border-radius: 8px;
    }

    #memberNew-gift {
        grid-area: gift;
    }

    #memberNew-notes {
        grid-area: notes;
        /* height: 155px; */
    }

    .cancel {
        grid-area: cancel;
        /* justify-self: center;
        align-self: center; */
        justify-self: end;
        align-self: end;
    }

    .cancel:hover {
        text-decoration: underline;
    }

    #memberNew-submitBtn {
        /* margin-top: -25px; */
        grid-area: btn;
    }

    #btnChange-ADDmemberNew {
        border-radius: 8px;
    }

    #memberNew-inviteBtn {
        grid-area: invite;

    }

    #btnChangeMemberNewInvite {
        border-radius: 8px;
    }

    #memberNew-inviteStatus {
        grid-area: inviteStatus;
    }

    #memberNew-inviteStatus a {
        margin-top: 20px;
    }


</style>
<span id="member_error_message"></span>
<form autocomplete="off" id="form-memberNew">
    <div id="memberNew-pic" class="image-upload">
        <input id="member_picture" type="file" class="change_trigger_disabled"/>
        <label for="member_picture">
            <div class="img__wrap">
                @php
                    $member_image = $member && trim($member->member_image) != '' ? Config::get('constants.SITE_BASE_URL') . Config::get('constants.MEMBER_IMG_FOLDER') . '/' . $member->member_image : Config::get('constants.DEFAULT_AVATAR_IMAGE_URL');
                @endphp
                <img class="img__img img-thumbnail" id="member_img__img" src="{{ $member_image }}"
                     style="height:75px;width:auto;"
                     alt="">
                <i id="loading" style="display:none" class="ace-icon fa fa-spinner"></i>

                <div class="img__description_layer">
                    <p class="img__description"><i
                                class="fas fa-plus-circle add_field_button_phone white-text "></i><br> Click to change
                        photo</p>
                </div>
            </div>
        </label>
    </div>

    <div id="memberNew-gender" class="memberNew-step-2">
        <input type="hidden" value="{{ $member_id }}" name="member_new_member_id" id="member_new_member_id">
        <input type="hidden" name="member_member_id" id="member_member_id" value="">

        <div class="custom-control custom-radio custom-control-inline xmt-3 pl-0">
            <input type="radio" id="member_genderMale" name="member_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0"
                   value="Male" {{ $member && $member->member_gender == 'Male' ? 'checked="checked"' : '' }} >
            <label class="xcustom-control-label form-check-label pl-4" for="member_genderMale">Male</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline pl-0">
            <input type="radio" id="member_genderFemale" name="member_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0"
                   value="Female" {{ $member && $member->member_gender == 'Female' ? 'checked="checked"' : '' }}>
            <label class="xcustom-control-label form-check-label pl-4" for="member_genderFemale">Female</label>
        </div>
    
    </div>

    <div id="memberNew-fName" class="memberNew-step-2">
        <label for="member_first_name">First Name</label>
        <input type="text" class="form-control" id="member_first_name" placeholder="First name"
               value="{{ $member ? $member->member_first_name : '' }}">
    </div>
    <div id="memberNew-lName" class="memberNew-step-2">
        <label for="member_last_name">Last Name</label>
        <input type="text" class="form-control" id="member_last_name" placeholder="Last name"
               value="{{ $member ? $member->member_last_name : '' }}">
    </div>
    <div id="memberNew-role" class="memberNew-step-2">
        <label for="member_role_in_estate" class="pr-1">Role In Your Estate</label>
        <select class="mdb-select colorful-select dropdown-primary member_role_in_estate_for_dependents"
                id="member_role_in_estate" multiple
                data-actions-box="true"
                style="display: none">
            <option disabled="disabled"></option>
            {{-- @php
             $roles_array_values = array_values($roles_obj->get_roles());
             $role_has_guardian = $member ? $member_obj->role_has_guardian($member->member_role_in_estate) : false;
             foreach ($roles_obj->get_roles() as $k => $v) {
                // if($k==0)continue;
                 $member_roles_set = $member ? explode('|', $member->member_role_in_estate) : array();
                 $disabled = $k == 0 ? 'disabled="disabled"': '';
                 @endphp
                 <option id="member_role_in_estate_{{ $k }}"
                      {{$disabled}}   value="{{ $k }}" {{ $member && in_array($k, $member_roles_set) ? 'selected="selected"' : '' }}>{{ $v }}</option>

             @php } @endphp--}}
            @php
                //$member_roles = $member->roles ;
                $member_role_ids = $member ?   $member->role_ids_array($member->roles): array();
                $role_has_guardian = $member ? $member->role_has_guardian($member->roles) : false;
            @endphp
            @foreach(\App\Role::all() as $role)
                <option id="member_role_in_estate_{{ $role->role_id }}"
                        value="{{ $role->role_id }}" {{ $member && in_array($role->role_id, $member_role_ids) ? 'selected="selected"' : '' }}>{{ $role->role_name }}</option>

            @endforeach
        </select>
    </div>
    <div id="memberNew-relationship">
        <label for="member_relationship_to_owner">Relationship to you</label>
        <input type="text" class="form-control" maxlength="15" id="member_relationship_to_owner"
               placeholder="i.e. Son, Grandmother"
               value="{{ $member && $member->member_relationship_to_owner ? $member->member_relationship_to_owner : '' }}"
        >
    </div>

    <div id="memberNew-bday" class="memberNew-step-2">
        <label for="member_birth_day">Birthdate</label>
        <input type="text" class="form-control white" id="member_birth_day"
               value="{{ $member && $member->member_bday > 0 ? date('m/d/Y', strtotime($member->member_bday)) : '' }}">
    </div>

    <div id="memberNew-email" class="memberNew-step-2">
        <label for="member_email">Email</label>
        <input type="email" class="form-control white xgrey-text member_email" id="member_email" placeholder="Email"
               value="{{ $member ? $member->member_email : '' }}">
    </div>

    <div id="memberNew-phone" class="memberNew-step-2">
        <label for="member_phone">Phone</label>
        <input type="text" class="form-control phone_us" id="member_phone" placeholder="Phone"
               value="{{ $member ? $member->member_phone : '' }}">
    </div>
    <div id="memberNew-GuardianDependentSelect" class="memberNew-step-2">
        <label for="member_guardian_dependents" class="pr-1">Assign Guardianship to:</label><span
                style="float: right">{{$pets_guardian}}</span>
        @php $member_guardian_dependents_enable = true;//$role_has_guardian ? '' : 'disabled="disabled"' @endphp
        <select class="mdb-select colorful-select dropdown-primary member_guardian_dependents"
                id="member_guardian_dependents" {{ $member_guardian_dependents_enable }} multiple
                data-actions-box="true"
                style="display: none">
            <option disabled="disabled"></option>
            {{-- @php
             if ($dependents) {
                 $guardian_member_obj = new GuardianMemberModel();
                 foreach ($dependents as $k => $dependent) {
                     if ($guardian_member_obj->dependent_has_guardian($dependent->member_id)) {
                         if (!in_array($dependent->member_id, $guardians_dependents_member_ids)) {
                             continue;
                         }
                     }
                     // remove has guardians other
                     // remove himself ;
                     $dependent_name = $dependent->member_first_name . ' ' . $dependent->member_last_name;
                     $selected = in_array($dependent->member_id, $guardians_dependents_member_ids) ? 'selected="selected"' : '';
                     @endphp
                     <option id="member_guardian_dependents_{{ $dependent->member_id }}"
                         {{ $selected }} value="{{ $dependent->member_id }}">{{ $dependent_name }}</option>

                     @php
                 }
             } @endphp--}}

            @if ($dependents)
                @foreach ($dependents as $k => $dependent)
                    @if ($dependent->member_guardian_member_id > 0)
                        @if (!in_array($dependent->member_id, $guardians_dependents_member_ids))
                            @php continue; @endphp
                        @endif
                    @endif
                    // remove has guardians other
                    // remove himself ;
                    @php  $dependent_name = $dependent->member_first_name . ' ' . $dependent->member_last_name;
                        $selected = in_array($dependent->member_id, $guardians_dependents_member_ids) ? 'selected="selected"' : '';
                    @endphp
                    <option id="member_guardian_dependents_{{ $dependent->member_id }}"
                            {{ $selected }} value="{{ $dependent->member_id }}">{{ $dependent_name }}</option>

                @endforeach
            @endif
        </select>
    </div>

    <div id="memberNew-address" class="memberNew-step-2">
        <label for="member_address">Address</label>
        <input type="text" class="form-control" id="member_address" placeholder="Address"
               value="{{ $member ? $member->member_address : '' }}">
    </div>
    <div id="memberNew-address2" class="memberNew-step-2">
        <label for="member_address2">Address 2</label>
        <input type="text" class="form-control" id="member_address2" placeholder="Apartment, unit"
               value="{{ $member ? $member->member_address2 : '' }}">
    </div>
    <div id="memberNew-city" class="memberNew-step-2">
        <label for="member_city">City</label>
        <input type="text" class="form-control" id="member_city" value="{{ $member ? $member->member_city : '' }}">
    </div>
    <div id="memberNew-state" class="memberNew-step-2">
        <label for="member_state">State</label>
        <input type="text" list="statename_member" class="form-control" id="member_state"
               value="{{ $member ? $member->member_state : '' }}">
        <datalist id="statename_member">
            {{--{{ include '../About-Me/Estate/states.php'; }}--}}
            @include('project.layouts.states')
        </datalist>
    </div>
    <div id="memberNew-zip" class="memberNew-step-2">
        <label for="member_zip">Zip</label>
        <input type="text" class="form-control" id="member_zip" value="{{ $member ? $member->member_zip : '' }}">
    </div>


    <div id="memberNew-notes" class="memberNew-step-2">
        <label for="member_notes">Member Notes</label>
        <textarea class="form-control memberNewNotes" name="" id="member_notes" rows="2"
                  placeholder="Notes about this member...">{{ $member ? $member->member_spacial_notes : '' }}</textarea>
    </div>
    @php $document_disabled_class = $member && $member->member_id ? '' :'documents_disabled' ;@endphp
    <div id="memberNew-docs">
        <label for="memberNewDocs">View/Add Documents</label>
        <a id="memberNewDocs"
           class="btn btn-primary btn-size rounded_5_button document_tabs_open {{$document_disabled_class}}"
           data-document-category="7"
           data-document-category-sub="25"
           data-document-category-sub-sub="{{ $member ? $member->member_id : '0' }}"
           data-document-category-sub-sub-sub="0"
        >Documents</a>
    </div>
    <div id="memberNew-submitBtn" class="memberNew-step-2">
        <a id="btnChange-ADDmemberNew" type="submit" class="btn btn-primary btn-sm rounded_5_button disabled"
        >Update</a>
    </div>
    {{-- @php
     $members_user_account = $member_obj->members_user_account($member);
     $invite_class = $member_obj->member_has_email($member) ?'':'disabled_invite';
     @endphp--}}
    @php
        use App\Member;$members_user_account = $member ? $member->member_user_account($member) : false;//$member_obj->members_user_account($spouse_found);
        $invite_class = $member && $member->member_has_email($member) ?'':'disabled_invite'; //$member_obj->member_has_email($spouse_found) ?'':'disabled_invite';

    @endphp
    <div id="memberNew-inviteBtn" class="content_box"
         data-member-member-id="{{ $member && $member->member_id ? $member->member_id : 0 }}">
        @php $display_invite = $member  && !$members_user_account ? 'display:block' : 'display:none;' @endphp
        <a id="btnChangeMemberNewInvite" type="button" style="{{ $display_invite }}"
           class="btn btn-default btn-sm rounded_5_button invite_member_open {{$invite_class}}"
        >Invite</a>
    </div>
    <div id="memberNew-inviteStatus">
        @if ($members_user_account)
            <div id="memberNewInviteStatusContainer" class="message_member_open"
                 data-href="{{ auth()->user()->user_access == 1 ? route('kid_messages'):route('estate_index') }}&message_user_id_trigger={{ $members_user_account }}"
                 data-toggle="tooltip" title="Message" style="cursor: pointer;">
                <i class="far fa-comment-dots" style="font-size: 30px;margin-top: 15px"></i>
            </div>
        @elseif($member && $member->member_invitation_status > 0)
            <a id="memberNewInviteStatusContainer" style="{{ $display_invite }};padding-top: 13px;
                    color: {{ $members_user_account && $member->member_invitation_status != 4 ? 'green' : 'red' }}"
            >{{ $member_obj->get_member_invitation_status_text($member) }}</a>
        @endif
    </div>
    <a class="cancel cancel_button_set" id="member-closeBtn" style="display: none">Close</a>
</form>

