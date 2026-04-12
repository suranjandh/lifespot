@php
//include dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/project/lib/includes/header_include.php';
//$profile_obj = new ProfileModel();

//$userId = $_SESSION->loggedInUser;
//$profile_found = $profile_obj->get_profile_by_profile_user_id($userId);

//if($session_class->is_kid()){
//    $next_hidden = true ;
//    include '../../../../kid/MyProfile/AboutMe/Profile/profilesKID.php';
//    die();
//}
$profile_found = auth()->user()->profile;
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

    #form-profile {
        display: grid;
        grid-template-columns: 1fr 1fr 2fr 2fr 2fr;
        grid-gap: 10px;
        grid-template-areas: "header header header header header" "pic gender fName lName lName" "email email email phone phone2" "bday bday maritalStatus numOfDependents docs" "nickName nickName notes notes notes" "btn btn btn btn cancel";
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

    #profile-bday {
        grid-area: bday;
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
<form id="form-profile" autocomplete="off" >
    <h3 id="profile-header">My Profile</h3>

    <div id="profile-pic" class="image-upload">
        <input id="profile_picture" type="file" name="profile_picture" class="change_trigger_disabled"/>
        <label for="profile_picture">
            <div class="img__wrap">
                @php
                $profile_found_image = $profile_found && trim($profile_found->profile_image) != '' ? Config::get('constants.SITE_BASE_URL') . Config::get('constants.PROFILE_IMG_FOLDER') . '/' . $profile_found->profile_image . '?rand=' . rand(1, 1000) : Config::get('constants.PROJECT_IMAGE_URL').'generic_person.png';
                @endphp
                <img class="img__img img-thumbnail profile_image_img" src="{{$profile_found_image}}" id="profile_image_img"
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
            @php $rand = rand(1,50000) @endphp
            <input type="radio" id="Male-profile{{$rand}}" name="userGender"
                   class="xcustom-control-input form-check-input with-gap mr-0 Male-profile"
                   value="Male" {{ $profile_found && $profile_found->profile_gender == 'Male' ? 'checked="checked"' : '' }}>
            <label class="xcustom-control-label form-check-label pl-4" for="Male-profile{{$rand}}">Male</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline pl-0">
            <input type="radio" id="Female-profile{{$rand}}" name="userGender"
                   class="xcustom-control-input form-check-input with-gap mr-0 Female-profile"
                   value="Female"  {{ $profile_found && $profile_found->profile_gender == 'Female' ? 'checked="checked"' : '' }}>
            <label class="xcustom-control-label form-check-label pl-4" for="Female-profile{{$rand}}">Female</label>
        </div>

    </div>
    <div id="profile-fName">
        <input type="hidden" name="profile_id" id="profile_id" value="{{ $profile_found ? $profile_found->profile_id : '' }}">
        <label for="profileFName">First Name</label>
        <input type="text" class="form-control" id="profileFName" placeholder="First name"
               value="{{ $profile_found && trim($profile_found->profile_first_name) != '' ? $profile_found->profile_first_name : auth()->user()->first_name  }}">
    </div>
    <div id="profile-lName">
        <label for="profileLName">Last Name</label>
        <input type="text" class="form-control" id="profileLName" placeholder="Last name"
               value="{{ $profile_found && trim($profile_found->profile_last_name) != '' ? $profile_found->profile_last_name :  auth()->user()->last_name  }}">
    </div>
    <div id="profile-email">
        <label for="profileEmail">Email
            <small> (see settings <i class="fas fa-cog fa-lg cogColor"></i> top corner to change)</small>
        </label>
        <input type="email" class="form-control white xgrey-text profileEmail"
               placeholder="Email" id="profile_email" readonly="readonly"
               value="{{ $profile_found && $profile_found->profile_email != ''? $profile_found->profile_email :  auth()->user()->email }}">
    </div>
    <div id="profile-phone">
        <label for="profilePhone">Phone</label>
        <input type="text" class="form-control phone_us" id="profilePhone" placeholder="Phone" value="{{ $profile_found ? $profile_found->profile_phone :''  }}">
    </div>
    <div id="profile-phone2">
        <label for="profilePhone2">Alternate Phone</label>
        <input type="text" class="form-control phone_us" id="profilePhone2" placeholder="Alternate Phone" value="{{ $profile_found ? $profile_found->profile_phone2 :''  }}">
    </div>
    <div id="profile-bday">
        <label for="profileBdayField">Birthdate</label>
        <input type="text" class="white form-control" id="profileBdayField" value="{{ $profile_found && $profile_found->profile_birth_day ? date('m/d/Y',strtotime($profile_found->profile_birth_day)) :''  }}">
    </div>
    <div id="profile-maritalStatus">
        <div class="form-group mb-0">
            <label for="profileMaritalStatus">Marital Status</label>
            <select name="profileMaritalStatus" class="mdb-select colorful-select dropdown-primary"
                    id="profileMaritalStatus">
                @php
                $marital_status_set = Helper::get_marital_status_set();
                $counter = 0 ;
                $profileMaritalStatus_options = array();
                foreach($marital_status_set as $k => $v){
                    $counter++ ;
                    if($k == 0) {$k = '';}
                    ob_start();
                    $option_number = $profile_found && trim($profile_found->profile_maritalStatus) == $k ? 0 :$counter ;

                    @endphp
                    <option value="{{$k}}" {{ $profile_found && trim($profile_found->profile_maritalStatus) == $k ? 'selected="selected"' : '' }}>{{$v}}</option>

                @php
                    $profileMaritalStatus_options[$option_number] =  ob_get_contents();
                    ob_end_clean();
                }
                ksort($profileMaritalStatus_options);
                echo implode('',$profileMaritalStatus_options);

                @endphp
            </select>
        </div>
    </div>
    <div id="profile-numOfDependents">
        <label for="profileDependents">Number of Dependents</label>
        <input type="number" min="0" class="form-control profileDependents" id="profileDependents" placeholder="" value="{{ $profile_found ? $profile_found->profile_dependents : '' }}">
    </div>
    <div id="profile-nickName">
        <label for="profileNickName">Nick Name</label>
        <input type="text" class="form-control" id="profileNickName" placeholder="Nick name" value="{{ $profile_found ? ($profile_found->profile_nickName=='')? $profile_found->profile_first_name : $profile_found->profile_nickName : '' }}">
    </div>
    <div id="profile-docs">
        <label for="profileDocs">View/Add Documents</label>
        <a class="btn btn-primary btn-size document_tabs_open"
           data-document-category="1"
           data-document-category-sub="2"
           data-document-category-sub-sub="0"

        >Documents</a>

    </div>
    <div id="profile-notes">
        <label for="profile-Notes">Notes/Wishes</label>
        <textarea class="form-control profileNotes" name="" id="profileNotes" rows="4"
                  placeholder="Notes...">{{ $profile_found ? $profile_found->profile_profile_notes : '' }}</textarea>
    </div>
    <div id="profile-submitBtn">
        <a id="btnChange-profile" name="submit" type="submit"
           class="btn btn-primary btn-sm disabled">
            Update
        </a>
    </div>
    <div id="profile-nextSubmitBtn">
        <a id="btnChangeNext-profile" class="btn btn-primary btn-sm float-right tab-link"  href="#myFamily-family-form" type="submit" xvalue="non_active">Next</a>
    </div>
    <a  class="cancel modal_close cancel_button_set" id="profile-closeBtn"  style="display: none">Close</a>

</form>

