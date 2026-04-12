<style>
    #pet-content {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-auto-rows: 250px;
        /* grid-auto-rows: minmax(200px, auto); */
        grid-gap: 10px;
        /* max-width: 960px; */
        margin: 0 auto;

    }

    #pet-content a {
        /* background: #3bbced; */
        /* padding: 10px; */
        /* background: #eee; */
        background: #fff;
        overflow: auto;
        border-radius: 5px;
        /* text-align: center; */
    }

    #pet-content div:nth-child(even) {
        /* background: #777; */
        /* padding: 30px; */
    }

    .pet-cardLayout {
        padding: 5px 20px;
        position: relative;
        border: 1px solid #0d5bdd;
    }

    .pet-cardLayout .pet_relationship {
        color: grey;
        text-align: left;
        padding: 0;
        font-size: 1.3em;
    }

    .pet-cardLayout .pet_role {
        /* color: rgb(57, 122, 242); */
        color: rgb(58, 113, 183);
        text-align: right;
        padding: 0;
        font-size: 1.3em;
    }

    .pet-cardLayout .pet_image {
        height: 60%;
    }

    .pet-cardLayout .pet_image img {
        width: auto;
        height: 100%;
        max-width: 50%;
    }

    .pet-cardLayout .pet_name {
        text-align: left;
        font-size: 1.3em;
        color: darkgoldenrod;
        font-weight: bolder;
    }

    .pet-cardLayout .icon_set_row {
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    .pet-cardLayout .icon_set {
        float: left;
        margin-right: 20px;

    }

    #addNewPet {
        color: rgb(57, 122, 242);
        text-align: center;
        padding: 15px;
        font-size: 1.4em;
    }

    .modal-position {
        margin-right: 50%;
    }

    .modal-size {
        width: 1000px;
    }

    @media (max-width: 1580px) {
        .pet-cardLayout .pet_relationship, .pet-cardLayout .pet_role, .pet-cardLayout .pet_name {
            font-size: 1.1em;
        }

    }

    @media (max-width: 980px) {
        .pet-cardLayout .pet_relationship, .pet-cardLayout .pet_role, .pet-cardLayout .pet_name {
            font-size: .9em;
        }
    }


</style>
<!--<style>
    .pet-cardLayout .img-fluid,.pet-cardLayout .img-thumbnail{
        max-width: inherit;
    }
    .pet-cardLayout {
        border-radius: 10px;
        border: 1px solid #000000;
    }
</style>-->
<div id="pet-content">
<a class="pet-cardLayout pet_content_box member_content_box"

   data-member-type="pet" data-member-member-id="0"   data-member-id="0" id="addNewpet" style="color:#0d5bdd;text-align:center;font-size: 1.7em;font-weight: 900">Add Pet<br>
    <i class="fas fa-plus fa-4x" ></i>
</a>
@php

$pets_set = null;
//$pet_obj = new PetModel();
$pets_set =  auth()->user()->pets ;// \App\Pet::where('pet_owner_user_id',auth()->user()->id)->get();//$pet_obj->get_pets_by_owner_user_id($_SESSION->loggedInUser);
$pet_type = 'pet';
@endphp
@if ($pets_set)
    @foreach ($pets_set as $pet)
        @php
        $name = $pet->pet_name ;

        @endphp
        <a class="pet-cardLayout pet_content_box member_content_box sub_sub_category_key_pet_{{ $pet->pet_id }}"
           data-member-member-id="{{ $pet->pet_id }}"      data-member-id="{{ $pet->pet_id }}" data-member-type="{{$pet_type}}"
           style="overflow: hidden">
            <div class="row">
                <div class="col-5 pet_relationship">
                </div>
                <div class="col-7 pet_role">

                </div>
            </div>
            <div class="row justify-content-start pet_image">
                @php
                $pet_image = trim($pet->pet_image) != '' ? Config::get('constants.PET_IMG_URL') . $pet->pet_image . '?rand=' . rand(1, 1000) : Config::get('constants.PROJECT_IMAGE_URL').'pet_generic.png'; @endphp
                <img src="{{ $pet_image }}" class="pic ximg-fluid rounded img-thumbnail pet-img"
                     alt="">
            </div>
            <div class="row justify-content-start pet_name">
                {{ $name }}
            </div>
            <div class="d-flex justify-content-between row icon_set_row">
                {{--@php include 'pet_icons.php' @endphp--}}
{{--
                @include('project.estates.forms.MyFamily.pet.pet_icons')
--}}
            </div>

        </a>
    @endforeach
@endif
</div>
