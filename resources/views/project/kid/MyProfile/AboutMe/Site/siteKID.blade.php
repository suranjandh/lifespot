@php

//include SITE_BASE_PATH.'/project/lib/includes/header_include.php';
//$userId = $_SESSION->loggedInUser;

//$content_access_obj = new ContentAccessModel();
//$content_access_obj->


//$site_obj = new SiteModel();

$site_found = auth()->user()->site ; //$site_obj->get_sites_by_owner_user_id($userId);
$rand = rand(1,1000);
@endphp
<style>
    .siteNotes {
        resize: none;
    }

    #form-site {
        display: grid;
        grid-template-columns: 1fr 1fr 2fr 1fr 1fr 2fr;
        grid-gap: 10px;
        grid-template-areas: "header header header header header header" "pic eName eName eName eName oName" "btn btn btn btn btn cancel";
    }

    #site-header {
        grid-area: header;
        padding: 0;
    }

    #site-pic {
        grid-area: pic;
    }

    #site-gender {
        grid-area: gender;
    }

    #site-eName {
        grid-area: eName;
    }

    #site-oName {
        grid-area: oName;
    }

    #site-address {
        grid-area: address;
    }

    #site-address2 {
        grid-area: address2;
    }

    #site-city {
        grid-area: city;
    }

    #site-state {
        grid-area: state;
    }

    #site-zip {
        grid-area: zip;
    }

    #site-docs {
        grid-area: docs;
    }

    #site-notes {
        grid-area: notes;
    }

    #site-homeInfo {
        grid-area: homeInfo;
        height: 174px;
    }

    #site-submitBtn {
        grid-area: btn;
    }
    #site-nextSubmitBtn {
        /* grid-area: next; */
    }
    #site-closeBtn {
        grid-area: cancel;
        justify-self: end;
        align-self: end;
    }
</style>
<span id="site_error_message"></span>
<form autocomplete="off"  id="form-site">
    <h3 id="site-header">My Website Information</h3>

    <div id="site-pic" class="image-upload">
        <input id="site_picture" name="site_picture" type="file" class="change_trigger_disabled"/>

        <label for="site_picture">
            <div class="img__wrap">
                @php
                $site_found_image = $site_found && trim($site_found->site_image) != '' ? Config::get('constants.SITE_BASE_URL') . Config::get('constants.SITE_IMG_FOLDER') . '/' . $site_found->site_image . '?rand=' . rand(1, 1000) : Config::get('constants.PROJECT_IMAGE_FOLDER').'generic_Defaultfamily.png';
                @endphp
                <img class="img__img img-thumbnail site_image_image" src="{{$site_found_image}}" style="height:75px;width:auto;"
                     alt="" id="site_image_image" >
                <i id="loading_site_image_image" style="display:none" class="ace-icon fa fa-spinner"></i>

                <div class="img__description_layer">
                    <p class="img__description"><i
                                class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br> Click to change
                        photo</p>
                </div>
            </div>

        </label>
    </div>
    <div id="site-eName">
        <input type="hidden" name="site_id" id="site_id" value="{{$site_found && $site_found->site_id ? $site_found->site_id :''}}">
        <label for="site_name">Site Name</label>
        <input type="text" class="form-control" id="site_name" placeholder="site name"
               value="{{$site_found && $site_found->site_name? $site_found->site_name :''}}">
    </div>
    <div id="site-oName">
        <label for="site_owners">Site Owner(s)</label>
        <input type="text"  class="form-control" id="site_owners" placeholder="site Owner"
               value="{{$site_found && $site_found->site_owners? $site_found->site_owners : ''}}">

    </div>

    
    <div id="site-submitBtn">
        <a id="btnChange-site" type="submit" class="btn btn-primary btn-sm disabled" >Update</a>
    </div>
    <div id="site-nextSubmitBtn">
        <a id="btnChangeNext-site" class="btn btn-primary btn-sm float-right"  type="submit">Next</a>
    </div>
    <a  class="cancel" id="site-closeBtn"  style="display: none" data-dismiss="modal">Cancel</a>
</form>


