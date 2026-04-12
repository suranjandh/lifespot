@php

    $pet_is_type_of_pet = false;
    $pet_has_account = false;

    $document_tabs_open_true = $pet_type != 'pet';
    $document_tabs_open = $document_tabs_open_true ? 'document_tabs_open' : 'cancel_click_temp';

    $data_document_category = 2;
    $data_document_category_sub = 7;
    $data_document_category_sub_sub = $pet->pet_id;
    $data_document_category_sub_sub_sub = 1;


@endphp
<div class="icon_set icon1 cancel_click_temp" data-toggle="tooltip" data-placement="top" title="Gift">
    <i class="fas fa-gift"></i>
</div>
@php

    $document_tabs_open = 'document_tabs_open' ;
@endphp
@if ($document_tabs_open != 'cancel_click_temp')
    <div class="icon_set icon2 {{ $document_tabs_open }}"
         data-document-category="{{ $data_document_category }}"
         data-document-category-sub="{{ $data_document_category_sub }}"
         data-document-category-sub-sub="{{ $data_document_category_sub_sub }}"
         data-document-category-sub-sub-sub="{{ $data_document_category_sub_sub_sub }}"
         data-toggle="tooltip" data-placement="top"
         title="Documents">

        <i class="far fa-file-alt xmr-2"></i>
    </div>
@endif
<div class="icon_set icon3 invite_pet_open"
     data-toggle="tooltip" data-placement="top">
</div>

<div class="icon_set icon4 pet_share_modal_open" data-toggle="tooltip" data-placement="top">
</div>

<div class="icon_set icon5">
</div>

<div class="xicon_set icon6 pet_content_box_delete" data-pet-pet-id="{{ $pet->pet_id }}"
     data-toggle="tooltip" data-placement="top" title="Delete Pet">
    <i class="fas fa-trash-alt black-text mr-2" style="margin-top:0"></i>

</div>
<div></div>