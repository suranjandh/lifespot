<style>
    #beneficiary-content {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-auto-rows: 250px;
        /* grid-auto-rows: minmax(200px, auto); */
        grid-gap: 10px;
        /* max-width: 960px; */
        margin: 0 auto;

    }

    #beneficiary-content a {
        /* background: #3bbced; */
        /* padding: 10px; */
        /* background: #eee; */
        background: #fff;
        overflow: auto;
        border-radius: 5px;
        /* text-align: center; */
    }

    #beneficiary-content div:nth-child(even) {
        /* background: #777; */
        /* padding: 30px; */
    }

    .beneficiary-cardLayout {
        padding: 5px 20px;
        position: relative;
        border: 1px solid #0b2a41;
    }

    .beneficiary-cardLayout .beneficiary_relationship {
        color: grey;
        text-align: left;
        padding: 0;
        font-size: 1.3em;
    }

    .beneficiary-cardLayout .beneficiary_role {
        /* color: rgb(57, 122, 242); */
        color: rgb(58, 113, 183);
        text-align: right;
        padding: 0;
        font-size: 1.3em;
    }

    .beneficiary-cardLayout .beneficiary_image {
        height: 60%;
    }

    .beneficiary-cardLayout .beneficiary_image img {
        width: auto;
        height: 100%;
        max-width: 50%;
    }

    .beneficiary-cardLayout .beneficiary_name {
        text-align: left;
        font-size: 1.3em;
        color: darkgoldenrod;
        font-weight: bolder;
    }

    .beneficiary-cardLayout .icon_set_row {
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    .beneficiary-cardLayout .icon_set {
        float: left;
        margin-right: 20px;

    }

    #addNewBeneficiary {
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
        .beneficiary-cardLayout .beneficiary_relationship, .beneficiary-cardLayout .beneficiary_role, .beneficiary-cardLayout .beneficiary_name {
            font-size: 1.1em;
        }

    }

    @media (max-width: 980px) {
        .beneficiary-cardLayout .beneficiary_relationship, .beneficiary-cardLayout .beneficiary_role, .beneficiary-cardLayout .beneficiary_name {
            font-size: .9em;
        }
    }


</style>
<!--<style>
    .member-cardLayout .img-fluid,.member-cardLayout .img-thumbnail{
        max-width: inherit;
    }
    .beneficiary-cardLayout {
        border-radius: 10px;
        border: 1px solid #000000;
    }
</style>-->
<div id="beneficiary-content">
    <!--<a class="beneficiary-cardLayout beneficiary_content_box member_content_box"

       data-member-type="current_member" data-member-member-id="0"   data-member-id="0" id="addNewbeneficiary">Add Beneficiary <br>
        <i class="fas fa-plus fa-4x"></i>
    </a>-->
    @php
        /*if(isset($have_header) && $have_header != true ) {
            include '../../../../lib/includes/header_include.php';
        }*/
        $members_set = null;
        //$member_obj = new MemberModel();
        //$members_set = $member_obj->get_beneficiary_by_user_id($_SESSION->loggedInUser);
        $members_set = auth()->user()->beneficiaries; // \App\Beneficiary::where('member_owner_user_id',auth()->user()->id)->get();
        $member_type = 'beneficiary';
    @endphp

    @if ($members_set)
        @foreach ($members_set as $member)
            @php
                //$member = $member_obj->clear_no_role_for_multi_roles($member);
                        //$member = (array)$member;
                        $name = $member->member_first_name . ' ' . $member->member_last_name;
                        $member_roles = $member->roles ;
                        $main_role =  $member->main_role($member_roles) ;
                    $roles_set_first = $main_role != null  ?  $main_role->role_name : "";
                        $roles_set_first = $roles_set_first ? $roles_set_first : 'No Role';
            @endphp
            <a class="beneficiary-cardLayout beneficiary_content_box member_content_box sub_sub_category_key_beneficiary_{{ $member->member_id }}"
               data-member-member-id="{{ $member->member_id }}" data-member-id="{{ $member->member_id }}"
               data-member-type="{{$member_type}}"
               style="overflow: hidden">
                <div class="row">
                    <div class="col-5 beneficiary_relationship">
                        {{ $member->member_relationship_to_owner ? \App\Relationship::get_relationship_name_by_relationship_id($member->member_relationship_to_owner) : '' }}
                    </div>
                    <div class="col-7 beneficiary_role">
                        {{-- @php
                         $roles_set_first = "";
                         $roles_set_other = array();
                         if ($member->member_role_in_estate) {
                         foreach (explode('|', $member->member_role_in_estate) as $k => $role_id) {
                         if ($k == 0) $roles_set_first = $roles_obj->get_role_name_by_role_id($role_id);
                         else $roles_set_other[] = $roles_obj->get_role_name_by_role_id($role_id)
                         @endphp
                         @php
                             }
                         }@endphp--}}

                        {{-- @php if ($roles_set_first) echo $roles_set_first;
                         else     echo 'No Role';     @endphp--}}
                        {{$roles_set_first}}
                    </div>
                </div>
                <div class="row justify-content-start beneficiary_image">
                    @php
                        $member_image = trim($member->member_image) != '' ?  Config::get('constants.MEMBER_IMG_URL') . $member->member_image . '?rand=' . rand(1, 1000) : Config::get('constants.DEFAULT_AVATAR_IMAGE_URL');
                    @endphp
                    <img src="{{ $member_image }}" class="pic ximg-fluid rounded img-thumbnail beneficiary-img"
                         alt="">
                </div>
                <div class="row justify-content-start beneficiary_name">
                    {{ $name }}
                </div>
                <div class="row justify-content-start member_name" style="color: #00FFAA">
                    {{$member->member_is_dependent($member) ? 'Dependent' : ''}}
                </div>
                <div class="d-flex justify-content-between row icon_set_row">
                    {{-- @php include 'beneficiary_icons.php' @endphp--}}
                </div>
            </a>
        @endforeach
    @endif
</div>
