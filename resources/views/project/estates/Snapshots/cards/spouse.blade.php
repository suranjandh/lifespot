@php


$estate =  auth()->user()->estate ; // $estate->get_estate_by_estate_user_id($userId);
$spouse = array();
if (\App\Profile::is_married()) {
    $spouse = auth()->user()->spouse ; //$member->find_spouse($userId,true);
}
@endphp
<div class="card border-success mb-3 member_content_box cancel_click" xstyle="max-width: 20rem;" style="display:none;"
     data-member-member-id="{{ $spouse ? $spouse->member_id : 0 }}"
     data-member-id="{{ $spouse ? $spouse->member_id : 0 }}"
     data-member-type="spouse"
     data-member-name="{{ $spouse ? $spouse->get_member_full_name($spouse) : 0 }}"
    >
    <div class="card-header">My Spouse
        @if ($spouse)
            <a href="#" class="member_share_modal_open"><img class="float-right xmr-3" data-toggle="tooltip"
                                                             title="Share"
                                                             src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-share.png"
                                                             alt=""></a>
            <a href="#"
               onclick="window.open('{{ route('print_snapshot') }}?print=spouse');"
                ><img class="float-right mr-3" data-toggle="tooltip" title="Print"
                      src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-print.png"
                      alt=""></a>
            <a href="#"
               class="document_tabs_open"
               data-document-category="7"
               data-document-category-sub="25"
               data-document-category-sub-sub="{{ $spouse ? $spouse->member_id : '0' }}"
               data-document-category-sub-sub-sub="0"
                ><img class="float-right mr-3" data-toggle="tooltip" title="Documents"
                      src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-documents.png" alt=""></a>
            <a href="#" class="member_content_box"
               data-member-member-id="{{ $spouse->member_id }}" data-member-id="{{ $spouse->member_id }}"
               data-member-type="spouse"
               data-member-name="{{ $spouse->get_member_full_name($spouse) }}"
                ><img class="float-right mr-3" data-toggle="tooltip" title="Edit"
                      src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-edit.png"
                      alt=""></a>
        @endif
    </div>
    <div class="card-body text-success">
        @if ($spouse)
            <h5 class="card-title">{!! Helper::fill_empty_string($spouse->get_member_full_name($spouse)) !!}</h5>
            <span class=" main_info">{{ $spouse->get_member_role_names_string($spouse) }}</span><br>
            @php
            $estate_address = $estate->get_estate_location($estate);
            @endphp
            <span class="secondary_info">
                        <span class="info_emphasis">Address:</span>
                        <span
                            class="details">{!! Helper::fill_empty_string($estate_address) !!}</span>
                    </span>

            <span class="secondary_info">
                        <span class="info_emphasis">Email:</span>
                        <span class="details">{!! Helper::fill_empty_string($spouse->member_email)!!}
                            <span class="info_emphasis ml-4">Phone:</span>
                            {!! Helper::fill_empty_string($spouse->member_phone, 'phone')!!}
                            &nbsp; &nbsp; @if (trim($spouse->member_phone2) != '') {!! Helper::fill_empty_string($spouse->member_phone2, 'phone')!!}@endif</span>
                    </span>

            <span class="secondary_info">
                        <span class="info_emphasis">About:</span>
                        <span
                            class="details">Birthday {!! Helper::fill_empty_string($spouse->get_member_birth_day($spouse), 'date')!!}
                            </span>
                    </span>

            <span class="secondary_info">
                        <span class="info_emphasis">Notes: </span>
                        <span class="details">{!! Helper::fill_empty_string($spouse->member_spacial_notes) !!}</span>
                    </span>
        @else
            No Spouse Listed
        @endif
    </div>
</div>
