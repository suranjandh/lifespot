@if ($document_search_result)
    <ul id="document-list">
        @foreach ($document_search_result as $document)
            @php $document = $document->toArray(); @endphp
            <li class='search_li view_document_popup'
                data-document-file='{{$document['document_file']}}'
                data-document-title='{{$document['document_title']}}'
            >
                <ul>
                    <li><span class='search_li_title'><i class='fa fa-file' style='color: rgba(0, 0, 0, 0.41)'
                                                         aria-hidden='true'></i>
 {{$document['document_title'] }}</span>
                        <span class='search_li_date'><i class='fa fa-calendar' style='color: rgba(0, 0, 0, 0.37)'
                                                        aria-hidden='true'></i>

{{date('M d , Y', strtotime($document['document_updated'])) }}</span></li>
                    <li><span class='search_li_owner'><i class='fas fa-user' style='color: rgba(0, 0, 0, 0.27)'
                                                         aria-hidden='true'></i>
{{ $document['profile_first_name'] }} {{$document['profile_last_name']}}</span></li>
                </ul>
            </li>
        @endforeach
    </ul>
@endif
