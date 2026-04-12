/*(function (SITE_BASE_URL, SITE_INDEX_URL, SITE_LOGOUT_URL, SITE_LOGIN_URL, DOCUMENT_URL,
           MESSAGE_ATTACHMENT_URL, MEMBER_IMG_URL, DEPENDENT_PROFILE_IMG_URL,
           DEPENDENT_GUARDIAN_IMG_URL, DEPENDENT_MEDICAL_IMG_URL, DEPENDENT_SCHOOL_IMG_URL,
           PET_IMG_URL, DEFAULT_AVATAR_IMAGE_URL, PROJECT_IMAGE_URL, SITE_IDLE_TIME_MINUTES, tab_id,
           roles_array_values_obj, relationship_array_values_obj, get_role_guardian,
           PET_IMG_FOLDER, ESTATE_IMG_FOLDER, MEMBER_IMG_FOLDER, PROFILE_IMG_FOLDER) {*/
$(document).ready(function () {

    var document_category_auto = 0;
    var document_category_sub_auto = 0;
    var document_category_sub_sub_auto = 0;
    var document_category_sub_sub_sub_auto = 0;
    var document_content_type_auto = 0;
    $(document).on('click', '.document_upload_open', function (e) {
        e.preventDefault();
        e.stopPropagation();
        document_category_auto = $(this).data('document-category');
        document_category_sub_auto = $(this).data('document-category-sub');
        document_category_sub_sub_auto = $(this).data('document-category-sub-sub');
        document_category_sub_sub_sub_auto = $(this).data('document-category-sub-sub-sub');
        $("#addNewDocumentID2").modal('toggle');
        $.ajax({
            type: "POST",
            url: SITE_BASE_URL + "project/estates/forms/documentForms/document-popups/upload_popup_content.php",
            data: {
                document_category_auto: document_category_auto
            },
            success: function (data) {
                $('#addNewDocumentID2 .modal-content').html(data);
                //$('#document_category_drop_down_element_'+document_category_auto).trigger('click');
                initiateMaterialDocumentUpload($('#addNewDocumentID2'));
                setDocumentCategoryAuto(document_category_auto, '#document_category', '#addNewDocumentID2');
            }
        });
    });

    function setDocumentCategoryAuto(key, this_element, modal_element) {
        $(modal_element + ' ' + this_element + ' option[value=' + key + ']').attr('selected', true);
        set_document_sub_category(key, modal_element);
    }

    function set_document_sub_category(document_category, modal_element) {
        document_category_all_subs_disable(modal_element);
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/forms/documentForms/document-selects/sub_category_select.php",
            url: SITE_BASE_URL + "document/ajax_return_view",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                view: "project/estates/forms/documentForms/document-selects/sub_category_select",
                document_category: document_category,
                document_category_sub_auto: document_category_sub_auto
            },
            success: function (data) {
                $(modal_element + ' #document_category_sub').html(data);
                document_category_sub_enable(modal_element);
                setDocumentCategorySubAuto(document_category_sub_auto, '#document_category_sub', modal_element);
                initiateMaterialDocumentUploadNew($('#modalNewDocumentUpload'));
            }
        });
    }

    function set_document_content_types(modal_element) {
        $(modal_element + ' #document_content_type').html("");
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/forms/documentForms/document-selects/document_content_type.php",
            url: SITE_BASE_URL + "document/ajax_return_view",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                view: "project/estates/forms/documentForms/document-selects/document_content_type",
                document_category_sub_auto: document_category_sub_auto,
                document_content_type_auto: document_content_type_auto
            },
            success: function (data) {
                $(modal_element + ' #document_content_type').html(data);
            }
        });
    }

    function setDocumentCategorySubAuto(key, this_element, modal_element) {
        $(modal_element + ' ' + this_element + ' option[value=' + key + ']').attr('selected', true);
        set_document_sub_sub_category(key, modal_element);
    }

    $(document).on('change', '.document_category', function () {
        var document_category = $(this).val();
        if (document_category > 0) {
            set_document_sub_category(document_category, "#" + $(this).closest('.modal').attr('id'));
        }
    });

    function set_document_sub_sub_category(document_sub_category, modal_element) {
        document_category_sub_sub_disable(modal_element);
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/forms/documentForms/document-selects/sub_sub_category_select.php",
            url: SITE_BASE_URL + "document/ajax_return_view",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                view: "project/estates/forms/documentForms/document-selects/sub_sub_category_select",
                document_sub_category: document_sub_category,
                document_category_sub_sub_auto: document_category_sub_sub_auto
            },
            success: function (data) {
                if (data.trim() != 0) {
                    $(modal_element + ' #document_category_sub_sub').html(data);
                    document_category_sub_sub_enable(modal_element);
                    setDocumentCategorySubSubAuto(document_category_sub_sub_auto, '#document_category_sub_sub', modal_element);

                }
                initiateMaterialDocumentUpload($(modal_element));
            }
        });
    }

    function setDocumentCategorySubSubAuto(key, this_element, modal_element) {
        $(modal_element + ' ' + this_element + ' option[value=' + key + ']').attr('selected', true);
        set_document_sub_sub_sub_category(key, modal_element);
    }

    $(document).on('change', '.document_category_sub', function () {
        var document_sub_category = $(this).val();
        if (document_sub_category > 0) {
            set_document_sub_sub_category(document_sub_category, "#" + $(this).closest('.modal').attr('id'));
        }
    });

    function set_document_sub_sub_sub_category(document_sub_sub_category, modal_element) {
        document_category_sub_sub_sub_disable(modal_element);
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/forms/documentForms/document-selects/sub_sub_sub_category_select.php",
            url: SITE_BASE_URL + "document/ajax_return_view",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                view: "project/estates/forms/documentForms/document-selects/sub_sub_sub_category_select",
                document_sub_category: $(modal_element + ' #document_category_sub').val(),
                document_category_sub_sub_sub_auto: document_category_sub_sub_sub_auto
            },
            success: function (data) {
                if (data.trim() != 0) {
                    $(modal_element + ' #document_category_sub_sub_sub').html(data);
                    document_category_sub_sub_sub_enable(modal_element);
                    // setDocumentCategorySubSubAuto(document_category_sub_sub_auto, '#document_category_sub_sub', modal_element);

                }
                initiateMaterialDocumentUpload($(modal_element));
            }
        });
    }

    function document_category_sub_enable(modal_element) {
        $(modal_element + ' #sub-documentNew-category').show();
        $(modal_element + ' #document_category_sub').prop('disabled', false);
    }

    function document_category_sub_sub_enable(modal_element) {
        $(modal_element + ' #sub-sub-documentNew-category').show();
        $(modal_element + ' #document_category_sub_sub').prop('disabled', false);
    }

    function document_category_sub_sub_sub_enable(modal_element) {
        $(modal_element + ' #sub-sub-sub-documentNew-category').show();
        $(modal_element + ' #document_category_sub_sub_sub').prop('disabled', false);
    }

    function document_category_all_subs_disable(modal_element) {
        $(modal_element + ' #sub-documentNew-category').hide();
        $(modal_element + ' #document_category_sub').prop('disabled', true);
        $(modal_element + ' #sub-sub-documentNew-category').hide();
        $(modal_element + ' #document_category_sub_sub').prop('disabled', true);
    }

    function document_category_sub_sub_disable(modal_element) {
//                $('#sub-documentNew-category').hide();
        //   $('#document_category_sub').prop('disabled',true);
        $(modal_element + ' #sub-sub-documentNew-category').hide();
        $(modal_element + ' #document_category_sub_sub').prop('disabled', true);
    }

    function document_category_sub_sub_sub_disable(modal_element) {
//                $('#sub-documentNew-category').hide();
        //   $('#document_category_sub').prop('disabled',true);
        $(modal_element + ' #sub-sub-sub-documentNew-category').hide();
        $(modal_element + ' #document_category_sub_sub_sub').prop('disabled', true);
    }

    /*   $(document).on("click", "#btnChange-ADDdocumentNew", function (e) {
           e.preventDefault();
           var form = $(this).closest('form');
           var formData = new FormData();
           formData.append("document_title", form.find("#document_title").val());
           formData.append("document_notes", form.find("#document_notes").val()); // number 123456 is immediately converted to a string "123456"
           if (form.find('#document_category').length)
               formData.append("document_category", form.find("#document_category").val());
           if (form.find('#document_category_sub').length)
               formData.append("document_category_sub", form.find("#document_category_sub").val());
           if (form.find('#document_category_sub_sub').length)
               formData.append("document_category_sub_sub", form.find("#document_category_sub_sub").val());
           formData.append("document_file", form.find('input[name=document_file]')[0].files[0]);
           formData.append("action", "edit");
           // HTML file input, chosen by user
           //  formData.append("userfile", fileInputElement.files[0]);
           //var document_title = $("#document_title").val();
           //var document_notes = $("#document_notes").val();
           $.ajax({
               type: "POST",
               url: SITE_BASE_URL+"project/estates/forms/documentForms/document-new/processor.php",
               data: formData,
               contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
               processData: false, // NEEDED, DON'T OMIT THIS
               success: function (data) {
                   //console.log(data);
                   //setValuesDocument(data)
                   var result_set = $.parseJSON(data);
                   if (result_set.error != 1) {
                       toastr.success(result_set.message);
                   } else {
                       toastr.error(result_set.message);
                   }
                   show_document_cards();
                   add_tasks_on_dashboard();
               }
           });
       });*/

    $(document).on("click", "#add_documents", function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var formData = new FormData();
        formData.append("document_notes", form.find("#document_notes").val());
        formData.append("document_file_name", form.find("#document_file_name").val());
        formData.append("document_content_type", form.find("#document_content_type").val()); // number 123456 is immediately converted to a string "123456"
        var document_created = convert_date(form.find("#document_created").val());
        formData.append("document_created", document_created);
        $('.document_share_role').each(function () {
            if ($(this).is(':checked')) {
                formData.append("document_share_role[]", $(this).val());
            }
        });
        $('.member_share').each(function () {
            if ($(this).is(':checked')) {
                formData.append("member_share[]", $(this).val());
            }
        });
        if ($('#document_share_members_all').is(':checked')) {
            formData.append("document_share_members_all", 1);
        }
        if (form.find('#document_category').length)
            formData.append("document_category", form.find("#document_category").val());
        if (form.find('#document_category_sub').length)
            formData.append("document_category_sub", form.find("#document_category_sub").val());
        if (form.find('#document_category_sub_sub').length)
            formData.append("document_category_sub_sub", form.find("#document_category_sub_sub").val());
        formData.append("document_file", form.find('input[name=document_file]')[0].files[0]);
        formData.append("action", "edit");
        // HTML file input, chosen by user
        //  formData.append("userfile", fileInputElement.files[0]);
        //var document_title = $("#document_title").val();
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/forms/documentForms/document-new/processor.php",
            url: SITE_BASE_URL + "document/add_document",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: formData,
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
            success: function (data) {
                //console.log(data);
                //setValuesDocument(data)
                var result_set = $.parseJSON(data);
                if (result_set.error != 1) {
                    toastr.success(result_set.message);
                } else {
                    toastr.error(result_set.message);
                }
                if ((($("#modalDocCenterFullList").data('bs.modal') || {})._isShown)) {
                    $("#modalDocCenterFullList").modal('toggle');
                    $(".modal-backdrop").hide();
                }
                show_document_cards();
                add_tasks_on_dashboard();
            }
        });
    });


    $(document).on('click', '.document_category_view', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var document_category = $(this).data('document-category');
        if (parseInt(document_category) > 0) {
            $.ajax({
                type: "POST",
                // url: SITE_BASE_URL + "project/estates/forms/documentForms/document-new/processor.php",
                url: SITE_BASE_URL + 'estate/ajax_return_view',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    // action: 'documents_of_category_inline',
                    view: "project/estates/forms/documentForms/document-new/document_list",
                    document_category: document_category
                },
                success: function (data) {
                    $('#document_cards_container').html(data);
                }
            });
        }
    });

    $(document).on('click', '.document_category_sub_view', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var document_category_sub = $(this).data('document-category-sub');
        if (parseInt(document_category_sub) > 0) {
            $.ajax({
                type: "POST",
               // url: SITE_BASE_URL + "project/estates/forms/documentForms/document-new/processor.php",
                url: SITE_BASE_URL + 'estate/ajax_return_view',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    view: "project/estates/forms/documentForms/document-new/document_list_category_sub",
                    document_category_sub: document_category_sub
                },
                success: function (data) {
                    $('#document_cards_container').html(data);
                }
            });
        }
    });

    var document_share_from_list = 0;
    var document_from_paginate = 0;
    $(document).on('click', '.load_document_main', function (e) {
        e.preventDefault();
        show_document_cards();
        if (typeof document_share_from_list !== "undefined") {
            document_share_from_list = 0;
            $("#modalDocCenterFullList").modal('show');
            $('.document_list_trigger_active').trigger('click');
        }
    });
    $(document).on('click', '.view_document_popup', function (e) {
        e.preventDefault();
        var document_file = $(this).data('document-file');
        var document_title = $(this).data('document-title');
        var url = DOCUMENT_URL + document_file;
        var body = ' <embed src="' + url + '"  frameborder="0" width="100%" height="400px">';
        // $('#documentShowModal').html($('#documentShowModal').html().replace('##URL##', url));
        // $('#documentShowModal').html($('#documentShowModal').html().replace('##TITLE##', document_title));
        $('#documentShowModal .modal-title').html(document_title);
        $('#documentShowModal .modal-body').html(body);
        $("#documentTabsModal").modal('hide');
        $("#other-estateModal").modal('hide');
        $('#documentShowModalOpen').trigger('click');
    });


    $(document).on('click', '.share_document_to_member', function (e) {
        e.preventDefault();
        var document_id = $(this).data('document-id');
        var document_title = $(this).data('document-title');
        document_share_from_list = $(this).data('document-share-from-list');
        document_from_paginate = $('.paginate_button.active a').data('dt-idx');
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/forms/documentForms/document-cards/share_cards_processor.php",
            url: SITE_BASE_URL + 'estate/ajax_return_view',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                // action: 'share_document_to_member',
                view: "project/estates/forms/documentForms/document-cards/share_cards_processor",
                document_id: document_id,
                document_title: document_title
            },
            success: function (data) {
                if ((($("#documentTabsModal").data('bs.modal') || {})._isShown)) {
                    $("#documentTabsModal").modal('toggle');
                    $('#list-documents-list').trigger('click');
                    $(".modal-backdrop").hide();
                } else if ((($("#modalDocCenterFullList").data('bs.modal') || {})._isShown)) {
                    $("#modalDocCenterFullList").modal('toggle');
                    $('#list-documents-list').trigger('click');
                    $(".modal-backdrop").hide();
                }
                $('#document_cards_container').html(data);
            }
        });
    });

    $(document).on('click', '.share_document_to_this_member', function () {
        var document_id = $(this).data('document-id');
        var document_member_type = $(this).data('document-member-type');
        var document_member_id = $(this).data('document-member-id');
        var shared = $(this).is(':checked') ? 1 : 0;
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/forms/documentForms/document-new/processor.php",
            url: SITE_BASE_URL + "estate/ajax_member_share",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                //action: 'share_this_document_to_member',
                document_share_document_id: document_id,
                document_share_member_type: document_member_type,
                document_share_member_id: document_member_id,
                shared: shared
            },
            success: function (data) {
                var result_set = $.parseJSON(data);
                if (result_set.error != 1) {
                    if (shared) {
                        toastr.success(result_set.message);
                        $("#share_label_" + document_member_type + "_" + document_member_id).html("Shared");
                    } else {
                        toastr.warning(result_set.message);
                        $("#share_label_" + document_member_type + "_" + document_member_id).html("Share");
                    }
                } else {
                    toastr.error(result_set.message);
                }
            }
        });
    });
    $(document).on('click', '.document_tabs_open', function (e) {
        e.preventDefault();
        e.stopPropagation();
        if ($(this).hasClass('documents_disabled')) {
            //alert($(this).data('document-category-sub-sub'));
            toastr.error("Please fill the form first !");
            return false;
        }
        var document_category = $(this).data('document-category');
        var document_category_sub = $(this).data('document-category-sub');
        var document_category_sub_sub = $(this).data('document-category-sub-sub');
        var document_category_sub_sub_sub = $(this).data('document-category-sub-sub-sub');
        document_category_auto = document_category;
        document_category_sub_auto = document_category_sub;
        document_category_sub_sub_auto = document_category_sub_sub;
        document_category_sub_sub_sub_auto = document_category_sub_sub_sub;
        document_content_type_auto = $(this).data('document-content-type');
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/forms/documentForms/document-modals/document_upload_modal.php",
            url: SITE_BASE_URL + "document/ajax_return_view",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                view: "project/estates/forms/documentForms/document-modals/document_upload_modal",
                document_category: document_category,
                document_category_sub: document_category_sub,
                document_category_sub_sub: document_category_sub_sub,
                document_category_auto: document_category_auto,
                document_category_sub_auto: document_category_sub_auto,
                document_category_sub_sub_auto: document_category_sub_sub_auto,
                document_category_sub_sub_sub_auto: document_category_sub_sub_sub_auto
            },
            success: function (data) {
                $('#document_upload_modal_container').html(data);
                setDocumentCategoryAuto(document_category_auto, '#document_category', '#modalNewDocumentUpload');
                if (document_category_sub_auto > 0) {
                    set_document_sub_category(document_category_auto, '#modalNewDocumentUpload');
                    if (document_category_sub_auto > 0) {
                        set_document_sub_sub_category(document_category_sub_auto, '#modalNewDocumentUpload');
                    }
                }
                set_document_content_types('#modalNewDocumentUpload');
                $("#modalNewDocumentUpload").modal('show');
                initiateMaterialDocumentUploadNew($('#modalNewDocumentUpload'));
                if (document_category_auto > 0) {
                } else {
                    $('#collapseDocDetatilsSet').trigger('click');
                }
            }
        });
    });

    $('.input-group-addon-close a').click(function () {
        $("#suggesstion-box").html('');
        $("#search-box").val('');
        $('.input-group-addon-search').show();
        $('.input-group-addon-close').hide();
    });
    var search_val = '';
    $("#search-box").keyup(function () {
        search_val = $(this).val().trim();
        if (search_val == '') {
            $('.input-group-addon-search').show();
            $('.input-group-addon-close').hide();
            $("#suggesstion-box").html('');
        } else {
            $('.input-group-addon-search').hide();
            $('.input-group-addon-close').show();
            $.ajax({
                type: "POST",
                //url: SITE_BASE_URL + "project/estates/forms/documentForms/document-new/search_processor.php",
                url:SITE_BASE_URL+'document/ajax_search_document',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    search_title: search_val
                },
                beforeSend: function () {
                    // $("search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function (data) {
                    $("#suggesstion-box").show();
                    if (search_val != '') {
                        $("#suggesstion-box").html(data.trim());
                    }
                    // $("#search-documents-input").css("background","#FFF");
                }
            });
        }
    });

    $(document).on('click', '.delete_this_document', function (e) {
        e.preventDefault();
        var document_id = $(this).data('document-id');
        var document_title = $(this).data('document-title');
        document_from_paginate = $('.paginate_button.active a').data('dt-idx');
        var yes_delete = confirm("Want to delete '" + document_title + "' ?");
        if (yes_delete) {
            $.ajax({
                type: "POST",
                // url: SITE_BASE_URL+"project/estates/forms/documentForms/document-modals/document-tabs-modal.php",
               // url: SITE_BASE_URL + "project/estates/forms/documentForms/document-new/processor.php",
                url :SITE_BASE_URL + "document/ajax_document_delete",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    document_id: document_id // ,
                  //  document_title: document_title // ,
                  //  action: 'delete_this_document'
                },
                success: function (data) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        toastr.success(result_set.message);
                        if ((($("#modalDocCenterFullList").data('bs.modal') || {})._isShown)) {
                            $('.document_list_trigger_active').trigger('click');
                        }
                        show_document_cards();
                    } else {
                        toastr.error(result_set.message);
                    }
                    document_from_paginate = 0;
                }
            });
        }
    });


    $(document).on('change', '#document_file_name', function (e) {
        //$(this).val( $(this).val()+"".split('.')[0]);
        var oldString = $(this).val();
        var newString = oldString.split('.', 1)[0];
        $(this).val(newString);
    });

    var document_list_trigger_request = false;

    $(document).on('click', '.document_list_trigger', function () {
        $('#modalDocCenterFullList .document_list_trigger_active').removeClass('document_list_trigger_active');
        $(this).addClass('document_list_trigger_active');
        $('#documentFullListContainer').html('');
        var type = $(this).data('type');
        var member_ids = $(this).data('member_ids');
        var document_category = $(this).data('document-category');
        var document_category_sub = $(this).data('document-category-sub');
        var document_category_sub_sub = $(this).data('document-category-sub-sub');
        var document_category_sub_sub_sub = $(this).data('document-category-sub-sub-sub');
        var table_title = $(this).data('table-title');

        if (document_list_trigger_request) {
            document_list_trigger_request.abort();
        }
        document_list_trigger_request = $.ajax({
            type: "POST",
            // url: SITE_BASE_URL+"project/estates/forms/documentForms/document-modals/document-tabs-modal.php",
            url: SITE_BASE_URL + 'estate/ajax_return_view',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                view:"project.estates.forms.documentForms.document-new.document-FullListTable",
                member_ids: member_ids,
                type: type,
                document_category: document_category,
                document_category_sub: document_category_sub,
                document_category_sub_sub: document_category_sub_sub,
                document_category_sub_sub_sub: document_category_sub_sub_sub
            },
            success: function (data) {
                $('#documentFullListContainer').html(data);
                var displayStart = 0;
                if (typeof document_from_paginate !== 'undefined' && document_from_paginate !== null && document_from_paginate != 0) {
                    displayStart = (document_from_paginate - 1) * 10;
                }
                document_from_paginate = 0;
                $('#Doc_Center_All').DataTable({
                    "ordering": true, // false to disable sorting (or any other option),
                    'displayStart': displayStart
                });
                $('.tableTitle').html(table_title);
                $('.dataTables_length').addClass('bs-select');
            }
        });
    });

    $(document).on('change', '.document_not_applicable_set', function () {
        var not_applicable = $(this).is(':checked') ? 1 : 0;
        var not_applicable_hash = $(this).data('hash-value');
        var this_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url:SITE_BASE_URL + "document/ajax_set_not_applicable",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                not_applicable: not_applicable,
                not_applicable_hash: not_applicable_hash //,
                //action: 'document_not_applicable'
            },
            success: function (data) {
                var result_set = $.parseJSON(data);
                if (result_set.error == 0) {
                    if (not_applicable == 0) { // applicable
                        $('#' + this_id + 'Uploaded').html('<span class="red-text">Missing</span>');
                        $('#' + this_id + 'Upload').show();
                        toastr.success(result_set.message);
                    } else {
                        $('#' + this_id + 'Uploaded').html('<span class="black-text">N/A</span>');
                        $('#' + this_id + 'Upload').hide();
                        toastr.info(result_set.message);
                    }
                }
            }
        });
    });


    $('#modalDocCenterFullList').on('shown.bs.modal', function (e) {
        $('#documentFullListContainer').html('');
        $('#all_docs').parent().find('.document_list_trigger').first().trigger('click');
    });

    $(document).on('click', '.more_notes', function () {
        var td = $(this).closest('td');
        var text_set = td.data('notes');
        td.html(text_set);
    });
    $(document).on('click', '.less_notes', function () {
        var td = $(this).closest('td');
        var text_set = td.data('notes-less');
        td.html(text_set);
    });
    //show_document_cards();
});
/*})(jQuery);*/

