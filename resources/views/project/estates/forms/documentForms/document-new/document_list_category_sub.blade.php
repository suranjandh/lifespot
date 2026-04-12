<style>
    .clearListStyles_subCategory {
        list-style: none;
    }
</style>
@php
    //$category_obj = new CategoryModel();
    $prev_category_sub = 0;
    $documents_category_sub_tree = \App\Document::get_documents_by_category_sub_tree(\Illuminate\Support\Facades\Input::get('document_category_sub'));

@endphp
@if ($documents_category_sub_tree)
    @foreach ($documents_category_sub_tree as $k => $document_category)
        @php $first_element_category = current(current(current($document_category)));
        @endphp
        <div class="card" style="margin-top: 10px">
            <div class="card-body">
                <a class="load_document_main right" style="float: right">
                    <button class="btn btn-primary btn-sm">Back</button>
                </a>
                <h3 class="card-title">
                    {{ $first_element_category['category_name'] }}</h3>
                <ul class="clearListStyles_subCategory">
                    <li>
                        @php
                            $document_counter = 0;
                        @endphp
                        @foreach ($document_category as $document_category_sub)
                            @php  $first_element_category_sub = current(current($document_category_sub));

                            @endphp
                            <h4 class="card-title">
                                {{ $first_element_category_sub['category_sub_name'] ? $first_element_category_sub['category_sub_name'] : 'No Sub Category' }}
                                <a data-toggle="tooltip" title="Add Document" class="document_tabs_open"
                                   style="margin-left: 20px"
                                   data-document-category="{{$first_element_category['category_id']}}"
                                   data-document-category-sub="{{$first_element_category_sub['category_sub_id']}}"
                                   data-document-category-sub-sub="0">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </h4>
                            <ul>
                                @foreach ($document_category_sub as $document_category_sub_sub)
                                    @php $first_element_category_sub_sub = current($document_category_sub_sub);
                                    @endphp
                                    <h6 class="card-title">
                                        @php
                                            $category_sub_sub_name = '' ;
                                        @endphp
                                        @if($first_element_category_sub_sub['document_category_sub_sub']  > 0)
                                            @php
                                                $category_sub_sub_data = \App\CategorySub::get_sub_sub_categories_by_id(
                                                    $first_element_category_sub_sub['document_category_sub_sub'],$first_element_category_sub['category_sub_id']) ;
                                                $category_sub_sub_name = $category_sub_sub_data &&
                                                $category_sub_sub_data['category_sub_name']
                                                    ? $category_sub_sub_data['category_sub_name']: '';
                                            @endphp
                                        @endif
                                        {{$category_sub_sub_name}}</h6>
                                    <table>
                                        @foreach ($document_category_sub_sub as $document)
                                            @php $document_counter++;

                                            @endphp


                                            <tr class="document_display_element_{{ $document['document_id'] }}">
                                                <td style="color:#4285f4!important;text-align: left;width: 30px">
                                                    {{ $document_counter }}</td>
                                                <td style="width: 200px;text-align: left">{{ $document['document_title']}}</td>
                                                <td data-toggle="tooltip" title="View Document"><a
                                                            style="margin-left: 10px"
                                                            class="view_document_popup tooltips"
                                                            data-document-file="{{ $document['document_file'] }}"
                                                            data-document-title="{{ $document['document_title'] }}"><i
                                                                style="color:#4285f4!important" class="fas fa-eye"></i>
                                                    </a></td>
                                                <td><a style="color:#4285f4!important;margin-left: 10px" data-toggle="tooltip"
                                                       title="Share Document"
                                                       class="share_document_to_member tooltips"
                                                       data-document-id="{{ $document['document_id'] }}"
                                                       data-document-title="{{ $document['document_title'] }}">
                                                        <i style="color:#4285f4!important" class="fas fa-share-alt"></i>
                                                    </a></td>
                                                <td data-toggle="tooltip" title="Delete Document"><a
                                                            style="margin-left: 10px"
                                                            class="delete_this_document tooltips"
                                                            data-document-id="{{ $document['document_id']}}"
                                                            data-document-title="{{ $document['document_title']}}"

                                                    ><i class="far fa-trash-alt"></i></a></td>

                                            </tr>
                                        @endforeach
                                    </table>
                                @endforeach
                            </ul>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
    @endforeach
@else
    <div class="card">
        <div class="card-body">
            <a class="load_document_main right" style="float: right">
                <button class="btn btn-primary btn-sm">Back</button>
            </a>
            No Documents To Show
        </div>
    </div>
@endif


<script>
    // Tooltips Initialization
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>