@php
    //include dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/lib/includes/header_include.php';

    //$categories_obj = new CategoryModel();
    $category = \App\Category::find(\Illuminate\Support\Facades\Input::get('document_category'));
    $sub_categories = $category->category_subs ;//$categories_obj->get_sub_categories_by_category($_POST->document_category);

    //$document_category_sub_auto = isset($_POST->document_category_sub_auto) && $_POST->document_category_sub_auto > 0 ?
        //$_POST->document_category_sub_auto : false;
    $document_category_sub_auto = \Illuminate\Support\Facades\Input::get('document_category_sub_auto');
    $document_category_sub_auto = $document_category_sub_auto > 0 ? $document_category_sub_auto : false ;
@endphp
@if($sub_categories)
    @if(!$document_category_sub_auto)@php echo '<option value="0" selected="selected">Select</option>';@endphp
    @endif
    @foreach($sub_categories as $v)
        @if ($document_category_sub_auto && $v['category_sub_id'] != $document_category_sub_auto)
            @php continue; @endphp
        @endif
        <option value="{{$v['category_sub_id']}}">{{html_entity_decode($v['category_sub_name'])}}</option>
    @endforeach
@else
    @php echo 0 ;die();@endphp
@endif