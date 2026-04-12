/*(function (SITE_BASE_URL, SITE_INDEX_URL, SITE_LOGOUT_URL, SITE_LOGIN_URL, DOCUMENT_URL,
           MESSAGE_ATTACHMENT_URL, MEMBER_IMG_URL, DEPENDENT_PROFILE_IMG_URL,
           DEPENDENT_GUARDIAN_IMG_URL, DEPENDENT_MEDICAL_IMG_URL, DEPENDENT_SCHOOL_IMG_URL,
           PET_IMG_URL, DEFAULT_AVATAR_IMAGE_URL, PROJECT_IMAGE_URL, SITE_IDLE_TIME_MINUTES, tab_id,
           roles_array_values_obj, relationship_array_values_obj, get_role_guardian,
           PET_IMG_FOLDER, ESTATE_IMG_FOLDER, MEMBER_IMG_FOLDER, PROFILE_IMG_FOLDER
) {*/
    $(document).ready(function () {


        $(document).on('click', '.other_estates_share_open', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var other_estate_card = $(this).closest('.other-estate-cardLayout');
            var other_estate_id = other_estate_card.data('other-estate-id');
            var other_estate_name = other_estate_card.data('other-estate-name');
            var other_estate_member_id = other_estate_card.data('other-estate-member-id');
            $.ajax({
                type: "POST",
                // url: SITE_BASE_URL+"project/estates/otherEstates/processor.php",
                url: SITE_BASE_URL + "other_estate/other_estate_shares",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    //action: 'get_other_estate_shares',
                    other_estate_id: other_estate_id,
                    other_estate_member_id: other_estate_member_id
                },
                success: function (data) {
                    $('#other-estateModal .modal-title').html('<i class="fas fa-share-alt"></i> ' + other_estate_name + ' has Shared the following information with you.');
                    $('#other-estateModal .modal-body').html(data);
                    $("#other-estateModal").modal('show');
                }
            });

        });


        $(document).on('click', '.member-share-li', function () {
            $('.member-share-li-content').html('');
            $('.member-share-li-content').hide();
            //$('.list-group-estate-share-box').find('.fa-angle-double-down').show();
            // $('.list-group-estate-share-box').find('.fa-angle-double-up').hide();
            var other_estate_card = $(this);
            other_estate_card.find('.other_estate_arrows').children().toggle();
            if (other_estate_card.find('.fa-angle-double-up').is(":visible")) {
                var member_id = other_estate_card.data('member-member-id');
                var member_type = other_estate_card.data('member-type');
                var modal_title = '';
                var url = '';
                var data = null;

                if (member_type == 'new_estate' || member_type == 'current_estate') {
                    url = SITE_BASE_URL+"project/estates/forms/About-Me/Estate/estate_details.php";
                    modal_title = 'Estate';
                    data = {
                        member_member_id: member_id
                    };
                }
                if (member_type == 'new_member' || member_type == 'current_member') {
                    url = SITE_BASE_URL+"project/estates/forms/memberForms/member_details.php";
                    data = {
                        member_member_id: member_id
                    };
                    modal_title = 'Member';
                } else if (member_type == 'current_spouse') {
                    url = SITE_BASE_URL+"project/estates/forms/memberForms/member_details.php";
                    data = {
                        member_member_id: member_id
                    };
                    modal_title = 'Spouse';
                } else if (member_type == 'current_dependent') {
                    url = SITE_BASE_URL+"project/estates/forms/memberForms/member_details.php";
                    data = {
                        member_member_id: member_id
                    };
                    modal_title = 'Dependent';
                } else if (member_type == 'current_profile') {
                    url = SITE_BASE_URL+"project/estates/forms/About-Me/Profile/profile_details.php";
                    data = {
                        member_member_id: member_id
                    };
                    modal_title = 'Lifespot Owner';
                }
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function (data) {
                        var display_li = $('#other-estateModal .modal-body #member-share-li-content_' + member_type + '_' + member_id);
                        display_li.html(data);
                        display_li.show();
                    }
                });
            }
        });


        $(document).on('click', '.other_estates_document_share_open', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var other_estate_card = $(this).closest('.other-estate-cardLayout');
            var other_estate_name = other_estate_card.data('other-estate-name');
            var other_estate_member_id = other_estate_card.data('other-estate-member-id');
            $.ajax({
                type: "POST",
                // url: SITE_BASE_URL+"project/estates/otherEstates/processor.php",
                url: SITE_BASE_URL + "other_estate/other_estate_document_shares",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                   // action: 'get_other_estate_document_shares',
                    other_estate_member_id: other_estate_member_id
                },
                success: function (data) {
                    $('#other-estateModal .modal-title').html('<i class="fas fa-file-alt"></i> ' + other_estate_name + ' has Shared the following documents with you.');
                    $('#other-estateModal .modal-body').html(data);
                    $("#other-estateModal").modal('show');
                }
            });

        });


        $('#search_estate_cards_set').keyup(function () {
            var search_val = $(this).val().trim().toLocaleLowerCase();
            if (search_val != '') {
                $.each(other_estate_card_data_array, function (i, item) {
                    //alert(data[i].PageName);
                    var name = other_estate_card_data_array[i][0].toLocaleLowerCase();
                    var element_id = other_estate_card_data_array[i][1];
                    if (name.search(search_val) != -1) {
                        $('#' + element_id).show();
                    } else {
                        $('#' + element_id).hide();
                    }
                });
            } else {
                $("#other-estates-content .other-estate-cardLayout").show();
            }
        });

        // add on top
    });
/*})(jQuery);*/
