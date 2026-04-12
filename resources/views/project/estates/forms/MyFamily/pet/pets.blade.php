@php
//include '../../../../lib/includes/header_include.php';
$pet = null ;//array();
$pet_guardian_member = null ;//array();
$pet_id =  \Illuminate\Support\Facades\Input::get('pet_id') ;//isset($_POST->pet_id) && trim($_POST->pet_id) != '' ? $database->escape_string($_POST->pet_id) : 0;
//$pet_obj = new PetModel();
//$member_obj = new MemberModel();
if($pet_id){
    $pet = \App\Pet::find($pet_id); //$pet_obj->get_pet_by_id($pet_id);
    if($pet) {
        $pet_guardian_member = \App\Member::find($pet->pet_guardian); //$member_obj->get_member_by_id($pet->pet_guardian);
    }
}

@endphp
<style>
    .petNotes{
        resize:none;
    }
    .pet-img{
        /* width: 100%;
        height: auto; */
        /* opacity: 0.3; */
        cursor: pointer;
    }
    .pet-topLeft{
        position: absolute;
        top: 4px;
        left: 4px;
        font-size: 12px;
        cursor: pointer;
    }
    .caret {
        display:none;
    }
    .custom-control-label::before {
        background-color: white;
    }

    #form-pets{
        display:grid;
        /* grid-template-columns: repeat(4 1fr); */
        grid-template-columns: 1fr 1fr 2fr 2fr 2fr;
        grid-gap: 10px;
        grid-template-areas:
                "header header header vetHeader vetHeader"
                "pic gender petName vetClinic vetClinic"
                "breed breed breed phone phone"
                "bday bday  tagNum vet docs"
                "guardianFn guardianFn guardianLn notes notes"
                "btn btn btn btn close"
    ;
    }
    #pet-header{
        grid-area: header;
        padding: 0;
    }
    #pet-vetheader{
        grid-area: vetHeader;
        padding: 0;
    }
    #pet-pic{
        grid-area: pic;
        position: relative;
    }
    #pet-gender{
        grid-area: gender;
    }
    #pet-petName{
        grid-area: petName;

    }
    #pet-vetClinic{
        grid-area: vetClinic;
    }

    #pet-bday{
        grid-area: bday;
    }
    #pet-breed{
        grid-area: breed;
    }
    #tagNum{
        grid-area: tagNum;
    }
    #pet-phone{
        grid-area: phone;
    }
   /* #pet-gaurdian{
        grid-area: guardian;
    }*/
    #pet-gaurdian-fn{
        grid-area: guardianFn;
    }

    #pet-gaurdian-ln{
        grid-area: guardianLn;
    }

    #pet-vet{
        grid-area: vet;
    }
    #pet-notes{
        grid-area: notes;
        height: 174px;
    }
    #pet-docs{
        grid-area: docs;
    }
    #pet-submitBtn{
        grid-area: btn;
    }

    #pet-closeBtn{
        grid-area: close;
    }
</style>
<form id="form-pets">
    <h3 id="pet-header">Pet Information</h3>

    <h3 id="pet-vetheader">Veterinarian</h3>
    <div id="pet-pic" class="image-upload">
        <input id="pet_picture" name="pet_picture" type="file" class="change_trigger_disabled"/>
        <label for="pet_picture">
            <!-- <img src="../img/defaultAvatar.jpeg"  class="img-thumbnail
            pet-img" style="height:75px;width:auto;" alt=""> -->

            <div class="img__wrap">
                @php
                $pet_found_image = $pet && trim($pet->pet_image) != '' ? Config::get('constants.SITE_BASE_URL') . Config::get('constants.PET_IMG_FOLDER') . '/' . $pet->pet_image . '?rand=' . rand(1, 1000) : Config::get('constants.PROJECT_IMAGE_URL').'pet_generic.png';
                @endphp
                <img class="img__img img-thumbnail pet_image_img"
                     src="{{$pet_found_image}}"
                     id="pet_image_img"
                     style="height:75px;width:auto;" alt="">
                <i id="loading" style="display:none" class="ace-icon fa fa-spinner"></i>

                <div class="img__description_layer">
                    <p class="img__description"><i
                                class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br> Click to Change
                        Photo</p>
                </div>
            </div>
            <!-- <span class="pet-topLeft"><i class="fas fa-plus-circle add_field_button_phone green-text "></i> Add Photo</span> -->
        </label>
        
        
        

    </div>
    <div id="pet-gender">
        @php
        $rand = rand(1,50000);
        @endphp
        <div class="custom-control custom-radio custom-control-inline xmt-3 pl-0">
            <input type="radio" id="pet_genderMale{{ $rand }}" name="pet_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0"
                   value="Male"  {{ $pet && $pet->pet_gender == 'Male' ? 'checked="checked"' : '' }}>
            <label class="xcustom-control-label form-check-label pl-4"
                   for="pet_genderMale{{ $rand }}">Male</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline pl-0">
            <input type="radio" id="pet_genderFemale{{ $rand }}" name="pet_gender"
                   class="xcustom-control-input form-check-input with-gap mr-0"
                   value="Female" {{ $pet && $pet->pet_gender == 'Female' ? 'checked="checked"' : '' }} >
            <label class="xcustom-control-label form-check-label pl-4"
                   for="pet_genderFemale{{ $rand }}">Female</label>
        </div>
        
    </div>
    <div id="pet-petName">
        <input type="hidden" class="form-control" id="pet_id"  value="{{$pet ? $pet->pet_id:''}}">
        <label for="pet_name">Pet's Name</label>
        <input type="text" class="form-control" id="pet_name" placeholder="Pet's name" value="{{$pet ? $pet->pet_name:''}}">
    </div>
    <div id="pet-vetClinic">
        <label for="pet_clinic_name">Clinic Name</label>
        <input type="text" class="form-control" id="pet_clinic_name" placeholder="Veterinarian name" value="{{$pet ? $pet->pet_clinic_name:''}}">
    </div>
    <div id="pet-breed">
        <label for="pet_description">Animal Description (breed)</label>
        <input type="text" class="form-control" id="pet_description" placeholder="" value="{{$pet ? $pet->pet_description:''}}">
    </div>

    <div id="pet-phone">
        <label for="pet_veterinarian_phone">Veterinarian Phone</label>
        <input type="text" class="form-control phone_us" id="pet_veterinarian_phone" placeholder="Veterinarian phone" value="{{$pet ? $pet->pet_veterinarian_phone:''}}">
    </div>

    <div id="pet-bday">
        <label for="pet_birth_day">Birthdate</label>
        <input type="text" class="form-control datepicker white" id="pet_birth_day" value="{{ $pet && $pet->pet_birth_day ? date('m/d/Y', strtotime($pet->pet_birth_day)) : '' }}">
    </div>
    <div id="tagNum">
        <label for="pet_tag_id">Tag ID Number</label>
        <input type="text" class="form-control" id="pet_tag_id" placeholder="" value="{{$pet ? $pet->pet_tag_id:''}}">
    </div>


    <div id="pet-vet">
        <label for="pet_doctor_name">Pet's Veterinarian</label>
        <input type="text" class="form-control" id="pet_doctor_name" placeholder="Doctor's name" value="{{$pet ? $pet->pet_doctor_name:''}}">
    </div>

    <div id="pet-gaurdian-fn">
        <input type="hidden" id="pet_guardian_member_id"  value="{{$pet_guardian_member ? $pet_guardian_member->member_id: 0}}" >
        <label for="pet_guardian_first_name">Caregiver First Name</label>
        <input type="text" class="form-control" id="pet_guardian_first_name" placeholder="Pet's guardian"
        value="{{$pet_guardian_member ? $pet_guardian_member->member_first_name: ''}}"
        >
        <div id="pet_guardian_suggesstion-box"></div>
    </div>

    <div id="pet-gaurdian-ln">
        <label for="pet_guardian_last_name">Caregiver Last Name</label>
        <input type="text" class="form-control" id="pet_guardian_last_name" placeholder="Pet's guardian" style=""
            value="{{$pet_guardian_member ? $pet_guardian_member->member_last_name: ''}}" >
    </div>

    <div id="pet-notes">
        <label for="pet_notes">Notes/Wishes</label>
        <textarea class="form-control petNotes" name="" id="pet_notes" rows="4" placeholder="Notes about this pet...">{{$pet ? $pet->pet_notes:''}}</textarea>
    </div>
    @php $document_disabled_class = $pet && $pet->pet_id ? '' :'documents_disabled' ;@endphp
    <div id="pet-docs">
        <label for="pet_documents">View/Add Documents</label>
        <a id="pet_documents"
           data-document-category="2"
           data-document-category-sub="7"
           data-document-category-sub-sub="{{ $pet ? $pet->pet_id : '0' }}"
           data-document-category-sub-sub-sub="0"
           class="btn btn-primary btn-size rounded_5_button document_tabs_open {{$document_disabled_class}}">Documents</a>
    </div>
    <div id="pet-submitBtn">
        <a id="btnChange-pet" type="submit" class="btn btn-primary btn-sm rounded_5_button disabled" >Update</a>
    </div>
    <div id="pet-closeBtn">
        <button  class="btn btn-secondary btn-sm rounded_5_button cancel_button_set" id="pet-closeBtn"  data-dismiss="modal">Close</button>
    </div>
</form>