@php
//include '../../../../lib/includes/header_include.php';
$emergency_contact = null ; //array();
//$member_obj = new MemberModel();
//$emergency_contact_member_id = isset($_POST->member_member_id) && trim($_POST->member_member_id) != '' ? $database->escape_string($_POST->member_member_id) : 0;
$emergency_contact_member_id = \Illuminate\Support\Facades\Input::get('member_member_id');
if ($emergency_contact_member_id) {
    $emergency_contact = \App\EmergencyContact::find($emergency_contact_member_id);//$member_obj->get_member_by_id($emergency_contact_member_id);
}

@endphp
<style>
    .fa-link {
        color: rgb(57, 122, 242);;
    }

    .emergency_contactNotes {
        resize: none;
    }

    .caret {
        display: none;
    }

    .custom-control-label::before {
        background-color: white;
    }

    .image-upload > input {
        display: none;
    }

    #form-emergency_contacts {
        display: grid;
        /* grid-template-columns: repeat(4 1fr); */
        grid-template-columns: 1fr 1fr 2fr 2fr 2fr;
        grid-gap: 10px;
        grid-template-areas: "header header header header header" "pic gender fName lName lName" "email email email phone phone" /* "bday bday anniversary role" */ "notes notes notes notes docs" "btn btn invite inviteStatus close";
    }

    #emergency_contact-header {
        grid-area: header;
        padding: 0;
    }

    #emergency_contact-pic {
        grid-area: pic;
        cursor: pointer;
    }

    #emergency_contact-gender {
        grid-area: gender;
        /* width: 30%; */
    }

    #emergency_contact-fName {
        grid-area: fName;

    }

    #emergency_contact-lName {
        grid-area: lName;
    }

    #emergency_contact-email {
        grid-area: email;
    }

    #emergency_contact-phone {
        grid-area: phone;
    }

    /* #emergency_contact-anniversary{
      grid-area: anniversary;
    }
    #emergency_contact-bday{
      grid-area: bday;
    }
    #emergency_contact-role{
      grid-area: role;
    } */
    #emergency_contact-docs {
        grid-area: docs;
    }

    #emergency_contact-notes {
        grid-area: notes;
        height: 274px;
    }

    #emergency_contact-submitBtn {
        grid-area: btn;
    }

    #emergency_contact-closeBtn {
        grid-area: close;
    }

    #emergency_contacts-nextSubmitBtn {
        grid-area: next;
    }

    #emergency_contact-inviteBtn {
        grid-area: invite;
    }

    #emergency_contact-inviteStatus {
        grid-area: inviteStatus;
    }
</style>

<form id="form-emergency_contacts">
    <h3 id="emergency_contact-header">Emergency Contact</h3>
    <div id="emergency_contact-pic" class="image-upload">
        <input id="emergency_contact_picture" name="emergency_contact_picture" type="file"/>
        <label for="emergency_contact_picture">
            <!-- <img src="../img/defaultAvatar.jpeg"  class="img-thumbnail
            emergency_contact-img" style="height:75px;width:auto;" alt=""> -->

            <div class="img__wrap">
                @php
                //$emergency_contact_found_image = $emergency_contact && trim($emergency_contact->member_image) != '' ? SITE_BASE_URL . MEMBER_IMG_FOLDER . '/' . $emergency_contact->member_image . '?rand=' . rand(1, 1000) : '../img/defaultAvatar.jpeg';
                $emergency_contact_found_image = $emergency_contact && trim($emergency_contact->member_image) != '' ? ($emergency_contact->member_is_dependent($emergency_contact) ? Config::get('constants.DEPENDENT_PROFILE_IMG_URL') . $emergency_contact->member_image . '?rand=' . rand(1, 1000) : Config::get('constants.MEMBER_IMG_URL') . $emergency_contact->member_image . '?rand=' . rand(1, 1000)) : Config::get('constants.DEFAULT_AVATAR_IMAGE_URL');

                @endphp
                <img class="img__img img-thumbnail emergency_contact_image_img"
                     src="{{ $emergency_contact_found_image }}"
                     id="emergency_contact_image_img"
                     style="height:75px;width:auto;" alt="">
                <i id="loading" style="display:none" class="ace-icon fa fa-spinner"></i>

                <div class="img__description_layer">
                    <p class="img__description"><i
                                class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br> Click to Change
                        Photo</p>
                </div>
            </div>
            <!-- <span class="emergency_contact-topLeft"><i class="fas fa-plus-circle add_field_button_phone green-text "></i> Add Photo</span> -->
        </label>
    </div>
    <div id="emergency_contact-gender">
        @php
        $rand = rand(1, 50000);
        @endphp
        <div class="custom-control custom-radio custom-control-inline xmt-3 pl-0">
            <input type="radio" id="emergency_contact_genderMale{{ $rand }}" name="emergency_contact_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0"
                   value="Male" {{ $emergency_contact && $emergency_contact->member_gender == 'Male' ? 'checked="checked"' : '' }}>
            <label class="xcustom-control-label form-check-label pl-4"
                   for="emergency_contact_genderMale{{ $rand }}">Male</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline pl-0">
            <input type="radio" id="emergency_contact_genderFemale{{ $rand }}" name="emergency_contact_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0"
                   value="Female" {{ $emergency_contact && $emergency_contact->member_gender == 'Female' ? 'checked="checked"' : '' }} >
            <label class="xcustom-control-label form-check-label pl-4"
                   for="emergency_contact_genderFemale{{ $rand }}">Female</label>
        </div>
    </div>
    <div id="emergency_contact-fName">
        <input type="hidden" class="form-control" id="emergency_contact_member_id"
               value="{{ $emergency_contact ? $emergency_contact->member_id : '' }}">
        <label for="emergency_contact_first_name">First Name</label>
        <input type="text" class="form-control" id="emergency_contact_first_name" placeholder="First name"
               value="{{ $emergency_contact ? $emergency_contact->member_first_name : '' }}">
    </div>
    <div id="emergency_contact-lName">
        <label for="emergency_contact_last_name">Last Name</label>
        <input type="text" class="form-control" id="emergency_contact_last_name" placeholder="Last name"
               value="{{ $emergency_contact ? $emergency_contact->member_last_name : '' }}">
    </div>

    <div id="emergency_contact-email">
        <label for="emergency_contact_email">Email</label>
        <input type="email" class="form-control white xgrey-text member_email" id="emergency_contact_email" placeholder="Email"
               value="{{ $emergency_contact ? $emergency_contact->member_email : '' }}">
    </div>
    <div id="emergency_contact-phone">
        <label for="emergency_contact_phone">Phone</label>
        <input type="text" class="form-control phone_us" id="emergency_contact_phone" placeholder="Phone"
               value="{{ $emergency_contact ? $emergency_contact->member_phone : '' }}">
    </div>

    <!-- <div id="emergency_contact-bday">
      <label for="birthday-emergency_contact-id1">Birthdate</label>
      <input type="text" class="form-control datepicker white" id="birthday-emergency_contact-id1">
    </div>
    <div id="emergency_contact-anniversary">
      <label for="anniverary-dependent-id1">Anniversary Date</label>
      <input type="text" class="form-control datepicker white" id="anniverary-dependent-id1">
    </div>
    <div id="emergency_contact-role">
      <label for="roleOfspouse" class= "pr-1">Role In Your Estate</label>
      <select class="mdb-select" multiple data-actions-box="true">
        <option value="" selected disabled>No Role</option>
        <option value="Executor" id="checkbox-executor" value="1" onClick="ckChange(this)">Executor</option>
        <option value="Trustee" id="checkbox-trustee" value="1" onClick="ckChange(this)">Trustee</option>
        <option value="Co-Trustee" id="checkbox-coTrustee" value="1" onClick="ckChange(this)" selected>Co-Trustee</option>
        <option value="emergencyContacts" id="checkbox-emergencyContacts" value="1" onClick="ckChange(this)">emergencyContacts</option>
        <option value="Successors-Trustee" id="checkbox-successorsTrustee" value="1" onClick="ckChange(this)">Successors Trustee</option>
        <option value="Legal-Guaridan" id="checkbox-legalGuardian" value="1" onClick="ckChange(this)">Legal Guaridan</option>
      </select>
    </div> -->
    <div id="emergency_contact-docs">
        <label for="emergency_contactDocs">View/Add Documents</label>
        <!--        <a class="btn btn-primary btn-size" data-toggle="modal" data-target="#emergencyContactsDocsID1">Documents</a>
        --> <a class="btn btn-primary btn-size document_tabs_open rounded_5_button"
               data-document-category="1"
               data-document-category-sub="3"
               data-document-category-sub-sub="{{$emergency_contact ? $emergency_contact->member_id:0}}"
        >Documents</a>

    </div>
    <div id="emergency_contact-notes">
        <label for="emergency_contact_special_notes">Notes/Wishes</label>
        <textarea class="form-control emergency_contactNotes" name="" id="emergency_contact_special_notes" rows="4"
                  placeholder="Notes for contact...">{{ $emergency_contact ? $emergency_contact->member_special_notes : '' }}</textarea>
    </div>
    <div id="emergency_contact-submitBtn">
        <a id="btnChange-emergency_contacts" type="submit" class="btn btn-primary btn-sm disabled rounded_5_button">Update</a>
    </div>
    @php
use App\Member;$members_user_account = $emergency_contact->member_user_account($emergency_contact);
       $invite_class = $emergency_contact->member_has_email($emergency_contact) ?'':'disabled_invite';
    @endphp
    <div id="emergency_contact-inviteBtn" class="content_box"
         data-member-member-id="{{ $emergency_contact && $emergency_contact->member_id ? $emergency_contact->member_id : 0 }}">
        @php $display_invite = $emergency_contact  && !$members_user_account ? 'display:block;' : 'display:none;' @endphp
        <a id="btnChangeemergency_contactInvite" type="button" style="{{ $display_invite }}"
           class="btn btn-default btn-sm rounded_5_button invite_member_open {{$invite_class}}"
        >Invite</a>
    </div>
    <div id="emergency_contact-inviteStatus">
        @if ($members_user_account)
                <div id="emergency_contactNewInviteStatus" class="message_member_open"
                     data-href="{{ route('estate_message') }}&message_user_id_trigger={{ $members_user_account }}"
                     data-toggle="tooltip" title="Message" style="cursor: pointer;">
                    <i class="far fa-comment-dots" style="font-size: 30px;margin-top: 15px"></i>
                </div>
            @elseif($emergency_contact->member_invitation_status > 0)
                <a id="emergency_contactNewInviteStatus" style="{{ $display_invite }};padding-top: 13px;
                        color: {{ $members_user_account && $emergency_contact->member_invitation_status != 4 ? 'green' : 'red' }}"
                >{{ $emergency_contact->get_member_invitation_status_text($emergency_contact) }}</a>
            @endif
    </div>
    <div id="emergency_contact-closeBtn">
        <button class="btn btn-secondary btn-sm rounded_5_button cancel_button_set" id="emergency_contact-closeBtn" data-dismiss="modal">Close</button>
    </div>

    <!-- <div id="emergency_contacts-nextSubmitBtn">
      <a id="btnChangeNext-emergency_contacts" class="btn btn-primary btn-sm float-right tab-link"  href="#myFamily-beneficiaries-form" type="submit">Next</a>
  </div> -->
</form>


