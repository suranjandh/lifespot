@php

    //include '../../../../lib/includes/header_include.php';
    //$document_list_obj = new DocumentListModel();
    //$member_obj = new MemberModel();
    //$documents = $document_list_obj->get_documents_full_list();
    $documents = \App\DocumentList::get_documents_full_list();
    $not_applicable_documents = \App\DocumentList::get_not_applicable_documents();// $document_list_obj->get_not_applicable_documents();

@endphp
<table id="Doc_Center_All" class="table table-striped table-bordered table-sm docTableFull"
       cellspacing="0" width="100%">
    <span class="tableTitle"></span>
    <thead>
    <tr>
        <th class="th-sm text-center">*N/A</th>
        <th class="th-sm text-center"><i class="fas fa-check text-info mr-2"></i>Uploaded</th>
        <th class="th-lg">Belongs To</th>
        <th class="th-lg">Document Type</th>
        <th class="th-lg">Document Title</th>
        <th class="th-sm">Add</th>
        <th class="th-sm">View</th>
        <th class="th-sm">Share</th>
        <th class="th-sm">Remove</th>
        <th class="th-md">Date Added</th>
        <th class="th-lg">Notes</th>
    </tr>
    </thead>
    <tbody>
    @php
        // needs to check the DB to see whether or not the requested document content type was uploaded.  If true, then display a check mark, if false then display in red color "Missing".  If the far left column (N/A) is checked marked, then the document content type does not apply to this user's estate and therefore does not display at all.
        $counter = 0;
    @endphp
    @if($documents)
    @foreach ($documents as $document)
        @php
            $counter++ ;
            //$isUpload = false;
            //$isDocUploaded = $isUpload ? '<i class="fas fa-check text-info"></i>' : '<span class="red-text">Missing</span>';
            $isDocUploaded = $document->document_id ? true : false;
            $hash = \App\DocumentList::get_documents_not_applicable_hash($document);
            $notApplicable = in_array($hash, $not_applicable_documents) ? true : false;
            $isDocUploaded_text = $isDocUploaded ? '<i class="fas fa-check text-info"></i>' : '<span class="red-text">Missing</span>';
            $checked = $notApplicable ? 'checked="checked"' : '';
        @endphp
        @if ($notApplicable && !$isDocUploaded)
            @php $isDocUploaded_text = '<span class="black-text">N/A</span>'; @endphp
        @endif

        <tr class="document_tr">
            <td>
                <div class="form-check">
                    @if (!$isDocUploaded)
                        <input
                                {{ $checked }}
                                type="checkbox" class="form-check-input document_not_applicable_set"
                                id="tableMaterialCheck{{$counter}}"
                                data-hash-value="{{ $hash }}">
                        <label class="form-check-label" for="tableMaterialCheck{{$counter}}"></label>
                    @endif
                </div>
            </td>
            <td class="text-center" id="tableMaterialCheck{{$counter}}Uploaded">{!!  $isDocUploaded_text!!}</td>
            <td>{{ $document->member_first_name ? $document->member_first_name : '' }}</td>
            <td>{{ $document->document_content_type_name ? $document->document_content_type_name : '' }}</td>
            <td>{{ $document->document_title ? $document->document_title : '' }}</td>
            <td class="text-center">
                <a style="{{$notApplicable?'display:none;':'display:block;' }}"
                   id="tableMaterialCheck{{$counter}}Upload" class="document_tabs_open"
                   data-document-category="{{ $document->category_key }}"
                   data-document-category-sub="{{ $document->document_content_type_sub_category }}"
                   data-document-category-sub-sub="{{ $document->member_id }}"
                   data-document-category-sub-sub-sub="{{ $document->member_is_dependent == 1 ? '1' : '' }}"
                   data-document-content-type="{{ $document->document_content_type_id ? $document->document_content_type_id : '' }}"
                ><i class="fas fa-plus text-info"></i></a>
            <td class="text-center">@if ($document->document_id)<a
                        data-document-file="{{ $document->document_file }}"
                        data-document-title="{{ $document->document_title }}"
                        data-toggle="tooltip" title="View Document" class="view_document_popup"
                ><i
                            class="fa fa-eye text-info"></i></a>@endif</td>
            <td class="text-center">@if ($document->document_id) <a

                        data-toggle="tooltip" title="Share Document" class="share_document_to_member tooltips"
                        data-document-id="{{ $document->document_id }}"
                        data-document-title="{{ $document->document_title }}"
                        data-document-share-from-list="1"
                ><i
                            class="fa fa-link text-info"></i></a>@endif</td>
            <td class="text-center">@if ($document->document_id)<a
                        class="delete_this_document"
                        data-document-id="{{ $document->document_id }}"
                        data-document-title="{{ $document->document_title }}"
                ><i
                            class="fa fa-trash text-info"></i></a>@endif</td>
            <td>{{ $document->document_created ? date('m/d/Y', strtotime($document->document_created)) : '' }}</td>
            <td data-notes="{{$document->document_notes? $document->document_notes.'<a class=\'less_notes\' style=\'color:blue;font-size:10px\'> &lt;  &LT; Less </a>':''}}"
                data-notes-less="{{$document->document_notes? substr($document->document_notes, 0, 15). ' <a class=\'more_notes\' style=\'color:blue;font-size:10px\' > &gt; &GT; More </button>':''}}"
            >{{ $document->document_notes && strlen($document->document_notes) > 10 ? substr($document->document_notes, 0, 15) . ' <a class="more_notes" style="color:blue;font-size:10px"> &gt; &GT; More</a>' : $document->document_notes }}</td>
        </tr>

    @endforeach
        @else
        <td colspan="11">No documents for query</td>
    @endif
    </tbody>


</table>