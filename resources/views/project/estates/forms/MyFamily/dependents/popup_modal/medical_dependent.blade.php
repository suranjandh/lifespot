<style>
    .medicalNotes {
        resize: none;
    }

    #form_medical_dependent {
        display: grid;
        /* grid-template-columns: repeat(5 1fr); */
        grid-template-columns: 1fr 1fr 2fr 2fr 2fr;
        grid-gap: 10px;
        grid-template-areas: "pic practice practice doc doc"
        "email email email phone web"
        "address address address address address2"
        "city city city state zip"
        "notes notes notes notes docs"
        "saveBtn saveBtn Btn nextBtn closeBtn"
        "assignedmedical assignedmedical assignedmedical assignedmedical assignedmedical";
    }

    #medicalImg {
        grid-area: pic;
    }

    #medicalNew-gender {
        grid-area: gender;
    }

    #medicalPractice {
        grid-area: practice;
    }

    #medicalDoc {
        grid-area: doc;
    }

    #medicalWebsite {
        grid-area: web;
    }

    #medicalEmail {
        grid-area: email;
    }

    #medicalPhone {
        grid-area: phone;
    }

    #medicalAddress {
        grid-area: address;
    }

    }
    #medicalAddress2 {
        grid-area: address2;
    }

    #medicalCity {
        grid-area: city;
    }

    #medicalState {
        grid-area: state;
    }

    #medicalZip {
        grid-area: zip;
    }

    #medical_docs {
        grid-area: docs;
    }

    #medical_notes {
        grid-area: notes;
        height: 140px;
    }

    #medical_assigned {
        grid-area: assignedmedical;
        margin-left: -20px;
    }

    #medical_closeBtn {
        grid-area: closeBtn;
    }

    #medical_closeBtn a{
        float: right;
        padding-top: 15px;
    }

    #medical_saveBtn {
        grid-area: saveBtn;
    }

    #medical_next {
        grid-area: nextBtn;
    }


</style>
<h3>Medical Information</h3>
<form autocomplete="off" id="form_medical_dependent">

    <div id="medicalImg" class="image-upload">
        <input type="file" id="dependent_medical_picture" name="dependent_medical_picture"/>
        <label for="dependent_medical_picture">
            <div class="img__wrap">
                @php
                $dependent_medical_image = $dependent_medical && trim($dependent_medical->dependent_medical_image) != '' ? Config::get('constants.DEPENDENT_MEDICAL_IMG_URL') . $dependent_medical->dependent_medical_image . '?rand=' . rand(1, 1000) : Config::get('constants.PROJECT_IMAGE_URL') .'medical.jpeg';
                @endphp
                <img class="dependent_medical_img__img img-thumbnail" id="dependent_medical_img__img"
                     src="{{ $dependent_medical_image }}"
                     style="height:75px;width:auto;"
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

    <div id="medicalPractice">
        <input type="hidden" name="dependent_member_id" id="dependent_member_id"
               value="{{ $dependent && $dependent->member_id ? $dependent->member_id : '' }}">

        <label for="dependent_medical_primary_care">Primary Care</label>
        <input type="text" class="form-control" id="dependent_medical_primary_care"
               value="{{ $dependent_medical ? $dependent_medical->dependent_medical_primary_care : '' }}">
    </div>
    <div id="medicalDoc">
        <label for="dependent_medical_name">Doctor's Name</label>
        <input type="text" class="form-control" id="dependent_medical_name"
               value="{{ $dependent_medical ? $dependent_medical->dependent_medical_name : '' }}">
    </div>


    <div id="medicalEmail">
        <label for="dependent_medical_email">Email</label>
        <input type="text" class="form-control" id="dependent_medical_email"
               value="{{ $dependent_medical ? $dependent_medical->dependent_medical_email : '' }}">
    </div>
    <div id="medicalPhone">
        <label for="dependent_medical_phone">Phone</label>
        <input type="text" class="form-control phone_us" id="dependent_medical_phone"
               value="{{ $dependent_medical ? $dependent_medical->dependent_medical_phone : '' }}">
    </div>
    <div id="medicalWebsite">
        <label for="dependent_medical_web">Website / Portal</label>
        <input type="text" class="form-control" id="dependent_medical_web"
               value="{{ $dependent_medical ? $dependent_medical->dependent_medical_web : '' }}">
    </div>


    <div id="medicalAddress">
        <label for="dependent_medical_address">Address</label>
        <input type="text" class="form-control" id="dependent_medical_address"
               value="{{ $dependent_medical ? $dependent_medical->dependent_medical_address : '' }}">
    </div>
    <div id="medicalAddress2">
        <label for="dependent_medical_address2">Address 2</label>
        <input type="text" class="form-control" id="dependent_medical_address2"
               value="{{ $dependent_medical ? $dependent_medical->dependent_medical_address2 : '' }}">
    </div>


    <div id="medicalCity">
        <label for="dependent_medical_city">City</label>
        <input type="text" class="form-control" id="dependent_medical_city"
               value="{{ $dependent_medical ? $dependent_medical->dependent_medical_city : '' }}">
    </div>
    <div id="medicalState">
        <label for="dependent_medical_state">State</label>
        <input type="text" list="statename_medical" class="form-control" id="dependent_medical_state"
               value="{{ $dependent_medical ? $dependent_medical->dependent_medical_state : '' }}">
        <datalist id="statename_medical">
           {{-- {{ include '../../../About-Me/Estate/states.php'; }}--}}
            @include('project.layouts.states')
        </datalist>
    </div>
    <div id="medicalZip">
        <label for="dependent_medical_zip">Zip</label>
        <input type="text" class="form-control" id="dependent_medical_zip"
               value="{{ $dependent_medical ? $dependent_medical->dependent_medical_zip : '' }}">
    </div>
    <div id="medical_docs">
        <label for="medicalDocs">View/Add Medical Documents</label>
        <a class="btn btn-primary btn-size rounded_5_button document_tabs_open"
           data-document-category="2"
           data-document-category-sub="5"
           data-document-category-sub-sub="{{ $dependent ? $dependent->member_id : '' }}"
           data-document-category-sub-sub-sub="2"
        >Documents</a>
    </div>
    <div id="medical_notes">
        <label for="medical-Notes">Notes/Wishes</label>
        <textarea class="form-control medical_notes  special_notes_dependent" name=""
                  id="dependent_medical_special_notes" rows="4"
                  placeholder="Notes / Medications ....">{{ $dependent_medical ? $dependent_medical->dependent_medical_special_notes : '' }}</textarea>

    </div>

    <div id='medical_saveBtn'>
        <button type="button" class="btn btn-primary btn-sm rounded_5_button disabled" id="btnChange-dependents-medical" >
            Update
        </button>
    </div>
    <div id="medical_next">
        <button type="button" class="btn btn-primary btn-sm rounded_5_button" id="btnNext-dependents-medical">Next</button>
    </div>

    <div id='medical_closeBtn'>
        <a  class="dependents-closeBtn cancel_button_set" data-dismiss="modal">Close</a>
    </div>
</form>