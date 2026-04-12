@php
// include dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/project/lib/includes/header_include.php';
// $profile_obj = new ProfileModel();

// $userId = $_SESSION->loggedInUser;
$profile_found = auth()->user()->profile ; // $profile_obj->get_profile_by_profile_user_id($userId);


@endphp
<style>
    .profileNotes {
        resize: none;
    }

    .custom-control-label::before {
        background-color: white;
    }

    .img-thumbnail {
        cursor: pointer;
    }

    #form-profileKID {
        display: grid;
        grid-template-columns: 1fr 1fr 2fr 2fr 2fr;
        grid-gap: 10px;
        grid-template-areas: "header header header header header" "pic gender fName lName lName" "email email email phone phone2" "bday bday bday nickName nickName" "btn btn btn btn cancel";
    }

    #profile-header {
        grid-area: header;
        padding: 0;
    }

    #profile-pic {
        grid-area: pic;
    }

    #profile-gender {
        grid-area: gender;
    }

    #profile-fName {
        grid-area: fName;
    }

    #profile-lName {
        grid-area: lName;
    }

    #profile-email {
        grid-area: email;
    }

    #profile-phone {
        grid-area: phone;
    }

    #profile-phone2 {
        grid-area: phone2;
    }

    /*#profile-bday {
        grid-area: bday;
    }*/

    #profile-bday {
        grid-area: bday;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-gap: 10px;
        grid-template-areas:"month day age";
    }

    #profile-bday-month{
        grid-area: month;
    }

    #profile-bday-day{
        grid-area: day;
    }

    #profile-bday-age{
        grid-area: age;
    }

    #profile-maritalStatus {
        grid-area: maritalStatus;
    }

    #profile-docs {
        grid-area: docs;
    }

    #profile-numOfDependents {
        grid-area: numOfDependents;
    }

    #profile-nickName {
        grid-area: nickName;
        height: 174px;
    }

    /* #profile-ethnicity {
         grid-area: ethnicity;
         height: 174px;
     }*/

    #profile-notes {
        grid-area: notes;
    }

    #profile-submitBtn {
        grid-area: btn;
    }

    #profile-closeBtn {
        grid-area: cancel;
        justify-self: end;
        align-self: end;
    }
</style>
<span id="profile_error_message"></span>
<form id="form-profileKID" autocomplete="off">
    <h3 id="profile-header">My Profile</h3>

    <div id="profile-pic" class="image-upload">
        <input id="profile_kid_picture" type="file" name="profile_kid_picture" class="change_trigger_disabled"/>
        <label for="profile_kid_picture">
            <div class="img__wrap">
                @php
                $profile_found_image = $profile_found && trim($profile_found->profile_image) != '' ? Config::get('constants.SITE_BASE_URL') . Config::get('constants.PROFILE_IMG_FOLDER') . '/' . $profile_found->profile_image . '?rand=' . rand(1, 1000) : Config::get('constants.PROJECT_IMAGE_URL').'generic_person.png';
                @endphp
                <img class="img__img img-thumbnail profile_image_image" src="{{ $profile_found_image }}"
                     id="profile_image_image"
                     style="height:75px;width:auto;" alt="">

                <div class="img__description_layer">
                    <p class="img__description"><i
                                class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br> Click to change
                        photo</p>
                </div>
            </div>
        </label>
    </div>
    <div id="profile-gender">
        <div class="custom-control custom-radio custom-control-inline xmt-3 pl-0">
            @php $rand = rand(1, 50000) @endphp
            <input type="radio" id="Male-profile{{ $rand }}" name="userGender"
                   class="xcustom-control-input form-check-input with-gap mr-0 Male-profile"
                   value="Male" {{ $profile_found && $profile_found->profile_gender == 'Male' ? 'checked="checked"' : '' }}>
            <label class="xcustom-control-label form-check-label pl-4" for="Male-profile{{ $rand }}">Male</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline pl-0">
            <input type="radio" id="Female-profile{{ $rand }}" name="userGender"
                   class="xcustom-control-input form-check-input with-gap mr-0 Female-profile"
                   value="Female" {{ $profile_found && $profile_found->profile_gender == 'Female' ? 'checked="checked"' : '' }}>
            <label class="xcustom-control-label form-check-label pl-4" for="Female-profile{{ $rand }}">Female</label>
        </div>
        <!-- <div class="custom-control custom-radio custom-control-inline pl-0">
            <input type="radio" id="Other-profile{{ $rand }}" name="userGender"
                   class="xcustom-control-input form-check-input  with-gap mr-0 Other-profile"
                   value="Other" {{ $profile_found && $profile_found->profile_gender == 'Other' ? 'checked="checked"' : '' }}>
            <label class="xcustom-control-label form-check-label pl-4" for="Other-profile{{ $rand }}">Other</label>
        </div> -->
    </div>
    <div id="profile-fName">
        <input type="hidden" name="profile_id" id="profile_id"
               value="{{ $profile_found ? $profile_found->profile_id : '' }}">
        <label for="profileFName">First Name</label>
        <input type="text" class="form-control" id="profileFName" placeholder="First name"
               value="{{ $profile_found && trim($profile_found->profile_first_name) != '' ? $profile_found->profile_first_name : $_SESSION->first_name }}">
    </div>
    <div id="profile-lName">
        <label for="profileLName">Last Name</label>
        <input type="text" class="form-control" id="profileLName" placeholder="Last name"
               value="{{ $profile_found && trim($profile_found->profile_last_name) != '' ? $profile_found->profile_last_name : $_SESSION->last_name }}">
    </div>
    <div id="profile-email">
        <label for="profileEmail">Email
            <small> (see settings <i class="fas fa-cog fa-lg cogColor"></i> top corner to change)</small>
        </label>
        <input type="email" class="form-control white xgrey-text profileEmail"
               placeholder="Email" id="profile_email" readonly="readonly"
               value="{{ $profile_found && $profile_found->profile_email != '' ? $profile_found->profile_email : $_SESSION->user_email }}">
    </div>
    <div id="profile-phone">
        <label for="profilePhone">Phone</label>
        <input type="text" class="form-control phone_us" id="profilePhone" placeholder="Phone"
               value="{{ $profile_found ? $profile_found->profile_phone : '' }}">
    </div>
    <div id="profile-phone2">
        <label for="profilePhone2">Alternate Phone</label>
        <input type="text" class="form-control phone_us" id="profilePhone2" placeholder="Alternate Phone"
               value="{{ $profile_found ? $profile_found->profile_phone2 : '' }}">
    </div>
    <div id="profile-bday">
        @php
        $profile_birth_day_set = $profile_found && $profile_found->profile_age ? json_decode($profile_found->profile_age):NULL;

        @endphp
        <div id="profile-bday-month" >
            <label for="profileBdayField_month">Month</label>
            <!--<input id="profileBdayField_month" type="text"
                   value="<?/*=$profile_birth_day_set ?$profile_birth_day_set->m  : '' */@endphp"
                   class="form-control" >-->
            <select id="profileBdayField_month" class="browser-default custom-select" >
                <option value="">Select</option>
                @for($x = 1 ; $x <= 12 ; $x++)
                   @php
                    $monthNum  = $x;
                    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                    $monthName = $dateObj->format('F'); // March
                    $selected = $profile_birth_day_set && $profile_birth_day_set->m == $monthNum ? 'selected="selected"'  :'';
                    @endphp
                    <option value="{{$monthNum}}"  {{$selected}}>{{$monthName}}</option>
                @endfor
            </select>
        </div>
        <div id="profile-bday-day">
            <label for="profileBdayField_day">Day</label>
            <input id="profileBdayField_day" type="text"
                   value="{{ $profile_birth_day_set ? $profile_birth_day_set->d : '' }}"
                   class="form-control" >
        </div>
        <div id="profile-bday-age">
            <label for="profileBdayField_age">Age</label>
            <input id="profileBdayField_age" type="text"
                   value="{{ $profile_found && $profile_found->profile_birth_day ? App\Helpers\Helper::get_age_years(date('Y-m-d', strtotime($profile_found->profile_birth_day))) : '' }}"
                   class="form-control" >
        </div>
    </div>

    <div id="profile-nickName">
        <label for="profileNickName">Nick Name</label>
        <input type="text" class="form-control" id="profileNickName" placeholder="Nick name"
               value="{{ $profile_found ? ($profile_found->profile_nickName == '') ? $profile_found->profile_first_name : $profile_found->profile_nickName : '' }}">
    </div>

    <div id="profile-submitBtn">
        <a id="btnChange-KIDprofile" name="submit" type="submit"
           class="btn btn-primary btn-sm">
            Update
        </a>
    </div>
    @php if (isset($next_hidden) && !$next_hidden) { @endphp
        <div id="profile-nextSubmitBtn">
            <a id="btnChangeNext-KIDprofile" class="btn btn-primary btn-sm float-right" type="submit"
               xvalue="non_active">Next</a>
        </div>
    @php } @endphp
    <a class="cancel modal_close" id="profile-closeBtn" style="display: none">Cancel</a>

</form>

