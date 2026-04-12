@php

    //include dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/project/lib/includes/header_include.php';
    //$userId = $_SESSION->loggedInUser;

    //$content_access_obj = new ContentAccessModel();
    //$content_access_obj->


    //$estate_obj = new EstateModel();

    //$estate_found = $estate_obj->get_estate_by_estate_user_id($userId);
    $rand = rand(1,1000);
$estate_found = auth()->user()->estate ;
@endphp
<style>
    .estateNotes {
        resize: none;
    }

    #form-estate {
        display: grid;
        grid-template-columns: 1fr 1fr 2fr 1fr 1fr 2fr;
        grid-gap: 10px;
        grid-template-areas: "header header header header header header" "pic eName eName eName eName oName" "address address address address address address2" "city city city state zip docs" "homeInfo homeInfo homeInfo notes notes notes" "btn btn btn btn btn cancel";
    }

    #estate-header {
        grid-area: header;
        padding: 0;
    }

    #estate-pic {
        grid-area: pic;
    }

    #estate-gender {
        grid-area: gender;
    }

    #estate-eName {
        grid-area: eName;
    }

    #estate-oName {
        grid-area: oName;
    }

    #estate-address {
        grid-area: address;
    }

    #estate-address2 {
        grid-area: address2;
    }

    #estate-city {
        grid-area: city;
    }

    #estate-state {
        grid-area: state;
    }

    #estate-zip {
        grid-area: zip;
    }

    #estate-docs {
        grid-area: docs;
    }

    #estate-notes {
        grid-area: notes;
    }

    #estate-homeInfo {
        grid-area: homeInfo;
        height: 174px;
    }

    #estate-submitBtn {
        grid-area: btn;
    }
    #estate-nextSubmitBtn {
        /* grid-area: next; */
    }
    #estate-closeBtn {
        grid-area: cancel;
        justify-self: end;
        align-self: end;
    }
</style>
<span id="estate_error_message"></span>
<form autocomplete="off"  id="form-estate">
    <h3 id="estate-header">Estate Information</h3>

    <div id="estate-pic" class="image-upload">
        <input id="estate_picture" name="estate_picture" type="file" class="change_trigger_disabled"/>

        <label for="estate_picture">
            <div class="img__wrap">
                @php
                    $estate_found_image = $estate_found && trim($estate_found->estate_image) != '' ? Config::get('constants.SITE_BASE_URL') .Config::get('constants.ESTATE_IMG_FOLDER')  .'/'  . $estate_found->estate_image . '?rand=' . rand(1, 1000) : Config::get('constants.PROJECT_IMAGE_URL'). 'generic_Defaultfamily.png';
                @endphp
                <img class="img__img img-thumbnail estate_image_image" src="{{$estate_found_image}}" style="height:75px;width:auto;"
                     alt="" id="estate_image_image" >
                <i id="loading_estate_image_image" style="display:none" class="ace-icon fa fa-spinner"></i>

                <div class="img__description_layer">
                    <p class="img__description"><i
                                class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br> Click to change
                        photo</p>
                </div>
            </div>

        </label>
    </div>
    <div id="estate-eName">
        <input type="hidden" name="estate_id" id="estate_id" value="{{$estate_found->estate_id}}">
        <label for="estate_name">Estate Name</label>
        <input type="text" class="form-control" id="estate_name" placeholder="Estate name"
               value="{{$estate_found->estate_name? $estate_found->estate_name : 'The ' . auth()->user()->first_name . ' ' . auth()->user()->last_name . ' Family Estate' }}">
    </div>
    <div id="estate-oName">
        <label for="estate_owner_name">Estate Owner(s)</label>
        <input type="text" class="form-control" id="estate_owner_name" placeholder="Estate Owner"
               value="{{$estate_found->estate_owner_name? $estate_found->estate_owner_name : auth()->user()->first_name }}">

    </div>

    <div id="estate-address">
        <label for="estate_address">Address</label>
        <input type="text" class="form-control" id="estate_address" placeholder="" value="{{$estate_found->estate_address}}">
    </div>
    <div id="estate-address2">
        <label for="estate_address2">Address 2</label>
        <input type="text" class="form-control" id="estate_address2" placeholder="Apartment, unit" value="{{$estate_found->estate_address2}}">
    </div>

    <div id="estate-city">
        <label for="estateCity">City</label>
        <input type="text" class="form-control" id="estate_city" value="{{$estate_found->estate_city}}">
    </div>
    <div id="estate-state">
        <label for="estate_state">State</label>
        <input type="text" list="statename_estate"  class="form-control" id="estate_state" value="{{$estate_found->estate_state}}">
        <datalist id="statename_estate">
            @include('project.layouts.states')
        </datalist>
    </div>
    <div id="estate-zip">
        <label for="estate_zip">Zip</label>
        <input type="text" class="form-control" id="estate_zip" value="{{$estate_found->estate_zip}}">
    </div>
    <div id="estate-docs">
        <label for="estate_documents">View/Add Documents</label>
        <a class="btn btn-primary btn-size document_tabs_open"
           data-document-category="1"
           data-document-category-sub="1"
           data-document-category-sub-sub="0"


        >Documents</a>
    </div>
    <div id="estate-notes">
        <label for="estate_notes">Notes/Wishes</label>
        <textarea class="form-control estateNotes" id="estate_notes" rows="4" placeholder="Estate Notes...">{{$estate_found->estate_notes}}</textarea>
    </div>
    <div id="estate-homeInfo">
        <input type="checkbox" name="estate_is_primary_residence" id="estate_is_primary_residence{{$rand}}"
               class="form-check-input xfilled-in estate_is_primary_residence" value="1" {{$estate_found->estate_is_primary_residence == 1 ? 'checked="checked"':''}}>

        <label class="form-check-label pl-4 mr-4" for="estate_is_primary_residence{{$rand}}">
            This is my primary residence
        </label>
        <input class="form-check-input xfilled-in estate_does_own_home" name="estate_does_own_home" type="checkbox"  {{$estate_found->estate_does_own_home == 1 ? 'checked="checked"':''}}
        id="estate_does_own_home{{$rand}}" value="1">
        <label class="form-check-label  pl-4" for="estate_does_own_home{{$rand}}" >
            I own this home
        </label>

    </div>
    <div id="estate-submitBtn">
        <a id="btnChange-estate" type="submit" class="btn btn-primary btn-sm disabled">Update</a>
    </div>
    <div id="estate-nextSubmitBtn">
        <a id="btnChangeNext-estate" class="btn btn-primary btn-sm float-right tab-link"  href="#aboutMe-profile-form" type="submit">Next</a>
    </div>
    <a  class="cancel cancel_button_set" id="estate-closeBtn"  style="display: none" data-dismiss="modal">Close</a>
</form>


