@php
    // include dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/project/lib/includes/header_include.php';
    // = array();
    // $member_obj = new MemberModel();
    
    //$friend_member_id = isset($_POST->member_member_id) && trim($_POST->member_member_id) != '' ? $database->escape_string($_POST->member_member_id) : 0;
    //if($friend_member_id){
        $friend = \App\Friend::find(\Illuminate\Support\Facades\Input::get('member_member_id')); //$member_obj->get_member_by_id($friend_member_id);
    //}

@endphp
<style>
    .fa-link {
        color: rgb(57, 122, 242);;
    }

    .friendNotes {
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

    #form-friendsKID {
        display: grid;
        /* grid-template-columns: repeat(4 1fr); */
        grid-template-columns: 1fr 1fr 1fr 1fr 2fr 2fr;
        grid-gap: 10px;
        grid-template-areas: "header header header header header header" "pic gender fName fName lName lName" "bday bday bday bday email phone" /* "bday bday anniversary role" */ "notes notes notes notes notes docs" "btn btn invite inviteStatus inviteStatus  close";
    }

    #friend-header {
        grid-area: header;
        padding: 0;
    }

    #friend-pic {
        grid-area: pic;
        cursor: pointer;
    }

    #friend-gender {
        grid-area: gender;
        /* width: 30%; */
    }

    #friend-fName {
        grid-area: fName;

    }

    #friend-lName {
        grid-area: lName;
    }

    #friend-email {
        grid-area: email;
    }

    #friend-phone {
        grid-area: phone;
    }

    /* #friend-anniversary{
      grid-area: anniversary;
    }
    #friend-bday{
      grid-area: bday;
    }
    #friend-role{
      grid-area: role;
    } */
    /*  #friend-docs{
          grid-area: docs;
      }
      #friend-notes{
          grid-area: notes;
          height: 274px;
      }*/

    #friend-submitBtn {
        grid-area: btn;
    }

    #friend-inviteBtn {
        grid-area: invite;
    }

    #friend-inviteStatusBtn {
        grid-area: inviteStatus;
    }

    #friend-closeBtn {
        grid-area: close;
    }


    #friend-bday {
        grid-area: bday;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-gap: 10px;
        grid-template-areas: "month day age";
    }

    #friend-bday-month {
        grid-area: month;
    }

    #friend-bday-day {
        grid-area: day;
    }

    #friend-bday-age {
        grid-area: age;
    }
</style>

<form id="form-friendsKID">
    <h3 id="friend-header">My Friend's Contact Info</h3>
    <div id="friend-pic" class="image-upload">
        <input id="friend_picture" name="friend_picture" type="file" class="change_trigger_disabled"/>
        <label for="friend_picture">
            <!-- <img src="../img/defaultAvatar.jpeg"  class="img-thumbnail
            friend-img" style="height:75px;width:auto;" alt=""> -->

            <div class="img__wrap">
                @php
                    $friend_found_image = $friend && trim($friend->member_image) != '' ? Config::get('constants.SITE_BASE_URL') . Config::get('constants.MEMBER_IMG_FOLDER') . '/' . $friend->member_image . '?rand=' . rand(1, 1000) :Config::get('constants.DEFAULT_AVATAR_IMAGE_URL');
                @endphp
                <img class="img__img img-thumbnail friend_image_img"
                     src="{{$friend_found_image}}"
                     id="friend_image_img"
                     style="height:75px;width:auto;" alt="">
                <i id="loading" style="display:none" class="ace-icon fa fa-spinner"></i>

                <div class="img__description_layer">
                    <p class="img__description"><i
                                class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br> Click to Change
                        Photo</p>
                </div>
            </div>
            <!-- <span class="friend-topLeft"><i class="fas fa-plus-circle add_field_button_phone green-text "></i> Add Photo</span> -->
        </label>
    </div>
    <div id="friend-gender">
        @php
            $rand = rand(1,50000);
        @endphp
        <div class="custom-control custom-radio custom-control-inline xmt-3 pl-0">
            <input type="radio" id="friend_genderMale{{ $rand }}" name="friend_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0"
                   value="Male" {{ $friend && $friend->member_gender == 'Male' ? 'checked="checked"' : '' }}>
            <label class="xcustom-control-label form-check-label pl-4"
                   for="friend_genderMale{{ $rand }}">Male</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline pl-0">
            <input type="radio" id="friend_genderFemale{{ $rand }}" name="friend_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0"
                   value="Female" {{ $friend && $friend->member_gender == 'Female' ? 'checked="checked"' : '' }} >
            <label class="xcustom-control-label form-check-label pl-4"
                   for="friend_genderFemale{{ $rand }}">Female</label>
        </div>
    </div>
    <div id="friend-fName">
        <input type="hidden" class="form-control" id="friend_member_id" value="{{$friend ?$friend->member_id:''}}">
        <label for="friend_first_name">First Name</label>
        <input type="text" class="form-control" id="friend_first_name" placeholder="First name"
               value="{{$friend ? $friend->member_first_name :'' }}">
    </div>
    <div id="friend-lName">
        <label for="friend_last_name">Last Name</label>
        <input type="text" class="form-control" id="friend_last_name" placeholder="Last name"
               value="{{$friend ? $friend->member_last_name :'' }}">
    </div>

    <div id="friend-bday">
        @php
            $friend_birth_day_set = $friend && $friend->member_age ? json_decode($friend->member_age):NULL;

        @endphp
        <div id="friend-bday-month">
            <label for="friendBdayField_month">Month</label>


            <select id="friendBdayField_month" class="browser-default custom-select">
                <option value="">Select</option>
                @for($x = 1 ; $x <= 12 ; $x++)
                    @php  $monthNum  = $x;
                    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                    $monthName = $dateObj->format('F'); // March
                    $selected = $friend_birth_day_set && $friend_birth_day_set->m == $monthNum ? 'selected="selected"'  :'';
                    @endphp
                    <option value="{{$monthNum}}" {{$selected}}>{{$monthName}}</option>
                @endfor
            </select>
        </div>
        <div id="friend-bday-day">
            <label for="friendBdayField_day">Day</label>
            <input id="friendBdayField_day" type="text"
                   value="{{ $friend_birth_day_set ? $friend_birth_day_set->d : '' }}"
                   class="form-control">
        </div>
        <div id="friend-bday-age">
            <label for="friendBdayField_age">Age</label>
            <input id="friendBdayField_age" type="text"
                   value="{{ $friend && $friend->member_birth_day ? App\Helpers\Helper::get_age_years(date('Y-m-d', strtotime($friend->member_birth_day))) : '' }}"
                   class="form-control">
        </div>
    </div>

    <div id="friend-email">
        <label for="friend_email">Email</label>
        <input type="email" class="form-control white xgrey-text member_email" id="friend_email" placeholder="Email"
               value="{{$friend ? $friend->member_email :'' }}">
    </div>


    <div id="friend-phone">
        <label for="friend_phone">Phone</label>
        <input type="text" class="form-control phone_us" id="friend_phone" placeholder="Phone"
               value="{{$friend ? $friend->member_phone :'' }}">
    </div>


    <div id="friend-submitBtn">
        <a id="btnChange-friends" type="submit" class="btn btn-primary btn-sm disabled">Update</a>
    </div>


    {{--@php
        $members_user_account = $member_obj->members_user_account($friend);
        $invite_class = $member_obj->member_has_email($friend) ?'':'disabled_invite';
    @endphp--}}
    @php
        use App\Member;$members_user_account = $friend ? $friend->member_user_account($friend) : false;//$member_obj->members_user_account($spouse_found);
        $invite_class = $friend && $friend->member_has_email($friend) ?'':'disabled_invite'; //$member_obj->member_has_email($spouse_found) ?'':'disabled_invite';

    @endphp

    <div id="friend-inviteBtn" class="content_box"
         data-member-member-id="{{ $friend && $friend->member_id ? $friend->member_id : 0 }}">
        @php $display_invite = $friend  && !$members_user_account ? 'display:block' : 'display:none;' @endphp
        <a id="btnChangeFriendNewInvite" type="button" style="{{ $display_invite }}"
           class="btn btn-default btn-sm rounded_5_button invite_member_open {{$invite_class}}"
        >Invite</a>
    </div>
    <div id="friend-inviteStatusBtn">
        @if ($members_user_account)
            <div id="friendNewInviteStatusContainer" class="message_member_open"
                 data-href="{{ auth()->user()->user_access == 1 ? route('kid_messages'):route('estate_index')}}&message_user_id_trigger={{ $members_user_account }}"
                 data-toggle="tooltip" title="Message" style="cursor: pointer;">
                <i class="far fa-comment-dots" style="font-size: 30px;margin-top: 15px"></i>
            </div>
        @elseif($friend && $friend->member_invitation_status > 0)
            <a id="friendNewInviteStatusContainer" style="{{ $display_invite }};padding-top: 13px;
                    color: {{ $members_user_account && $friend->member_invitation_status != 4 ? 'green' : 'red' }}"
            >{{ $friend->get_member_invitation_status_text($friend) }}</a>
        @endif
    </div>
    <div id="friend-closeBtn">
        <a class="cancel cancel_button_set" data-dismiss="modal">Close</a>
    </div>
</form>


