@php
// include dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/lib/includes/header_include.php';

//$document_obj = new DocumentModel();
/*$document_category_sub_auto = isset($_POST->document_category_sub_auto) && $_POST->document_category_sub_auto > 0 ?
    $_POST->document_category_sub_auto : false;
$document_content_type_auto = isset($_POST->document_content_type_auto) && $_POST->document_content_type_auto > 0 ?
    $_POST->document_content_type_auto : false;*/
  $document_category_sub_auto = \Illuminate\Support\Facades\Input::get('document_category_sub_auto');
        $document_category_sub_auto = $document_category_sub_auto > 0 ? $document_category_sub_auto : false ;
  $document_content_type_auto = \Illuminate\Support\Facades\Input::get('document_content_type_auto');
        $document_content_type_auto = $document_content_type_auto > 0  ? $document_content_type_auto : false ;

@endphp
@if($document_content_type_auto == false)

<option value="" xdisabled selected>Choose option</option>
     @endif
@if($document_category_sub_auto)
 @php  $document_content_types = \App\DocumentContentType::where('document_content_type_sub_category',$document_category_sub_auto)->get();//$document_obj->get_document_content_types_by_sub_category($document_category_sub_auto);
    @endphp
    @foreach ($document_content_types as  $document_content_type)
        @if($document_content_type_auto && $document_content_type->document_content_type_id != $document_content_type_auto ) @php continue; @endphp
        @endif
        <option value="{{ $document_content_type->document_content_type_id }}">{{ $document_content_type->document_content_type_name }}</option>
    @endforeach
@endif