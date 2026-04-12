<tr><td>Email:</td><td>{!!  Helper::fill_empty_string($member->member_email) !!}</td><td></td></tr>
<tr>
    <td>Phone:</td><td class="member_info">{!! Helper::fill_empty_string($member->member_phone, 'phone') !!}</td>
    <td>
        <div class="member_content_box cancel_click"
             data-member-member-id="{{ $member->member_id }}" data-member-id="{{ $member->member_id }}"
             data-member-type="{{ $member_type }}"
             data-member-name="{{ $member->get_member_full_name($member) }}"
             style="float: right"    >
            <a href="#" class="member_share_modal_open"><img class="float-right xmr-3" data-toggle="tooltip"
                                                             title="Share"
                                                             src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-share.png"
                                                             alt=""></a>
            <a href="#"
               onclick="window.open('{{ route('print_snapshot')}}?print=member&id={{ $member->member_id }}');"
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
               data-member-member-id="{{ $member->member_id }}" data-member-id="{{ $member->member_id }}"
               data-member-type="{{ $member_type }}"
               data-member-name="{{ $member->get_member_full_name($member) }}"
            ><img class="float-right mr-3" data-toggle="tooltip" title="Edit"
                  src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}icons8-edit.png"
                  alt=""></a>
        </div></td>
</tr>
<tr><td>Notes:</td><td class="member_info">{!! Helper::fill_empty_string($member->member_spacial_notes) !!}</td><td></td></tr>
