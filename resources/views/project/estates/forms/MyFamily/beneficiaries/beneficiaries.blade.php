@php
//include '../../../../lib/includes/header_include.php';
$beneficiary = null;

//$beneficiary_member_id = isset($_POST->member_member_id) && trim($_POST->member_member_id) != '' ? $database->escape_string($_POST->member_member_id) : 0;
$beneficiary_member_id = \Illuminate\Support\Facades\Input::get('member_member_id');
if($beneficiary_member_id){
  //  $member_obj = new MemberModel();
    $beneficiary = \App\Beneficiary::find($beneficiary_member_id);//$member_obj->get_member_by_id($beneficiary_member_id);
}

@endphp
<style>

.beneficiariesNotes{
  resize:none;
}
.beneficiary-img{
  /* width: 100%;
  height: auto; */
  /* opacity: 0.3; */
  /* cursor: pointer; */
}
/* .beneficiary-topLeft{
  position: absolute;
  top: 4px;
  left: 6px;
  font-size: 10px;
  font-weight: 500;
  cursor: pointer;
} */

/* .beneficiary-topLeft:hover{
  position: absolute;
  top: 4px;
  left: 6px;
  font-size: 10px;
  font-weight: 500;
  cursor: pointer;
  color: white;
  content: "change photo";
} */
#form-beneficiaries{
  display:grid;
  /* grid-template-columns: repeat(5 1fr); */
  grid-template-columns: 1fr 1fr 2fr 2fr 2fr;
  grid-gap: 10px;
  grid-template-areas:
  "header header header header header"
  "pic gender fName lName lName"
  "email email email phone phone"
  /* "bday bday maritalStatus anniversary docs" */
  "bday bday anniversary . docs"
  "notes notes notes notes notes"
  "btn  btn invite inviteStatus close"
  ;
}
#beneficiary-header{
  grid-area: header;
  padding: 0;
}

#beneficiary-pic{
  grid-area: pic;
  position: relative;
}
#beneficiary-gender{
  grid-area: gender;
  /* width: 30%; */
}
#beneficiary-fName{
  grid-area: fName;

}
#beneficiary-lName{
  grid-area: lName;
}

#beneficiary-email{
  grid-area: email;
}
#beneficiary-phone{
  grid-area: phone;
}

#beneficiary-bday{
  grid-area: bday;
}
#beneficiary-maritalStatus{
  grid-area: maritalStatus;
}
#beneficiary-anniversary{
  grid-area: anniversary;
}
#beneficiary-docs{
  grid-area: docs;
}

/*#beneficiary-gift{
  grid-area: gift;
}*/
#beneficiary-notes{
  grid-area: notes;
  height: 174px;
}

#beneficiaries-submitBtn{
  /* margin-top: -25px; */
  grid-area: btn;
}

#beneficiaryNew-inviteBtn{
    grid-area: invite;
}

#beneficiaryNew-inviteStatus{
    grid-area: inviteStatus;
}

#beneficiary-closeBtn{
    grid-area: close;
}



</style>



<form id="form-beneficiaries">
<h3 id="beneficiary-header">{{$beneficiary ? 'Beneficiary':''}}</h3>
  <div id="beneficiary-pic" class="image-upload">
    <input id="beneficiary_picture" name="beneficiary_picture" type="file"/>
    <label for="beneficiary_picture">


      <div class="img__wrap">
          @php
         // $beneficiary_found_image = $beneficiary && trim($beneficiary->member_image) != '' ? SITE_BASE_URL . MEMBER_IMG_FOLDER . '/' . $beneficiary->member_image . '?rand=' . rand(1, 1000) : '../img/defaultAvatar.jpeg';
          $beneficiary_found_image = $beneficiary && trim($beneficiary->member_image) != '' ?  ($beneficiary->member_is_dependent($beneficiary) ?Config::get('constants.DEPENDENT_PROFILE_IMG_URL').$beneficiary->member_image . '?rand=' . rand(1, 1000) :Config::get('constants.MEMBER_IMG_URL') . $beneficiary->member_image . '?rand=' . rand(1, 1000)) : Config::get('constants.DEFAULT_AVATAR_IMAGE_URL');

          @endphp
          <img class="img__img img-thumbnail beneficiary_image_img"
               src="{{$beneficiary_found_image}}"
               id="beneficiary_image_img"
               style="height:75px;width:auto;" alt="">
          <i id="loading" style="display:none" class="ace-icon fa fa-spinner"></i>

          <div class="img__description_layer">
              <p class="img__description"><i
                          class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br> Click to Change
                  Photo</p>
          </div>
      </div>
      <!-- <span class="beneficiary-topLeft"><i class="fas fa-plus-circle add_field_button_phone green-text "></i> Add Photo</span> -->
    </label>
    </div>
    <div id="beneficiary-gender">
        @php
        $rand = rand(1,50000);
        @endphp
        <div class="custom-control custom-radio custom-control-inline xmt-3 pl-0">
            <input type="radio" id="beneficiary_genderMale{{ $rand }}" name="beneficiary_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0"
                   value="Male"  {{ $beneficiary && $beneficiary->member_gender == 'Male' ? 'checked="checked"' : '' }}>
            <label class="xcustom-control-label form-check-label pl-4"
                   for="beneficiary_genderMale{{ $rand }}">Male</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline pl-0">
            <input type="radio" id="beneficiary_genderFemale{{ $rand }}" name="beneficiary_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0"
                   value="Female" {{ $beneficiary && $beneficiary->member_gender == 'Female' ? 'checked="checked"' : '' }} >
            <label class="xcustom-control-label form-check-label pl-4"
                   for="beneficiary_genderFemale{{ $rand }}">Female</label>
        </div>
    </div>
    <div id="beneficiary-fName">
        <input type="hidden" class="form-control" id="beneficiary_member_id" value="{{$beneficiary ?$beneficiary->member_id:''}}" >

        <label for="beneficiary_first_name">First Name</label>

        <input type="text" class="form-control" id="beneficiary_first_name" placeholder="First name" value="{{$beneficiary ?$beneficiary->member_first_name:''}}">
    </div>
    <div id="beneficiary-lName">
      <label for="beneficiary_last_name">Last Name</label>
      <input type="text" class="form-control" id="beneficiary_last_name" placeholder="Last name" value="{{$beneficiary ?$beneficiary->member_last_name:''}}">
    </div>

      <div id="beneficiary-email">
        <label for="beneficiary_email">Email</label>
        <input type="email" class="form-control white xgrey-text member_email" id="beneficiary_email" placeholder="Email" value="{{$beneficiary ?$beneficiary->member_email:''}}">
      </div>
      <div id="beneficiary-phone">
        <label for="beneficiary_phone">Phone</label>
        <input type="text" class="form-control phone_us" id="beneficiary_phone" placeholder="Phone" value="{{$beneficiary ?$beneficiary->member_phone:''}}">
      </div>

      <div id="beneficiary-bday">
        <label for="beneficiary_bday">Birthdate</label>
          <input type="text" class="white form-control" id="beneficiary_bday"
                 value="{{ $beneficiary && $beneficiary->member_birth_day ? date('m/d/Y', strtotime($beneficiary->member_birth_day)) : '' }}">

      </div>

      <div id="beneficiary-anniversary">
        <label for="beneficiary_anniversary">Anniversary Date</label>
          <input type="text" class="white form-control" id="beneficiary_anniversary" value="{{ $beneficiary && $beneficiary->member_anniversary ? date('m/d/Y',strtotime($beneficiary->member_anniversary)) :''  }}">

      </div>
      <div id="beneficiary-docs">
        <label for="beneficiaryDocs">View/Add Documents</label>
        <a class="btn btn-primary btn-size rounded_5_button document_tabs_open"
           data-document-category="2"
           data-document-category-sub="6"
           data-document-category-sub-sub="{{$beneficiary ? $beneficiary->member_id:0}}"
         >Documents</a>
      </div>
     <!-- <div id="beneficiary-gift">
        <label for="beneficiary_gifts">Gift</label>
        <input type="text" class="form-control" id="beneficiary_gifts" placeholder="Gift Description" value="<?/*= $beneficiary ? $beneficiary->member_gifts :'' */@endphp">
      </div>-->

      <div id="beneficiary-notes">
        <label for="beneficiary-Notes">Special Notes</label>
        <textarea class="form-control beneficiariesNotes" name="" id="beneficiary_special_notes" rows="4" placeholder="Notes for beneficiary...">{{ $beneficiary ? $beneficiary->member_special_notes :''  }}</textarea>
      </div>

      <div id="beneficiaries-submitBtn">
        <a id="btnChange-beneficiaries" type="submit" class="btn btn-primary btn-sm rounded_5_button disabled">Update</a>
      </div>


    @php
        use App\Member;$members_user_account = $beneficiary->member_user_account($beneficiary);
       $invite_class = $beneficiary->member_has_email($beneficiary) ?'':'disabled_invite';
    @endphp
    <div id="beneficiaryNew-inviteBtn" class="content_box"
         data-member-member-id="{{ $beneficiary && $beneficiary->member_id ? $beneficiary->member_id : 0 }}">
        @php $display_invite = $beneficiary &&   !$members_user_account ? 'display:block' : 'display:none;' @endphp
        <a id="btnChangeBeneficiaryNewInvite" type="button" style="{{ $display_invite }}"
           class="btn btn-default btn-sm rounded_5_button invite_member_open {{$invite_class}}"
        >Invite</a>
    </div>
    <div id="beneficiaryNew-inviteStatus">

        @if ($members_user_account)
            <div id="beneficiaryNewInviteStatusContainer" class="message_member_open"
                 data-href="{{ route('estate_message') }}&message_user_id_trigger={{ $members_user_account }}"
                 data-toggle="tooltip" title="Message" style="cursor: pointer;">
                <i class="far fa-comment-dots" style="font-size: 30px;margin-top: 15px"></i>
            </div>
        @elseif($beneficiary->member_invitation_status > 0)
            <a id="beneficiaryNewInviteStatusContainer" style="{{ $display_invite }};padding-top: 13px;
                    color: {{ $members_user_account && $beneficiary->member_invitation_status != 4 ? 'green' : 'red' }}"
            >{{ $beneficiary->get_member_invitation_status_text($beneficiary) }}</a>
        @endif
    </div>

    <div id="beneficiary-closeBtn">
        <button  class="btn btn-secondary btn-sm rounded_5_button cancel_button_set" id="beneficiary-closeBtn"  data-dismiss="modal">Close</button>
    </div>
</form>