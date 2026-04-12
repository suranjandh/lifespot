@php
    //include dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/project/lib/includes/header_include.php';
    //$member_obj = new MemberModel();

    //$userId = $_SESSION->loggedInUser;
    //$spouse_found = $member_obj->find_spouse($userId);
$spouse_found = auth()->user()->spouse;
@endphp
<style>
    .maritalStatusNotes {
        resize: none;
    }

    .caret {
        display: none;
    }

    .custom-control-label::before {
        background-color: white;
    }

    #form-maritalStatus {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 2fr 2fr;
        grid-gap: 10px;
        grid-template-areas: "header header header header header header" "pic gender fName fName lName lName" "email email email email role role" "phone phone phone phone bday docs" "anniversary anniversary anniversary anniversary notes notes" "btn btn invite inviteStatus inviteStatus cancel";
    }


    #maritalStatus-header {
        grid-area: header;
        padding: 0;
    }

    #maritalStatus-pic {
        grid-area: pic;
        position: relative;
    }

    #maritalStatus-gender {
        grid-area: gender;
    }

    #maritalStatus-fName {
        grid-area: fName;
    }

    #maritalStatus-lName {
        grid-area: lName;
    }

    #maritalStatus-email {
        grid-area: email;
    }

    #maritalStatus-phone {
        grid-area: phone;
    }

    #maritalStatus-anniversary {
        grid-area: anniversary;
    }

    #maritalStatus-bday {
        grid-area: bday;
    }

    #maritalStatus-role {
        grid-area: role;
    }

    #maritalStatus-docs {
        grid-area: docs;
    }

    #maritalStatus-notes {
        grid-area: notes;
        height: 174px;
    }

    #maritalStatus-submitBtn {
        grid-area: btn;
    }

    #maritalStatus-nextSubmitBtn {
        /* grid-area: next; */
    }

    #maritalStatus-closeBtn {
        grid-area: cancel;
    }

    #maritalStatus-inviteBtn {
        grid-area: invite;
    }

    #maritalStatus-inviteStatus {
        grid-area: inviteStatus;
    }

    .IsJointlySharedAcct {
        font-size: 1.2rem;
        color: #4285f4;
        /* margin-left: 50px; */
    }

    #maritalStatus-closeBtn {
        grid-area: cancel;
        justify-self: end;
        align-self: end;
    }


</style>
<form autocomplete="off" id="form-maritalStatus">

    <h3 id="maritalStatus-header" class="float-left">Spouse <span id="spouse_error_message"
                                                                  style="font-size: 50%"></span>
        <span class="float-right ml-5">
                @php $rand = rand(1,5000)@endphp
                <input class="form-check-input IsJointlySharedAcct spouse_join_account_access"
                       name="spouse_join_account_access" id="spouse_join_account_access{{$rand}}" type="checkbox"
                       value="1"
                    {{ $spouse_found && $spouse_found->member_join_account_access == 1 ? 'checked="checked"' : '' }} >
                <label class="form-check-label IsJointlySharedAcct  pl-4" for="spouse_join_account_access{{$rand}}">
                <p class="JointAcct">Add spouse to shared account</p>
                </label>
            </span>
    </h3>


    <div id="maritalStatus-pic" class="image-upload">
        <input id="spouse_picture" class="change_trigger_disabled" name="spouse_picture" type="file"/>
        <label for="spouse_picture">
            <div class="img__wrap">
                @php
                    $spouse_found_image = $spouse_found && trim($spouse_found->member_image) != '' ? Config::get('constants.SITE_BASE_URL') . Config::get('constants.MEMBER_IMG_FOLDER') . '/' . $spouse_found->member_image . '?rand=' . rand(1, 1000) :Config::get('constants.PROJECT_IMAGE_URL').'defaultAvatar.jpeg';
                @endphp
                <img class="img__img img-thumbnail spouse_image_img"
                     src="{{$spouse_found_image}}"
                     id="spouse_image_img"
                     style="height:75px;width:auto;" alt="">
                <i id="loading" style="display:none" class="ace-icon fa fa-spinner"></i>

                <div class="img__description_layer">
                    <p class="img__description"><i
                                class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br> Click to Change
                        Photo</p>
                </div>
            </div>
        </label>
    </div>
    <div id="maritalStatus-gender">
        <div class="custom-control custom-radio custom-control-inline xmt-3 pl-0">
            @php $rand = rand(1,1000);@endphp
            <input type="radio" id="spouse_genderMale{{$rand}}" name="spouse_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0 spouse_genderMale" value="Male"
                    {{ $spouse_found && $spouse_found->member_gender == 'Male' ? 'checked="checked"' : '' }} >
            <label class="xcustom-control-label form-check-label pl-4" for="spouse_genderMale{{$rand}}">Male</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline pl-0">
            <input type="radio" id="spouse_genderFemale{{$rand}}" name="spouse_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0 spouse_genderFemale" value="Female"
                    {{ $spouse_found && $spouse_found->member_gender == 'Female' ? 'checked="checked"' : '' }}>
            <label class="xcustom-control-label form-check-label pl-4" for="spouse_genderFemale{{$rand}}">Female</label>
        </div>
    <!-- <div class="custom-control custom-radio custom-control-inline pl-0" style="visibiltiy:hidden;">
            <input type="radio" id="spouse_genderOther{{$rand}}" name="spouse_gender"
                   class="xcustom-control-input form-check-input  with-gap mr-0 spouse_genderOther" value="Other"
                {{ $spouse_found && $spouse_found->member_gender == 'Other' ? 'checked="checked"' : '' }}>
            <label class="xcustom-control-label form-check-label pl-4" for="spouse_genderOther{{$rand}}">Other</label>
        </div> -->
    </div>
    <div id="maritalStatus-fName">
        <input type="hidden" name="spouse_member_id" id="spouse_member_id"
               value="{{ $spouse_found ? $spouse_found->member_id : '' }}">
        <label for="spouse_first_name">First Name</label>
        <input type="text" class="form-control" id="spouse_first_name" placeholder="First name"
               value="{{ $spouse_found  ? $spouse_found->member_first_name : ''  }}">
    </div>
    <div id="maritalStatus-lName">
        <label for="spouse_last_name">Last Name</label>
        <input type="text" class="form-control" id="spouse_last_name" placeholder="Last name"
               value="{{ $spouse_found  ? $spouse_found->member_last_name : ''  }}">
    </div>
    <div id="maritalStatus-email">
        <label for="spouse_email">Email</label>
        <input type="email" class="form-control white xgrey-text member_email" id="spouse_email" placeholder="Email"
               value="{{ $spouse_found  ? $spouse_found->member_email : ''  }}">
    </div>
    <div id="maritalStatus-role">
        <label for="spouse_role_in_estate" class="pr-1 spouse_role_in_estate">Role In Your Estate</label>
        <select class="mdb-select colorful-select dropdown-primary" id="spouse_role_in_estate" multiple>
            <option disabled="disabled"></option>
            @php
                $spouse_role_in_estate_ar = $spouse_found ? $spouse_found->role_ids_array($spouse_found->roles): [];
                $role_null = count($spouse_role_in_estate_ar) == 0 && (($spouse_found &&  $spouse_found->member_first_name == '')|| !$spouse_found) ;
            @endphp
            @foreach(\App\Role::all() as $role)
                @php
                    $selected =   (!$role_null && $spouse_found && in_array($role->role_id,$spouse_role_in_estate_ar))||
                    ($role_null && in_array( $role->role_id,App\Role::get_roles_spouse_default()) ) ? 'selected="selected"' : ''
                @endphp
                <option id="spouse_role_in_estate_{{ $role->role_id }}" value="{{ $role->role_id }}" {{$selected}}
                >{{ $role->role_name }}</option>
            @endforeach
            {{--@php
            $roles_array_values = array_values($roles_obj->get_roles());
            foreach ($roles_obj->get_roles() as $k => $v) {

                $spouse_role_in_estate_ar = explode('|',$spouse_found->member_role_in_estate);

                $role_null = $spouse_found->member_role_in_estate == "" &&  $spouse_found->member_first_name == '';
                $disabled = $k == 0 ? 'disabled="disabled"': '';
                @endphp
                <option id="spouse_role_in_estate_{{ $k }}" value="{{ $k }}"
                {{$disabled}}    {{ !$role_null && $spouse_found && in_array($k,$spouse_role_in_estate_ar) ? 'selected="selected"' : '' }}
                    {{ $role_null && in_array($k,$roles_obj->get_roles_spouse_default())  ? 'selected="selected"' : '' }}
                >{{ $v }}</option>
            @php } @endphp--}}
        </select>

    </div>
    <div id="maritalStatus-phone">
        <label for="spouse_phone">Phone</label>
        <input type="text" class="form-control phone_us" id="spouse_phone" placeholder="Phone"
               value="{{ $spouse_found ? $spouse_found->member_phone :''  }}">
    </div>
    <div id="maritalStatus-bday">
        <label for="spouse_birth_day">Birthdate</label>
        <input type="text" class="white form-control" id="spouse_birth_day"
               value="{{ $spouse_found && $spouse_found->member_birth_day ? date('m/d/Y',strtotime($spouse_found->member_birth_day)) :''  }}">
    </div>
    <div id="maritalStatus-anniversary">
        <label for="spouse_anniversary">Anniversary Date</label>
        <input type="text" class="white form-control" id="spouse_anniversary"
               value="{{ $spouse_found && $spouse_found->member_anniversary ? date('m/d/Y',strtotime($spouse_found->member_anniversary)) :''  }}">
    </div>
    <div id="maritalStatus-docs">
        <label for="spouse_docs">View/Add Documents</label>
        <a class="btn btn-primary btn-size document_tabs_open rounded_5_button"
           data-document-category="2"
           data-document-category-sub="4"
           data-document-category-sub-sub="0"

        >Documents</a>
    </div>
    <div id="maritalStatus-notes">
        <label for="spouse_special_notes">Special Notes</label>
        <textarea class="form-control maritalStatusNotes" name="" id="spouse_special_notes" rows="4"
                  placeholder="Special Notes...">{{ $spouse_found ? $spouse_found->member_special_notes :''  }}</textarea>
    </div>
    <div id="maritalStatus-submitBtn">
        <a id="btnChange-maritalStatus" type="submit" class="btn btn-primary btn-sm disabled rounded_5_button"
        >Update</a>
    </div>


     @php
     use App\Member;$members_user_account = $spouse_found ? $spouse_found->member_user_account($spouse_found) : false;//$member_obj->members_user_account($spouse_found);
     $invite_class = $spouse_found && $spouse_found->member_has_email($spouse_found) ?'':'disabled_invite'; //$member_obj->member_has_email($spouse_found) ?'':'disabled_invite';

     @endphp
     <div id="maritalStatus-inviteBtn" class="content_box" data-member-member-id="{{$spouse_found && $spouse_found->member_id ? $spouse_found->member_id: 0 }}">
         @php $display_invite = $spouse_found && $spouse_found->member_first_name && !$members_user_account ? 'display:block' : 'display:none;' @endphp

             <a id="btnChange-maritalStatusInvite" type="button" class="btn btn-default btn-sm rounded_5_button invite_member_open {{$invite_class}}"
                style="{{ $display_invite }}"
             >Invite</a>
     </div>


        <div id="maritalStatus-inviteStatus">
            @if ($members_user_account)
                <div id="maritalStatusInviteStatusContainer" class="message_member_open"
                     data-href="{{ route('estate_messages')}}&message_user_id_trigger={{ $members_user_account }}"
                     data-toggle="tooltip" title="Message" style="cursor: pointer;">
                    <i class="far fa-comment-dots" style="font-size: 30px;margin-top: 15px"></i>
                </div>
            @elseif($spouse_found && $spouse_found->member_first_name && $spouse_found->member_invitation_status > 0)
                <a id="maritalStatusInviteStatusContainer" style="{{ $display_invite }};padding-top: 13px;
                        color: {{ $members_user_account && $spouse_found->member_invitation_status != 4 ? 'green' : 'red' }}"
                >{{ $spouse_found->get_member_invitation_status_text($spouse_found) }}</a>
            @endif
        </div>



    <a class="cancel cancel_button_set" id="maritalStatus-closeBtn" style="display: none" data-dismiss="modal">Close</a>

</form>