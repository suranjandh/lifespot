@php
    $member_id = \Illuminate\Support\Facades\Input::get('member_id');
    $document_share_obj = new \App\DocumentShare();
    $shared_documents_on_member = $document_share_obj->get_other_estate_documents($member_id);

@endphp
<ul style="list-style-type:disc">
    @if ($shared_documents_on_member)
        @foreach ($shared_documents_on_member as $k => $document)
            <li>{{ $document['document_title']}}</li>
        @endforeach
    @else
        <li>Currently no documents are being shared</li>
    @endif
</ul>