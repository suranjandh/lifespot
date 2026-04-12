@php
    // include dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/lib/includes/header_include.php';
    // $document_obj = new DocumentModel();
    // $document_share_obj = new DocumentShareModel();
    // $document_share_roles_obj = new DocumentShareRolesModel();
    $document_id = \Illuminate\Support\Facades\Input::get('document_id');
    $document_shares_set = \App\DocumentShare::get_document_shares_set($document_id);// $document_share_obj->get_document_shares_set($_POST->document_id);

    $document_shared_roles = \App\DocumentShareRole::get_document_shared_roles($document_id);// $document_share_roles_obj->get_document_shared_roles($_POST->document_id);
    $document = \App\Document::find($document_id); // $document_obj->get_document_by_document_id($_POST->document_id);
@endphp
<style>
    .share-document-cardLayout .img-fluid, .share-document-cardLayout .img-thumbnail {
        max-width: inherit;
    }

    input[type=checkbox]:checked + label {
        color: green;
        font-style: normal;
        width: 100px;
        /* content: "TESTING!!!"; */
    }

    input[type=checkbox] + label {
        color: #f00;
        font-style: normal;
        width: 100px;
        /* content: "TEST!"; */
    }
</style>
<a class="load_document_main right">
    <h4 style="color: #f5f5f5">Document Sharing - {{ $document->document_title }}</h4>
    <button class="btn btn-primary btn-sm">Back</button>
</a>

<div id="documents-share-content">
    @php
        $members_set = \Illuminate\Support\Facades\Input::get('members_set') ? \Illuminate\Support\Facades\Input::get('members_set')  : false;
    @endphp
    @if (!$members_set)
        @php $members_set = auth()->user()->members ; //$member_obj->get_members_by_owner_user_id($_SESSION->loggedInUser); @endphp
    @endif
    @if ($members_set)
        @foreach ($members_set as $member)
            @php // $member_type = 'member';
            /*if ($member->member_is_spouse($member)) {
                $member_type = 'spouse';
            } elseif ($member->member_is_dependent($member)) {
                $member_type = 'dependent';
            } elseif ($member->member_is_beneficiary($member)) {
                $member_type = 'current_beneficiary';
            } elseif ($member_obj->member_is_emergency_contact($member)) {
                $member_type = 'current_emergency_contact';
            }*/
            $member_type = $member->member_type($member);
            $member_roles = $member->roles ; // explode('|', $member->member_role_in_estate);
            $member_roles_set = $member->role_ids_array($member_roles) ; // explode('|', $member->member_role_in_estate);
            $is_shared_by_role = array_intersect($member_roles_set,$document_shared_roles);
            $is_shared_by_member_all = $document->document_share_members_all == 1 ? true : false ;

            $relation_ship_of_member =  $member->member_relationship_to_owner ? \App\Relationship::get_relationship_name_by_relationship_id($member->member_relationship_to_owner) : '';
            $image_folder_url =  Config::get('constants.MEMBER_IMG_URL');
            $member_image = trim($member->member_image) != '' ? $image_folder_url . $member->member_image . '?rand=' . rand(1, 1000) : Config::get('constants.DEFAULT_AVATAR_IMAGE_URL');

            $roles_set_other = array();
            $member_roles = $member->roles ;
            $main_role =  $member->main_role($member_roles) ;
            $roles_set_first = $main_role != null  ?  $main_role->role_name : "";
            $roles_set_first = $roles_set_first ? $roles_set_first : 'No Role';

            @endphp
            <a class="document-cardLayout" style="overflow:hidden">
                <span
                        class="document-relationship">{{ $relation_ship_of_member }}</span>
                <img src="{{ $member_image }}" class="pic ximg-fluid xrounded-circle img-thumbnail document-img"
                     alt="">
                <div class="name">{{ $member->member_first_name . ' ' . $member->member_last_name }}
                    <p class="key-roles">
                        {{-- @php if ($member_roles_set) {
                             $roles_set_card_temp = array();
                             foreach ($member_roles_set as $role_id) {
                         @endphp
                         @php $roles_set_card_temp[] = $roles_obj->get_role_name_by_role_id($role_id) @endphp
                         @php
                             }
                             //echo implode(' , ', $roles_set_card_temp);
                             echo $roles_set_card_temp[0];
                         } @endphp--}}
                        {{$roles_set_first}}
                    </p>
                </div>
                <div class="icon">
                    <div class="form-check">
                        @php
                            $is_shared_by_clicking = \App\DocumentShare::is_shared($document_shares_set, $document_id, $member->member_id, $member_type);
                            $is_shared_by_category = false;// $document_obj->is_member_document_owner_by_category($_POST->document_id,$member->member_id,$member_type);
                            $checked_document_shared = $is_shared_by_clicking || $is_shared_by_category || $is_shared_by_role || $is_shared_by_member_all ? 'checked="checked"' : '';
                            $disabled_document_shared = $is_shared_by_category ||  $is_shared_by_role || $is_shared_by_member_all ? 'disabled="disabled"' : '';

                        @endphp
                        <input type="checkbox" class="form-check-input share_document_to_this_member"
                               data-document-id="{{ $document_id }}"
                               data-document-member-type="{{ $member_type }}"
                               data-document-member-id="{{ $member->member_id }}"
                               id="{{ $member_type }}_{{ $member->member_id }}"
                                {{ $checked_document_shared }}
                                {{ $disabled_document_shared }}
                        >
                        <label class="form-check-label"
                               for="{{ $member_type }}_{{ $member->member_id }}"
                               id="share_label_{{ $member_type }}_{{ $member->member_id }}">{{ $checked_document_shared ? 'Shared' : 'Share' }}</label>
                    </div>
                </div>
            </a>
        @endforeach
    @endif
</div>


<!-- add script for .innerHTML -->