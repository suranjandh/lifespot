<!--<style>
    .member-cardLayout .img-fluid,.member-cardLayout .img-thumbnail{
        max-width: inherit;
    }
    .dependent-cardLayout {
        border-radius: 10px;
        border: 1px solid #000000;
    }
</style>-->

<a class="dependent-cardLayout dependents_content_box" data-member-id="0" id="addNewdependent">Add Dependent <br>
    <i class="fas fa-plus fa-4x"></i>
</a>
@php
    $members_set = null;
$member_type = 'dependent';
@endphp
@if (Illuminate\Support\Facades\Input::get('dependents_set'))
    @php   $dependent_json = json_decode(Input::get('dependents_set'));
    $members_set = $dependent_json->result;
    @endphp
@else
    @php   $members_set = auth()->user()->dependents; //\App\Dependent::where('member_owner_user_id',auth()->user()->id)->get();@endphp
@endif
@if ($members_set)
    @foreach ($members_set as $member)
        @php
            //      $member = $member_obj->clear_no_role_for_multi_roles($member);
      //        $member = (array)$member;
              $name = $member->member_first_name . ' ' . $member->member_last_name;
              $member_roles = $member->roles ;
              $main_role =  $member->main_role($member_roles) ;
                    $roles_set_first = $main_role != null  ?  $main_role->role_name : "";
              $roles_set_first = $roles_set_first ? $roles_set_first : 'No Role';

        @endphp
        <a class="dependent-cardLayout dependents_content_box sub_sub_category_key_dependent_{{ $member->member_id }}"
           data-member-id="{{ $member->member_id }}"
           style="overflow: hidden">
            <div class="row">
                <div class="col-5 dependent_relationship">
                    {{ $member->member_relationship_to_owner ? \App\Relationship::get_relationship_name_by_relationship_id($member->member_relationship_to_owner) : '' }}</div>
                <div class="col-7 dependent_role">
                    {{$roles_set_first}}
                </div>
            </div>
            <div class="row justify-content-start dependent_image">
                @php
                    $image_folder_url = $member_type == 'current_dependent' ? Config::get('constants.DEPENDENT_PROFILE_IMG_URL') : Config::get('constants.MEMBER_IMG_URL');
                    $member_image = trim($member->member_image) != '' ? $image_folder_url . $member->member_image . '?rand=' . rand(1, 1000) : Config::get('constants.DEFAULT_AVATAR_IMAGE_URL'); @endphp
                <img src="{{ $member_image }}" class="pic ximg-fluid rounded img-thumbnail dependent-img"
                     alt="">
            </div>
            <div class="row justify-content-start dependent_name">
                {{ $name }}</br>
            </div>
            <div class="row justify-content-start member_name"
                 style="color: rgb(57, 122, 242); font-size: .9rem; line-height:5px; margin-top:5px;">
                {{$member->member_is_dependent($member) ? 'Dependent' : ''}}
            </div>
            <div class="d-flex justify-content-between row icon_set_row">
                {{-- @php include 'dependent_icons.php' @endphp--}}
            </div>

        </a>
    @endforeach
@endif
