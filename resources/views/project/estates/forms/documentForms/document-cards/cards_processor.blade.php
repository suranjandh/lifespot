@php
    //include dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/lib/includes/header_include.php';
    //$userId = $_SESSION->loggedInUser;

    //$categories_obj = new CategoryModel();
    //$documents_obj = new DocumentModel();
    $category_tree = \App\CategorySub::category_tree(); // $categories_obj->get_category_tree();
    $document_tree_counts = \App\Document::get_document_tree_counts(); // $documents_obj->get_document_tree_counts($userId);
    $document_category_last_updated = \App\Document::get_document_category_last_updated(); // $documents_obj->get_document_category_last_updated($userId);

    $card_deck_start = '<div class="card-deck">';
    $card_deck_end = '</div>';

    $category_counter = 0;
@endphp
@foreach ($category_tree as $category)
    @if ($category_counter % 3 == 0)
        @php echo $card_deck_start; @endphp
    @endif
    @php
        $category_counter++;
    $first_element = current($category);
    @endphp
    <style>
        .docCenterStyles {
            list-style: none;
        }

        .docCardHover {
            cursor: pointer;
        }
    </style>
    <!--Panel-->
    <div class="card document_category_view docCardHover"
         data-document-category="{{$first_element['category_id']}}"
         data-document-category-sub="0"
         data-document-category-sub-sub="0">
        <div class="card-body"
        >
            <h5 class="card-title">
                <!--                <a href=""><span class="float-right"><i class="fas fa-plus"></i></span></a>
                -->

                <!--     <a  class="document_upload_open"-->
                <a class="document_tabs_open"
                   data-document-category="{{$first_element['category_id']}}"
                   data-document-category-sub="0"
                   data-document-category-sub-sub="0"

                ><span data-toggle="tooltip" title="Add Document" class="float-right"><i
                                class="fas fa-plus"></i></span></a><a
                        data-document-category="{{$first_element['category_id']}}"
                        class="document_category_view">@php echo $first_element['category_name']; @endphp</a>
            </h5>
            <a class="document_category_view" data-document-category="{{$first_element['category_id']}}">
                <small class="doc-list">Contains <span id="doc-count">{{isset($document_tree_counts['category'][$first_element['category_id']]) ?
                            $document_tree_counts['category'][$first_element['category_id']] : 0
                        }}</span> documents related to:
                </small>
            </a>
            <p class="card-text">


            <ul class="row docCenterStyles">

                @if(count($category) > 1)
                    @php   list($sub_category_part_1, $sub_category_part_2) = array_chunk($category, ceil(count($category) / 2)); @endphp
                @else
                    @php  $sub_category_part_1 = $category ;
                        $sub_category_part_2 = array();
                    @endphp
                @endif
                <div class="co-5">
                    @foreach ($sub_category_part_1 as $sub_category)
                        <li>
                            <a class="document_category_sub_view"
                               data-document-category-sub="{{$sub_category['category_sub_id']}}">{{ $sub_category['category_sub_name'] }}
                                ({{isset($document_tree_counts['sub_category'][$sub_category['category_sub_id']]) ?
                                    $document_tree_counts['sub_category'][$sub_category['category_sub_id']] : 0
                                }})</a></li>
                    @endforeach
                </div>
                <div class="col-1"></div>
                <div class="co-6">
                    @foreach ($sub_category_part_2 as $sub_category)
                        <li>
                            <a class="document_category_sub_view"
                               data-document-category-sub="{{$sub_category['category_sub_id']}}">{{ $sub_category['category_sub_name'] }}
                                ({{isset($document_tree_counts['sub_category'][$sub_category['category_sub_id']]) ?
                                    $document_tree_counts['sub_category'][$sub_category['category_sub_id']] : 0
                                }})</a></li>
                    @endforeach
                </div>
            </ul>


            </p>
        </div>
        <div class="card-footer">
            <small class="text-muted">Last updated {{isset($document_category_last_updated[$first_element['category_id']]) ?
                    \App\Helpers\Helper::time_elapsed_string($document_category_last_updated[$first_element['category_id']]) :'- No records' }}
                <a href=""><span class="float-right">
                <!-- <i class="far fa-trash-alt"></i> -->
                </span></a>
            </small>
            <!-- <small class="text-muted">Contains <span id="doc-count">15</span> documents</small> -->
        </div>
    </div>
    <!--/.Panel-->


    @if ($category_counter % 3 == 0 || $category_counter == count($category_tree))
        @php  echo $card_deck_end; @endphp
    @endif
@endforeach

<script>
    // Tooltips Initialization
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>