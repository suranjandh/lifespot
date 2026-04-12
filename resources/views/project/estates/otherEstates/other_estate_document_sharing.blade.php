<table class="table table-bordered table-striped">
    @if ($shared_documents)
    @foreach($shared_documents as $k => $document)
        @php $document = (object)$document ; @endphp
        <tr>
            <td class="document_list_span">{{$k+1}}</td>
            <td class="document_list_span_title">{{$document->document_title}}</td>
            <td class="document_list_span">{{date('m/d/Y',strtotime($document->document_updated))}}</td>
            <td class="document_list_span view_document_popup"
                data-document-file="{{ $document->document_file }}"
                data-document-title="{{ $document->document_title }}"><i class="fas fa-eye"></i></td>
        </tr>
    @endforeach
    @else
        <tr>
            <td>Currently no documents are being shared</td>
        </tr>
    @endif
</table>