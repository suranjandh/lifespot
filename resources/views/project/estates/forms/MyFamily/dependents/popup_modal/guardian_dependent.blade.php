<style>
    .guardian_memberNewNotes {
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

    #form_guardian_dependent {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 2fr 2fr;
        grid-gap: 5px;
        grid-template-areas: "pic  gender fName fName fName lName lName" "relationship relationship relationship role role role role" "email email email email email phone bday" "address address address address address address address2" "city city city city city state zip" "notes notes notes notes notes notes docs" "btn btn btn invites inviteStatus  nextBtn cancel";
    }

    #guardian_memberNew-header {
        grid-area: header;
        padding: 0;
    }

    #guardian_memberNew-select {
        grid-area: header;
        position: relative;
    }

    #guardian_memberNew-pic {
        grid-area: pic;
        position: relative;
    }

    #guardian_memberNew-gender {
        grid-area: gender;
        /* width: 30%; */
    }

    #guardian_memberNew-relationship {
        grid-area: relationship;
    }

    #guardian_memberNew-role {
        grid-area: role;
    }

    #guardian_memberNew-fName {
        grid-area: fName;
        /* width: 130%; */
    }

    #guardian_memberNew-lName {
        grid-area: lName;
    }

    #guardian_memberNew-email {
        grid-area: email;
    }

    #guardian_memberNew-GuardianDependentSelect {
        grid-area: dependentSelect;
    }

    #guardian_memberNew-phone {
        grid-area: phone;
    }

    #guardian_memberNew-address {
        grid-area: address;
    }

    #guardian_memberNew-address2 {
        grid-area: address2;
    }

    #guardian_memberNew-city {
        grid-area: city;
    }

    #guardian_memberNew-state {
        grid-area: state;
    }

    #guardian_memberNew-zip {
        grid-area: zip;
    }

    #guardian_memberNew-bday {
        grid-area: bday;
    }

    #guardian_memberNew-maritalStatus {
        grid-area: maritalStatus;
    }

    #guardian_memberNew-anniversary {
        grid-area: anniversary;
    }

    #guardian_memberNew-docs {
        grid-area: docs;
    }

    #guardian_memberNew-gift {
        grid-area: gift;
    }

    #guardian_memberNew-notes {
        grid-area: notes;
        /* height: 155px; */
    }

    .cancel:hover {
        text-decoration: underline;
    }

    #guardian_memberNew-submitBtn {
        /* margin-top: -25px; */
        grid-area: btn;
    }

    /* #btnChange-ADDmemberNew {
         border-radius: 8px;
     }*/

    /*  #guardian_memberNew-GuardianDependentSelect {
          grid-area: dependentSelect;
      }*/

    #dependent_guardian_close {
        grid-area: cancel;
        justify-self: center;
        align-self: center;
    }


    #dependent_guardian_close a {
        float: right;
        padding-top: 15px;
    }

    #guardian_dependent-inviteBtn {
        grid-area: invites;
        justify-self: center;
        align-self: center;
    }

    #guardian_dependent_inviteStatus {
        grid-area: inviteStatus;
    }

    #guardian_dependent_next {
        grid-area: nextBtn;
    }
</style>
<h3>Guardian Information</h3>
<span id="guardian_member_error_message"></span>
<form autocomplete="off" id="form_guardian_dependent">
    <div id="guardian_memberNew-pic" class="image-upload">
        <input id="guardian_member_picture" type="file" class="change_trigger_disabled"/>
        <label for="guardian_member_picture">
            <div class="img__wrap">
                @php
                    $guardian_member_image = $guardian_member && trim($guardian_member->member_image) != '' ? Config::get('constants.SITE_BASE_URL') . Config::get('constants.MEMBER_IMG_FOLDER') . '/' . $guardian_member->member_image : Config::get('constants.DEFAULT_AVATAR_IMAGE_URL');
                @endphp
                <img class="img__img img-thumbnail guardian_member_img__img" id="guardian_member_img__img"
                     src="{{ $guardian_member_image }}" style="height:75px;width:auto;"
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
    <div id="guardian_memberNew-gender" class="guardian_memberNew-step-2">
        <input type="hidden" value="{{ $guardian_member_dependent }}" name="guardian_dependent_id"
               id="guardian_dependent_id">
        <input type="hidden" value="{{ $guardian_member_guardian }}" name="guardian_member_new_member_id"
               id="guardian_member_new_member_id">
        <input type="hidden" name="member_member_id" id="guardian_member_member_id" value="">

        <div class="custom-control custom-radio custom-control-inline xmt-3 pl-0">
            <input type="radio" id="guardian_member_genderMale" name="guardian_member_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0"
                   value="Male" {{ $guardian_member && $guardian_member->member_gender == 'Male' ? 'checked="checked"' : '' }} >
            <label class="xcustom-control-label form-check-label pl-4" for="guardian_member_genderMale">Male</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline pl-0">
            <input type="radio" id="guardian_member_genderFemale" name="guardian_member_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0"
                   value="Female" {{ $guardian_member && $guardian_member->member_gender == 'Female' ? 'checked="checked"' : '' }}>
            <label class="xcustom-control-label form-check-label pl-4" for="guardian_member_genderFemale">Female</label>
        </div>
    <!-- <div class="custom-control custom-radio custom-control-inline pl-0">
        <input type="radio" id="guardian_member_genderOther" name="guardian_member_gender"
               class="xcustom-control-input form-check-input  with-gap mr-0"
               value="Other" {{ $guardian_member && $guardian_member->member_gender == 'Other' ? 'checked="checked"' : '' }}>
        <label class="xcustom-control-label form-check-label pl-4" for="guardian_member_genderOther">Other</label>
    </div> -->
    </div>
    <div id="guardian_memberNew-fName" class="guardian_memberNew-step-2">
        <label for="guardian_member_first_name">First Name</label>
        <input type="text" class="form-control" id="guardian_member_first_name" placeholder="First name"
               value="{{ $guardian_member ? $guardian_member->member_first_name : '' }}">

        <div id="guardian_suggesstion-box"></div>
    </div>
    <div id="guardian_memberNew-lName" class="guardian_memberNew-step-2">
        <label for="guardian_member_last_name">Last Name</label>
        <input type="text" class="form-control" id="guardian_member_last_name" placeholder="Last name"
               value="{{ $guardian_member ? $guardian_member->member_last_name : '' }}">
    </div>
    <div id="guardian_memberNew-relationship">
        <label for="guardian_member_relationship_in_estate">Relationship to you</label>
        <input type="text" class="form-control" maxlength="15" id="guardian_member_relationship_in_estate"
               placeholder="i.e. Son, Grandmother"
               value="{{ $guardian_member && $guardian_member->member_relationship_to_owner ? $guardian_member->member_relationship_to_owner : '' }}"
        >
    </div>
    <div id="guardian_memberNew-role" class="guardian_memberNew-step-2">
        <label for="guardian_member_role_in_estate" class="pr-1">Role In Your Estate</label>
        <select class="mdb-select colorful-select dropdown-primary" id="guardian_member_role_in_estate" multiple
                data-actions-box="true"
                style="display: none">
            <option disabled="disabled"></option>
            {{--   @php
               $roles_array_values = array_values($roles_obj->get_roles());
               foreach ($roles_obj->get_roles() as $k => $v) {
                   $guardian_member_roles_set = explode('|', $guardian_member->member_role_in_estate);
                   $disabled = $k == 0 ? 'disabled="disabled"': '';
                   $selected = $guardian_member && in_array($k, $guardian_member_roles_set) ? 'selected="selected"' : '';
                   if (!$guardian_member && $k == $roles_obj->get_role_guardian()) {
                       $selected = 'selected="selected"';
                   }
                   @endphp
                   <option id="guardian_member_role_in_estate_{{ $k }}"
                       {{$disabled}}    value="{{ $k }}" {{ $selected }}>{{ $v }}</option>

               @php } @endphp--}}
            @php $guardian_member_roles_set =array();  @endphp
            @if($guardian_member)
                @php $guardian_member_roles_set = $guardian_member->role_ids_array($guardian_member->roles) ;  @endphp
            @endif
            @foreach(\App\Role::all() as $role)
                {{-- <option id="dependent_role_in_estate_{{ $role->role_id }}" value="{{ $role->role_name }}"
                         {{ $dependent && in_array($role->role_id , $dependent_role_in_estate_ar) ? 'selected="selected"' : '' }}
                 >{{ $role->role_name }}</option>--}}
                @php
                    $selected = '' ;
                        if (!$guardian_member &&  $role->role_id == \App\Role::get_role_guardian()) {
                                            $selected = 'selected="selected"';
                        }
                @endphp
                <option id="guardian_member_role_in_estate_{{ $role->role_id }}"
                        value="{{ $role->role_id }}" {{ $selected }}>{{ $role->role_name }}</option>
            @endforeach
        </select>
    </div>
    <style>

        #guardian-member-list {
            float: left;
            list-style: none;
            margin-top: -3px;
            padding: 0;
            width: 200px;
            position: absolute;
            z-index: 1000
        }

        #guardian-member-list li {
            background: #FFFFFF;
        }

        #guardian-member-list li.guardian-member-search_li {
            padding: 10px;
            background: #FFFFFF;
            height: 40px
        }

        #guardian-member-list li.guardian-member-search_li:hover {
            background: #FFFFFF;
            cursor: pointer;
        }

        .input-group-addon-close {
            background-color: white;
            text-align: center;
            width: 30px;
            border: #a8d4b1 solid 1px;
            padding-top: 5px;
            display: none;
        }
    </style>

    <div id="guardian_memberNew-email" class="guardian_memberNew-step-2">
        <label for="guardian_member_email">Email</label>
        <input type="email" class="form-control white xgrey-text member_email" id="guardian_member_email"
               placeholder="Email"
               value="{{ $guardian_member ? $guardian_member->member_email : '' }}">
    </div>


    <div id="guardian_memberNew-phone" class="guardian_memberNew-step-2">
        <label for="guardian_member_phone">Phone</label>
        <input type="text" class="form-control phone_us" id="guardian_member_phone" placeholder="Phone"
               value="{{ $guardian_member ? $guardian_member->member_phone : '' }}">
    </div>

    <div id="guardian_memberNew-bday" class="guardian_memberNew-step-2">
        <label for="guardian_member_birth_day">Birthdate</label>
        <input type="text" class="form-control white" id="guardian_member_birth_day"
               value="{{ $guardian_member && $guardian_member->member_birth_day > 0 ? date('m/d/Y', strtotime($guardian_member->member_birth_day)) : '' }}">
    </div>
    <div id="guardian_memberNew-address" class="guardian_memberNew-step-2">
        <label for="guardian_member_address">Address</label>
        <input type="text" class="form-control" id="guardian_member_address" placeholder="Address"
               value="{{ $guardian_member ? $guardian_member->member_address : '' }}">
    </div>
    <div id="guardian_memberNew-address2" class="guardian_memberNew-step-2">
        <label for="guardian_member_address2">Address 2</label>
        <input type="text" class="form-control" id="guardian_member_address2" placeholder="Apartment, unit"
               value="{{ $guardian_member ? $guardian_member->member_address2 : '' }}">
    </div>
    <div id="guardian_memberNew-city" class="guardian_memberNew-step-2">
        <label for="guardian_member_city">City</label>
        <input type="text" class="form-control" id="guardian_member_city"
               value="{{ $guardian_member ? $guardian_member->member_city : '' }}">
    </div>
    <div id="guardian_memberNew-state" class="guardian_memberNew-step-2">
        <label for="guardian_member_state">State</label>
        <input type="text" list="statename_guardian" class="form-control" id="guardian_member_state"
               value="{{ $guardian_member ? $guardian_member->member_state : '' }}">
        <datalist id="statename_guardian">
            {{--{{ include '../../../About-Me/Estate/states.php'; }}--}}
            @include('project.layouts.states')
        </datalist>
    </div>
    <div id="guardian_memberNew-zip" class="guardian_memberNew-step-2">
        <label for="guardian_member_zip">Zip</label>
        <input type="text" class="form-control" id="guardian_member_zip"
               value="{{ $guardian_member ? $guardian_member->member_zip : '' }}">
    </div>


    <div id="guardian_memberNew-notes" class="guardian_memberNew-step-2">
        <label for="guardian_member_notes">Member Notes</label>
        <textarea class="form-control memberNewNotes guardian_memberNewNotes" name="" id="guardian_member_notes"
                  rows="2"
                  placeholder="Notes about this member...">{{ $guardian_member ? $guardian_member->member_special_notes : '' }}</textarea>
    </div>
    @php $document_disabled_class = $guardian_member && $guardian_member->member_id ? '' :'documents_disabled' ;@endphp

    <div id="guardian_memberNew-docs">
        <label for="guardian_memberNewDocs">View/Add Documents</label>
        <a id="guardian_memberNewDocs"
           class="btn btn-primary btn-size rounded_5_button documents_disabled document_tabs_open"
           data-document-category="7"
           data-document-category-sub="25"
           data-document-category-sub-sub="{{ $guardian_member ? $guardian_member->member_id : '0' }}"
           data-document-category-sub-sub-sub="0"
        >Documents</a>
    </div>

    <div id="guardian_memberNew-submitBtn" class="guardian_memberNew-step-2">
        <a id="btnChange-ADDGuardianmemberNew" type="button" class="btn btn-primary btn-sm rounded_5_button disabled"
        >Update</a>
    </div>
    {{--@php
    $members_user_account = $member_obj->members_user_account($guardian_member);
    $invite_class = $member_obj->member_has_email($guardian_member) ?'':'disabled_invite';

    @endphp--}}
    @php
        use App\Member;$members_user_account = $guardian_member ? $guardian_member->member_user_account($guardian_member) : false;//$member_obj->members_user_account($spouse_found);
        $invite_class = $guardian_member && $guardian_member->member_has_email($guardian_member) ?'':'disabled_invite'; //$member_obj->member_has_email($spouse_found) ?'':'disabled_invite';

    @endphp
    <div id="guardian_dependent-inviteBtn" class="content_box"
         data-member-member-id="{{ $guardian_member && $guardian_member->member_id ? $guardian_member->member_id : 0 }}">
        @php $display_invite = $dependent && $guardian_member  && !$members_user_account ? 'display:block' : 'display:none;' @endphp

        <a id="btnChange-dependentGuardianInvite" type="button"
           class="btn btn-default btn-sm rounded_5_button invite_member_open {{$invite_class}}"
           style="{{ $display_invite }}"
        >Invite</a>

    </div>
    <div id="guardian_dependent_inviteStatus">
        @if ($members_user_account)
            <div id="guardian_dependent_InviteStatusContainer" class="message_member_open"
                 data-href="{{ $helper->get_tab_url(100) }}&message_user_id_trigger={{ $members_user_account }}"
                 data-toggle="tooltip" title="Message" style="cursor: pointer;">
                <i class="far fa-comment-dots" style="font-size: 30px;margin-top: 15px"></i>
            </div>
        @elseif($guardian_member && $guardian_member->member_invitation_status > 0)
            <a id="guardian_dependent_InviteStatusContainer" style="{{ $display_invite }};padding-top: 13px;
                    color: {{ $members_user_account && $guardian_member->member_invitation_status != 4 ? 'green' : 'red' }}"
            >{{ $member_obj->get_member_invitation_status_text($guardian_member) }}</a>
        @endif
    </div>
    <div id="guardian_dependent_next">
        <button type="button" class="btn btn-primary btn-sm rounded_5_button" id="ADDGuardianNext-dependents">Next
        </button>
    </div>

    <div id="dependent_guardian_close">
        <a id="guardian_member-closeBtn" class="cancel_button_set" data-dismiss="modal">Close
        </a>
    </div>
</form>

