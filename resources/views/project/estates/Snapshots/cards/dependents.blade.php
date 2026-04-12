@php

    $dependents = auth()->user()->dependents ;// $dependent->get_dependents_by_user_id($userId);
    if ($dependents == null || count($dependents) == 0) {
        die();
    }

@endphp
<div class="card border-info mb-3" xstyle="max-width: 20rem;" style="display:none;">
    <div class="card-header">My Dependents

        <a href="#"
           onclick="window.open('{{ route('print_snapshot') }}?print=dependents');"
        ><img class="float-right mr-3" data-toggle="tooltip" title="Print"
              src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-print.png"
              alt=""></a>
        <a href="#"
           class="dependents_content_box" data-member-id="0" id="addNewdependent"
        ><img class="float-right mr-3" data-toggle="tooltip" title="Add New"
              src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-plus_math.png" alt=""></a>
    </div>
    <div class="card-body text-info">
        @foreach ($dependents as $k => $dependent)
            @php
                $dependent_type = 'dependent';

                $data_document_category = 2;
                $data_document_category_sub = 5;
                $data_document_category_sub_sub = $dependent->member_id;
                $data_document_category_sub_sub_sub = 1;
            @endphp
            <h5 class="card-title">
            <span class="expander" data-toggle="collapse" href="#dependent{{ $k }}" aria-expanded="false"
                  aria-controls="dependent1">{!! Helper::fill_empty_string($dependent->get_member_full_name($dependent)) !!}</span>
            </h5>
            <div class="collapse member_content_box cancel_click" id="dependent{{ $k }}"
                 data-member-member-id="{{ $dependent->member_id }}" data-member-id="{{ $dependent->member_id }}"
                 data-member-type="{{$dependent_type}}"
                 data-member-name="{{ $dependent->get_member_full_name($dependent) }}"
            >
                <a href="#" class="member_share_modal_open"><img class="float-right xmr-3" data-toggle="tooltip"
                                                                 title="Share"
                                                                 src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-share.png"
                                                                 alt=""></a>
                <a href="#"
                   onclick="window.open('{{ route('print_snapshot') }}?print=dependent&id={{ $dependent->member_id }}');"
                ><img class="float-right mr-3" data-toggle="tooltip" title="Print"
                      src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-print.png"
                      alt=""></a>
                <a href="#"
                   class="document_tabs_open"
                   data-document-category="{{$data_document_category}}"
                   data-document-category-sub="{{$data_document_category_sub}}"
                   data-document-category-sub-sub="{{ $data_document_category_sub_sub }}"
                   data-document-category-sub-sub-sub="{{ $data_document_category_sub_sub_sub }}"
                ><img class="float-right mr-3" data-toggle="tooltip" title="Documents"
                      src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-documents.png" alt=""></a>
                <a href="#" class="member_content_box"
                   data-member-member-id="{{ $dependent->member_id }}" data-member-id="{{ $dependent->member_id }}"
                   data-member-type="{{$dependent_type}}"
                   data-member-name="{{ $dependent->get_member_full_name($dependent) }}"
                ><img class="float-right mr-3" data-toggle="tooltip" title="Edit"
                      src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-edit.png"
                      alt=""></a>
                <span
                        class=" main_info">{{ $dependent->get_member_role_names_string($dependent) }}</span><br>
                <span class="secondary_info">
                        <span class="info_emphasis">Address:</span>
                            <span
                                    class="details details-align">{!! Helper::fill_empty_string($dependent->get_member_address($dependent)) !!}</span>
                        </span>
                <span class="secondary_info">
                            <span class="info_emphasis">Email:</span>
                            <span class="details">{!! Helper::fill_empty_string($dependent->member_email) !!}
                                <span class="info_emphasis ml-4">Phone:</span>
                                {!! Helper::fill_empty_string($dependent->member_phone, 'phone') !!}
                                &nbsp; &nbsp; @if(trim($dependent->member_phone2 ) != ''){!! Helper::fill_empty_string($dependent->member_phone2, 'phone') !!}@endif</span>
                        </span>
                <span class="secondary_info">
                            <span class="info_emphasis">About:</span>
                            <span
                                    class="details">Birthday {!!  Helper::fill_empty_string($dependent->get_member_birth_day($dependent), 'date') !!}</span>
                        </span>
                <span class="secondary_info">
                            <span class="info_emphasis xmissing_info">Notes: </span>
                            <span
                                    class="details">{!!  Helper::fill_empty_string($dependent->member_spacial_notes) !!}</span>
                        </span>

                @php
                    // $dependent_medical = $dependent_medical->get_dependent_medical_by_member_id($dependent->member_id);
                    // $dependent_medical_primary_doctor = $dependent_medical ? $dependent_medical->dependent_medical_primary_care : '';
                    // $dependent_medical_phone = $dependent_medical ? $dependent_medical->dependent_medical_phone : '';
                    $dependent_medical = $dependent->dependent_medical ;
                     $dependent_medical_primary_doctor = $dependent_medical ? $dependent_medical->dependent_medical_primary_care : '';
                     $dependent_medical_phone = $dependent_medical ? $dependent_medical->dependent_medical_phone : '';

                     //$guardian_member_row = $guardian_member->get_guardian_member_row_by_dependent_member_id($dependent->member_id);
                     //$guardian_member_guardian = $guardian_member_row ? $guardian_member_row->guardian_member_guardian : 0;
                     $guardian_member = $dependent->guardian;

                    $guardian_member_full_name = $guardian_member ? $dependent->get_member_full_name($guardian_member) : '';
                    $guardian_member_phone = $guardian_member ? $guardian_member->member_phone : '';

                     // $dependent_school = $dependent_school->get_dependent_school_by_member_id($dependent->member_id);
                     $dependent_school = $dependent->dependent_school;
                     $dependent_school_phone = $dependent_school ? $dependent_school->dependent_school_phone : '';
                     $dependent_school_name = $dependent_school ? $dependent_school->dependent_school_name : '';

                @endphp
                <span class="secondary_info">
                            <span class="info_emphasis">Medical:</span>
                            <span
                                    class="details">Primary Doctor: {!! Helper::fill_empty_string($dependent_medical_primary_doctor)!!}
                                &nbsp;&nbsp;  Phone:  {!! Helper::fill_empty_string($dependent_medical_phone, 'phone') !!}</span>

                        </span>

                <span class="secondary_info">
                            <span class="info_emphasis">Guardian:</span>
                            <span
                                    class="details">
                                @if(trim($guardian_member_full_name) != '')
                                    Name: {!! Helper::fill_empty_string($guardian_member_full_name) !!}
                                    &nbsp;&nbsp;
                                    Phone: {!! Helper::fill_empty_string($guardian_member_phone, 'phone') !!} @endif</span>
                        </span>
                <span class="secondary_info">
                            <span class="info_emphasis">School:</span>
                            <span
                                    class="details">@if(trim($dependent_school_name) != '')
                                    Name: {!! Helper::fill_empty_string($dependent_school_name) !!}
                                    &nbsp;&nbsp;
                                    Phone: {!! Helper::fill_empty_string($dependent_school_phone, 'phone') !!} @endif</span>
                        </span>
                <br>
            </div>
        @endforeach
    </div>
    <!-- card-body -->
</div>