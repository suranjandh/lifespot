@php

    $pets = auth()->user()->pets ;// $pet->get_pets_by_owner_user_id($userId);

@endphp
<div class="card border-primary mb-3" xstyle="max-width: 20rem;">
    <div class="card-header">My Pets
        <!--<a href="#"><img class="float-right xmr-3" data-toggle="tooltip" title="Share" src="../img/icons8-share.png"
                         alt=""></a>-->
        <a href="#"
           onclick="window.open('{{route('print_snapshot')  }}?print=pet');"
        ><img class="float-right mr-3" data-toggle="tooltip" title="Print"
              src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-print.png"
              alt=""></a>
        <!--<a href="#"><img class="float-right mr-3" data-toggle="tooltip" title="Add New"
                         src="../img/icons8-plus_math.png" alt=""></a>-->
    </div>
    <br>
    <div class="card-body member-box text-primary xmt-0 pt-0">

        @if ($pets && count($pets) > 0)


            @foreach ($pets as $k => $pet)
                @php
                    $rand = rand(1,50000);
                $name = $pet->pet_name ;
                    $data_document_category = 2;
                    $data_document_category_sub = 7;
                    $data_document_category_sub_sub = $pet->pet_id;
                    $data_document_category_sub_sub_sub = 1;
                @endphp
                <h6 class="card-title member-title mb-2">
                              <span class="expander" data-toggle="collapse" href="#member{{$rand.$pet->pet_id}}{{ $k }}"
                                    aria-expanded="false"
                                    aria-controls="member1">
                                  <span class="memName"
                                        style="width: 200px">{!!  Helper::fill_empty_string($pet->pet_name) !!}</span>
                                  <span class="member_info memInfoStyle"
                                        style="width: 300px"></span>
                              </span>
                </h6>
                <!-- class="collapse" id="member1" -->
                <div class="collapse" id="member{{$rand.$pet->pet_id}}{{ $k }}" style="margin-left: 30px">
                    <table class="estate_member_table">

                        <tr>
                            <td>Description:</td>
                            <td class="member_info">{!! Helper::fill_empty_string($pet->pet_description) !!}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Tag Id:</td>
                            <td>{!! Helper::fill_empty_string($pet->pet_tag_id) !!}</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Doctor Name:</td>
                            <td class="member_info">{!! Helper::fill_empty_string($pet->pet_doctor_name) !!}</td>
                            <td>
                                <div class="member_content_box cancel_click"
                                     data-member-member-id="{{ $pet->pet_id }}" data-member-id="{{ $pet->pet_id }}"
                                     data-member-type="pet"
                                     data-member-name="{{ $pet->pet_name }}"
                                     style="float: right">
                                    <a href="#" class="member_share_modal_open"><img class="float-right xmr-3"
                                                                                     data-toggle="tooltip"
                                                                                     title="Share"
                                                                                     src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-share.png"
                                                                                     alt=""></a>
                                    <a href="#"
                                       onclick="window.open('{{ route('print_snapshot') }}print=pet&id={{ $pet->pet_id }}');"
                                    ><img class="float-right mr-3" data-toggle="tooltip" title="Print"
                                          src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-print.png"
                                          alt=""></a>
                                    <a href="#"
                                       class="document_tabs_open"
                                       data-document-category="{{ $data_document_category }}"
                                       data-document-category-sub="{{ $data_document_category_sub }}"
                                       data-document-category-sub-sub="{{ $data_document_category_sub_sub }}"
                                       data-document-category-sub-sub-sub="{{ $data_document_category_sub_sub_sub }}"
                                    ><img class="float-right mr-3" data-toggle="tooltip" title="Documents"
                                          src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-documents.png" alt=""></a>
                                    <a href="#" class="member_content_box"
                                       data-member-member-id="{{ $pet->pet_id }}" data-member-id="{{ $pet->pet_id }}"
                                       data-member-type="pet"
                                       data-member-name="{{ $pet->pet_name }}"
                                    ><img class="float-right mr-3" data-toggle="tooltip" title="Edit"
                                          src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-edit.png"
                                          alt=""></a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Doctor Phone:</td>
                            <td class="member_info">{!! Helper::fill_empty_string($pet->pet_veterinarian_phone, 'phone') !!}</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Birthday:</td>
                            <td class="member_info">{!! Helper::fill_empty_string($pet->get_pet_birthday($pet), 'date') !!}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Notes:</td>
                            <td class="member_info">{!! Helper::fill_empty_string($pet->pet_notes) !!}</td>
                            <td></td>
                        </tr>


                    </table>


                    <br>
                </div>
            @endforeach
        @else
            <br><br>No Pets Listed
        @endif
    </div>
</div>

<!-- card-body -->
