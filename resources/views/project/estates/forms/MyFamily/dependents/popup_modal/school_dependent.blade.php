<style>
    .schoolNotes {
        resize: none;
    }

    #form_dependent_school_content {
        display: grid;
        /* grid-template-columns: repeat(5 1fr); */
        grid-template-columns: 1fr 1fr 2fr 2fr 2fr;
        grid-gap: 10px;
        grid-template-areas: "pic school school school grade" "email email email phone web" "address address address address address2" "city city city state zip" "notes notes notes notes docs" "assignedschool assignedschool assignedschool assignedschool assignedschool" "btnS btnS . . cancelS";
    }

    #schoolImg {
        grid-area: pic;
    }

    #schoolName {
        grid-area: school;
    }

    #schoolGrade {
        grid-area: grade;
    }

    #schoolEmail {
        grid-area: email;
    }

    #schoolPhone {
        grid-area: phone;
    }

    #schoolWebsite {
        grid-area: web;
    }

    #schoolAddress {
        grid-area: address;
    }

    }
    #schoolAddress2 {
        grid-area: address2;
    }

    #schoolCity {
        grid-area: city;
    }

    #schoolState {
        grid-area: state;
    }

    #schoolZip {
        grid-area: zip;
    }

    #school_docs {
        grid-area: docs;
    }

    #school_notes {
        grid-area: notes;
        height: 140px;
    }

    #school_assigned {
        grid-area: assignedschool;
        margin-left: -20px;
    }

    #school_save {
        grid-area: btnS;
    }

    #school_close {
        grid-area: cancelS;
    }

    #school_close a {
        float: right;
        padding-top: 10px;
    }
</style>

<h3>School Information</h3>
<form autocomplete="off" id="form_dependent_school_content">
    <input type="hidden" name="dependent_member_id" id="dependent_member_id" value="{{ $dependent_member_id }}">

    <div id="schoolImg" class="image-upload">
        <input type="file" id="dependent_school_picture" name="dependent_school_picture"/>
        <label for="dependent_school_picture">
            <div class="img__wrap">
                @php
                    $dependent_school_image = $dependent_school && trim($dependent_school->dependent_school_image) != '' ?  Config::get('constants.DEPENDENT_SCHOOL_IMG_URL') . $dependent_school->dependent_school_image . '?rand=' . rand(1, 1000) :  Config::get('constants.PROJECT_IMAGE_URL') .'school.jpg';
                @endphp
                <img class="dependent_school_img__img img-thumbnail" id="dependent_school_img__img"
                     src="{{ $dependent_school_image }}"
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
    <div id="schoolName">
        <label for="dependent_school_name">Name School</label>
        <input type="text" class="form-control" id="dependent_school_name"
               value="{{ $dependent_school ? $dependent_school->dependent_school_name : '' }}"></div>

    <div id="schoolGrade">

        <label for="dependent_school_grade">Grade</label>
        <select id="dependent_school_grade" class="mdb-select mdb-select-dependent xmd-form xform-control">
            @foreach (\App\Helpers\Helper::school_grades() as $k => $v)
                @php $selected = $dependent_school && $dependent_school->dependent_school_grade == $k - 1 ? 'selected="selected"' : '';
                @endphp
                <option value="{{ $k }}" {{ $selected ? 'selected="selected"' : '' }} >{{ $v }}</option>
        @endforeach

        <!-- </optgroup> -->
        </select>
    </div>

    <div id="schoolEmail">
        <label for="dependent_school_email">Email</label>
        <input type="text" class="form-control" id="dependent_school_email"
               value="{{ $dependent_school ? $dependent_school->dependent_school_email : '' }}">

    </div>
    <div id="schoolPhone">
        <label for="dependent_school_phone">Phone</label>
        <input type="text" class="form-control phone_us" id="dependent_school_phone"
               value="{{ $dependent_school ? $dependent_school->dependent_school_phone : '' }}">

    </div>
    <div id="schoolWebsite">
        <label for="dependent_school_counselor">Contact / Counselor</label>
        <input type="text" class="form-control" id="dependent_school_counselor"
               value="{{ $dependent_school ? $dependent_school->dependent_school_counselor : '' }}">
    </div>


    <div id="schoolAddress">
        <label for="dependent_school_address">Address</label>
        <input type="text" class="form-control" id="dependent_school_address"
               value="{{ $dependent_school ? $dependent_school->dependent_school_address : '' }}">

    </div>
    <div id="schoolAddress2">
        <label for="dependent_school_address2">Address 2</label>
        <input type="text" class="form-control" id="dependent_school_address2"
               value="{{ $dependent_school ? $dependent_school->dependent_school_address2 : '' }}">

    </div>


    <div id="schoolCity">
        <label for="dependent_school_city">City</label>
        <input type="text" class="form-control" id="dependent_school_city"
               value="{{ $dependent_school ? $dependent_school->dependent_school_city : '' }}">
    </div>
    <div id="schoolState">
        <label for="dependent_school_state">State</label>
        <input type="text" list="statename_school" class="form-control" id="dependent_school_state"
               value="{{ $dependent_school ? $dependent_school->dependent_school_state : '' }}">
        <datalist id="statename_school">
            {{-- {{ include '../../../About-Me/Estate/states.php'; }}--}}
            @include('project.layouts.states')
        </datalist>
    </div>
    <div id="schoolZip">
        <label for="dependent_school_zip">Zip</label>
        <input type="text" class="form-control" id="dependent_school_zip"
               value="{{ $dependent_school ? $dependent_school->dependent_school_zip : '' }}">
    </div>
    <div id="school_docs">
        <label for="schoolDocs">View/Add School Documents</label>
        <a class="btn btn-primary btn-size rounded_5_button document_tabs_open"
           data-document-category="2"
           data-document-category-sub="5"
           data-document-category-sub-sub="{{ $dependent ? $dependent->member_id : '' }}"
           data-document-category-sub-sub-sub="4"
        >Documents</a></div>
    <div id="school_notes">
        <label for="school-Notes">Notes/Wishes</label>
        <textarea class="form-control school_notes special_notes_dependent" name="" id="dependent_school_special_notes"
                  rows="4"
                  placeholder="School wishes / School activities ....">{{ $dependent_school ? $dependent_school->dependent_school_special_notes : '' }}</textarea>
    </div>

    <div id="school_save">
        <button type="button" class="btn btn-primary btn-sm rounded_5_button disabled" id="btnChange-dependents-school">
            Update
        </button>
    </div>
    <div id="school_close">
        <a class="dependents-closeBtn cancel_button_set" data-dismiss="modal">Close</a>
    </div>
</form>