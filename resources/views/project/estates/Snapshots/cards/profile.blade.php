@php

$profile = auth()->user()->profile ; // $profile->get_profile_by_profile_user_id($userId);
$estate = auth()->user()->estate ;//$estate->get_estate_by_estate_user_id($userId);
@endphp
<div class="card border-secondary mb-3 member_content_box cancel_click" xstyle="max-width: 20rem;" style="display:none;"
     data-member-member-id="{{ $profile->profile_id }}" data-member-id="{{ $profile->profile_id }}"
     data-member-type="profile"
     data-member-name="{{ $profile->get_profile_full_name($profile) }}"
    >
    <div class="card-header">My Profile
        <a href="#" class="open_account_info_share_overview"><img class="float-right xmr-3" data-toggle="tooltip" title="Share"
                                                         src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-share.png"
                                                         alt=""></a>
        <a href="#"
           onclick="window.open('{{ route('print_snapshot') }}?print=profile');"
            ><img class="float-right mr-3" data-toggle="tooltip" title="Print"
                  src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-print.png"
                  alt=""></a>
        <a href="#"
           class="document_tabs_open"
           data-document-category="1"
           data-document-category-sub="2"
           data-document-category-sub-sub="0"
            ><img class="float-right mr-3" data-toggle="tooltip" title="Documents"
                  src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-documents.png" alt=""></a>
        <a href="#"
           class="member_content_box" data-member-member-id="{{ $profile->profile_id }}"
           data-member-id="{{ $profile->profile_id }}" data-member-type="profile"
            ><img class="float-right mr-3" data-toggle="tooltip" title="Edit"
                  src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-edit.png"
                  alt=""></a>
    </div>
    <div class="card-body text-secondary">
        <h5 class="card-title">{!! Helper::fill_empty_string($profile->get_profile_full_name($profile)) !!}</h5>
        <span class=" main_info">LifeSpot Owner, Co-Trustee</span><br>

                  <span class="secondary_info">
                      <span class="info_emphasis">Address:</span>
                      @php
                      $estate_address = $estate->get_estate_location($estate);
                      @endphp
                      <span
                          class="details">{!!  Helper::fill_empty_string($estate_address)!!}</span>
                    </span>

                  <span class="secondary_info">
                      <span class="info_emphasis">Email:</span>
                      <span class="details">{!! Helper::fill_empty_string($profile->profile_email) !!}
                          <span class="info_emphasis ml-4">Phone:</span>
                          {!! Helper::fill_empty_string($profile->profile_phone, 'phone') !!}
                          &nbsp; &nbsp; @if (trim($profile->profile_phone2) != '') {!!  Helper::fill_empty_string($profile->profile_phone2, 'phone')!!}@endif</span>
                  </span>

                  <span class="secondary_info">
                      <span class="info_emphasis">About:</span>
                      <span
                          class="details">Birthday {!! Helper::fill_empty_string($profile->get_profile_birthday($profile), 'date')!!}
                          &nbsp;&nbsp;  {!! Helper::fill_empty_string(Helper::get_marital_status_name($profile->profile_maritalStatus))!!}
                          &nbsp; &nbsp; {!! Helper::fill_empty_string($profile->profile_dependents, 'number') !!}
                          Dependents &nbsp; &nbsp; No Pets</span>
                  </span>


                  <span class="secondary_info">
                      <span class="info_emphasis">Notes: </span>
                      <span class="details">{!! Helper::fill_empty_string($profile->profile_profile_notes)!!}</span>
                  </span>

    </div>
</div>
