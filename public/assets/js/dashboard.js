function showMemberCards(initial_load) {
    showMemberCardsForTab(initial_load);
}

function showMemberCardsForTab(initial_load) {


    //if (tab_id == 'estate_index') {
    add_tasks_on_dashboard();
    if (tab_id == 'estate_index') {
        showDashboardCounts();
    }

    //} /*else {
    //   add_tasks_count_on_dashboard_tab();
    // }*/
    if (tab_id == 'estate_index') {
        showDashboardCounts();
    }
    if (tab_id == 'estate_index') {
        check_and_load_snapshot();
    }
    if (tab_id == 'estate_index') {
        initiateProfile();
    }

    if (tab_id == 'estate_messages' && initial_load != true) {
        add_group_member_select_cards();
        //initiateMaterialMessages();
    }
    if (tab_id == 'estate_messages' && initial_load != true) {
        add_messages_left_cards();
    }

    if (tab_id == 'estate_messages') {
        load_unread_messages_counts();
    }

    if (tab_id != 'estate_messages') {
        load_unread_messages_counts_only_count();
    }

    if (tab_id == 'estate_profile' && initial_load != true) {
        add_dependent_cards(); //+
    }
    if (tab_id == 'estate_profile' && initial_load != true) {
        load_beneficiaries(); //+
    }
    if (tab_id == 'estate_profile' && initial_load != true) {
        load_emergency_contacts(); // +
    }
    if (tab_id == 'estate_profile' && initial_load != true) {
        load_pets(); //+
    }

    if (tab_id == 'estate_members' && initial_load != true) {
        add_member_cards();
    }

    if (tab_id == 'estate_documents' && initial_load != true) {
        show_document_cards();
    }

    if (tab_id == 'kid_profile' && initial_load != true) {
        add_friend_cards();
    }
}


var add_member_cards_request;

function add_member_cards() {

    if (add_member_cards_request) {
        add_member_cards_request.abort();
    }

    add_member_cards_request = $.ajax({
        type: "POST",
        url: SITE_BASE_URL + "estate/ajax_return_view",
        data: {
            view: "project.estates.forms.memberForms.member_box_processor"
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function () {
            $('#members-content').html('<img src="' + PROJECT_IMAGE_URL + 'loading_page.gif" style="margin-top:5%;margin-left:10%">');
            $('.modal-backdrop').hide();
        },
        success: function (data) {
            $('#members-content').html(data);
        },
        complete: function (data) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
}

var add_friend_cards_request;

function add_friend_cards() {

    if (add_friend_cards_request) {
        add_friend_cards_request.abort();
    }

    add_friend_cards_request = $.ajax({
        type: "POST",
        //url: SITE_BASE_URL + "project/kid/MyProfile/AboutMe/Friends/processor.php",
        //data: {
         //   action: 'read'
        //},
        url: SITE_BASE_URL + "estate/ajax_return_view",
        data: {
            view: "project.kid.MyProfile.AboutMe.Friends.friend_box_processor"
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function () {
            $('#friends_content-main').html('<img src="' + PROJECT_IMAGE_URL + 'loading_page.gif" style="margin-top:5%;margin-left:10%">');
            $('.modal-backdrop').hide();
        },
        success: function (data) {
            $('#friends_content-main').html(data);
        },
        complete: function (data) {
            //$('[data-toggle="tooltip"]').tooltip();
        }
    });
}

var showDashboardCounts_request;

function showDashboardCounts() {

    if (showDashboardCounts_request) {
        showDashboardCounts_request.abort();
    }

    showDashboardCounts_request = $.ajax({
        type: "POST",
        //url: SITE_BASE_URL + "project/estates/dashboard/processor.php",
        url: SITE_BASE_URL + "dashboard/dashboard_counts",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            action: 'read'
        },
        success: function (data) {
            var result_set = $.parseJSON(data);
            $.each(result_set, function (i, e) {
                $('.' + i).html(e);
            });
        }
    });
}


var initiateProfile_request;

function initiateProfile() {

    if (initiateProfile_request) {
        initiateProfile_request.abort();
    }

    initiateProfile_request = $.ajax({
        type: "POST",
        url: SITE_BASE_URL + "project/estates/forms/About-Me/Profile/processor.php",
        data: {
            action: 'read'
        },
        success: function (data) {
            var result_set = $.parseJSON(data);
            var result = result_set.result;
            if (result.profile_image.trim() != '')
                $(".profile_image_img").attr('src', SITE_BASE_URL + PROFILE_IMG_FOLDER + '/' + result.profile_image + '?rand=' + Math.random());

        }
    });
}

var add_dependent_cards_request;

function add_dependent_cards() {

    if (add_dependent_cards_request) {
        add_dependent_cards_request.abort();
    }

    add_dependent_cards_request =

        $.ajax({
            type: "POST",
            url: SITE_BASE_URL + "estate/ajax_return_view",
            data: {
                // dependents_set: data_dependent_set
                view: "project/estates/forms/MyFamily/dependents/dependents_cards"
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function () {
                $('#myFamily-dependents-form').html('<img src="' + PROJECT_IMAGE_URL + 'loading_page.gif" style="margin-top:5%;margin-left:10%">');
                $('.modal-backdrop').hide();
            },
            success: function (data) {
                $('#myFamily-dependents-form').html(data);
            },
            complete: function (data) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });

}

var show_document_cards_request;

function show_document_cards() {

    if (show_document_cards_request) {
        show_document_cards_request.abort();
    }

    show_document_cards_request = $.ajax({
        type: "POST",
        //url: SITE_BASE_URL+"project/estates/forms/documentForms/document-cards/cards_processor.php",
        url: SITE_BASE_URL + 'estate/ajax_return_view',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            view: "project/estates/forms/documentForms/document-cards/cards_processor"
        }, beforeSend: function () {
            $('#document_cards_container').html('<img src="' + PROJECT_IMAGE_URL + 'loading_page.gif" style="margin-top:5%;margin-left:10%">');
        },
        success: function (data) {
            $('#document_cards_container').html(data);
        }
    });

    showDashboardCounts();
}

$(document).on('hidden.bs.modal', function () {
    $('.modal-backdrop').hide();
});

var add_tasks_on_dashboard_request;

function add_tasks_on_dashboard() {

    if (add_tasks_on_dashboard_request) {
        add_tasks_on_dashboard_request.abort();
    }

    $('#task_panel').html('<img src="' + PROJECT_IMAGE_URL + 'loading_page.gif" style="margin-top:5%;margin-left:10%">');

    add_tasks_on_dashboard_request = $.ajax({
        type: "POST",
        // url: SITE_BASE_URL + "project/estates/tasks/processor.php",
        /* data: {
             action: 'load'
         },*/
        url: SITE_BASE_URL + "dashboard/ajax_add_tasks",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
            // $('#task-list').html(data);
            // add_tasks_count();
            // $('#task_panel').html(data);
            // add_tasks_count();

            //  'task_count'=>count($task_items['task_messages']),
            //    'task_skip_count'=>count($task_items['task_skip_messages']),
            //   'task_panel'=>$out
            var results = $.parseJSON(data);
            $('.active_task_count').html(results.result.task_count);
            $('.skipped_task_count').html(results.result.task_skip_count);
            if (tab_id == 'estate_index' || tab_id == 'kid_index') {
                $('#task_panel').html(results.result.task_panel);
                $('.panel_task_trigger').trigger('click');
            }
        }
    });

    //add_skipped_tasks_on_dashboard();
}


var add_tasks_count_on_dashboard_tab_request;

function add_tasks_count_on_dashboard_tab() {

    if (add_tasks_count_on_dashboard_tab_request) {
        add_tasks_count_on_dashboard_tab_request.abort();
    }

    add_tasks_count_on_dashboard_tab_request = $.ajax({
        type: "POST",
        url: SITE_BASE_URL + "project/estates/tasks/processor.php",
        data: {
            action: 'load_task_count'
        },
        success: function (data) {
            $('.active_task_count').html(data.toString());
        }
    });

}

/*var add_skipped_tasks_on_dashboard_request;

function add_skipped_tasks_on_dashboard() {

    if (add_skipped_tasks_on_dashboard_request) {
        add_skipped_tasks_on_dashboard_request.abort();
    }

    add_skipped_tasks_on_dashboard_request = $.ajax({
        type: "POST",
        url: SITE_BASE_URL + "project/estates/tasks/processor.php",
        data: {
            action: 'load_skipped'
        },
        success: function (data) {
            $('#skipped-tasks').html(data);
            add_tasks_count_skipped();
        }
    });
}*/
/*
function add_tasks_count_skipped() {
    var tasks_count = $('#skipped-tasks').find('.card').length;
    $('.skipped_task_count').html(tasks_count);
}*/


/*
function add_tasks_count() {
    var tasks_count = $('#task-list').find('.card').length;
    $('.active_task_count').html(tasks_count);
    if (parseInt(tasks_count) == 0) {
        $('.taskList').hide();
        $('.task_list_arrow').hide();
        $('.secondaryTaskList').show();
    } else {
        $('.secondaryTaskList').hide();
        $('.task_list_arrow').show();
        $('.taskList').show();
    }
}*/

$(document).ready(function () {
    $('.task_scroller_carousel').carousel({
        interval: 8000
    })
});

/*$('#list-dashboard-list').click(function () {
    add_tasks_on_dashboard();
});*/


function set_snapshot() {
    set_estate_fields();
    add_estate_card();
    add_profile_card();
    add_spouse_card();
    add_dependents_card();
    add_emergency_contact_card();
    add_beneficiary_card();
    add_pet_card();
}

$("#snapShotModal").on('shown.bs.modal', function (e) {
    set_snapshot();
});

function check_and_load_snapshot() {
    if (($("#snapShotModal").data('bs.modal') || {})._isShown) {
        set_snapshot();
    }
}

var add_estate_card_request;

function add_estate_card() {
    if (add_estate_card_request) {
        add_estate_card_request.abort();
    }

    add_estate_card_request = $.ajax({
        type: "POST",
        //url: SITE_BASE_URL + "project/estates/Snapshots/processor.php",
        url: SITE_BASE_URL + "estate/ajax_return_view",
        data: {
            view: "project/estates/Snapshots/cards/estate"
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        /* data: {
             action: 'read_estate_card'
         },*/
        beforeSend: function () {
            $('.bind_estate_card').html('');
        },
        cache: false,
        success: function (data) {
            $('.bind_estate_card').html(data);
            $('.bind_estate_card').find(".card").slideDown("slow");
        }
    });
}

var set_estate_fields_request;

function set_estate_fields() {
    if (set_estate_fields_request) {
        set_estate_fields_request.abort();
    }
    set_estate_fields_request = $.ajax({
        type: "POST",
        url: SITE_BASE_URL + "project/estates/Snapshots/processor.php",
        data: {
            action: 'read_estate'
        },
        cache: false,
        success: function (data) {
            var result_set = $.parseJSON(data);
            if (result_set.error == 0) {
                var result = result_set.result;
                bind_fields_estate(result)
            }
        }
    });
}


var add_profile_card_request;

function add_profile_card() {

    if (add_profile_card_request) {
        add_profile_card_request.abort();
    }
    add_profile_card_request = $.ajax({
        type: "POST",
        /*url: SITE_BASE_URL + "project/estates/Snapshots/processor.php",
        data: {
            action: 'read_profile_card'
        },*/
        url: SITE_BASE_URL + "estate/ajax_return_view",
        data: {
            view: "project/estates/Snapshots/cards/profile"
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function () {
            $('.bind_profile_card').html('');
        },
        cache: false,
        success: function (data) {
            $('.bind_profile_card').html(data);
            $('.bind_profile_card').find(".card").slideDown("slow");
        }
    });
}

var add_spouse_card_request;

function add_spouse_card() {
    if (add_spouse_card_request) {
        add_spouse_card_request.abort();
    }
    add_spouse_card_request = $.ajax({
        type: "POST",
        /*url: SITE_BASE_URL + "project/estates/Snapshots/processor.php",
        data: {
            action: 'read_spouse_card'
        },*/
        url: SITE_BASE_URL + "estate/ajax_return_view",
        data: {
            view: "project/estates/Snapshots/cards/spouse"
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function () {
            $('.bind_spouse_card').html('');
        },
        cache: false,
        success: function (data) {
            $('.bind_spouse_card').html(data);
            $('.bind_spouse_card').find(".card").slideDown("slow");
        }
    });
}

var add_dependents_card_request;

function add_dependents_card() {

    if (add_dependents_card_request) {
        add_dependents_card_request.abort();
    }

    add_dependents_card_request = $.ajax({
        type: "POST",
        /*url: SITE_BASE_URL + "project/estates/Snapshots/processor.php",
        data: {
            action: 'read_dependents_card'
        },*/
        url: SITE_BASE_URL + "estate/ajax_return_view",
        data: {
            view: "project/estates/Snapshots/cards/dependents"
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function () {
            $('.bind_dependents_card').html('');
        },
        cache: false,
        success: function (data) {
            $('.bind_dependents_card').html(data);
            $('.bind_dependents_card').find(".card").slideDown("slow");
        }
    });
}

var add_emergency_contact_card_request;

function add_emergency_contact_card() {

    if (add_emergency_contact_card_request) {
        add_emergency_contact_card_request.abort();
    }
    add_emergency_contact_card_request = $.ajax({
        type: "POST",
        /*url: SITE_BASE_URL + "project/estates/Snapshots/processor.php",
        data: {
            action: 'read_emergency_contact_card'
        },*/
        url: SITE_BASE_URL + "estate/ajax_return_view",
        data: {
            view: "project/estates/Snapshots/cards/emergency_contact"
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function () {
            $('.bind_emergency_contact_card').html('');
        },
        cache: false,
        success: function (data) {
            $('.bind_emergency_contact_card').html(data);
            $('.bind_emergency_contact_card').find(".card").slideDown("slow");
        }
    });
}

var add_beneficiary_card_request;

function add_beneficiary_card() {

    if (add_beneficiary_card_request) {
        add_beneficiary_card_request.abort();
    }


    add_beneficiary_card_request = $.ajax({
        type: "POST",
        /*url: SITE_BASE_URL + "project/estates/Snapshots/processor.php",
        data: {
            action: 'read_beneficiary_card'
        },*/
        url: SITE_BASE_URL + "estate/ajax_return_view",
        data: {
            view: "project/estates/Snapshots/cards/beneficiary"
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function () {
            $('.bind_beneficiary_card').html('');
        },
        cache: false,
        success: function (data) {
            $('.bind_beneficiary_card').html(data);
            $('.bind_beneficiary_card').find(".card").slideDown("slow");
        }
    });
}

var add_pet_card_request;

function add_pet_card() {

    if (add_pet_card_request) {
        add_pet_card_request.abort();
    }

    add_pet_card_request = $.ajax({
        type: "POST",
        /* url: SITE_BASE_URL + "project/estates/Snapshots/processor.php",
         data: {
             action: 'read_pet_card'
         },*/
        url: SITE_BASE_URL + "estate/ajax_return_view",
        data: {
            view: "project/estates/Snapshots/cards/pet"
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function () {
            $('.bind_pet_card').html('');
        },
        cache: false,
        success: function (data) {
            $('.bind_pet_card').html(data);
            $('.bind_pet_card').find(".card").slideDown("slow");
        }
    });
}


function bind_fields_estate(estate) {
    $('.bind_estate_name').html(estate.estate_name);
}

var load_beneficiaries_request;

function load_beneficiaries() {

    if (load_beneficiaries_request) {
        load_beneficiaries_request.abort();
    }
    load_beneficiaries_request = $.ajax({
        type: "POST",
        url: SITE_BASE_URL + "estate/ajax_return_view",
        data: {
            view: "project/estates/forms/MyFamily/beneficiaries/beneficiary_box_processor"
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function () {
            $('#myFamily-beneficiaries-form').html('<img src="' + PROJECT_IMAGE_URL + 'loading_page.gif" style="margin-top:5%;margin-left:10%">');
        },
        success: function (data) {
            $('#myFamily-beneficiaries-form').html(data);
        },
        complete: function (data) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
}

//load_beneficiaries();

var load_emergency_contacts_request;

function load_emergency_contacts() {
    if (load_emergency_contacts_request) {
        load_emergency_contacts_request.abort();
    }
    load_emergency_contacts_request = $.ajax({
        type: "POST",
        url: SITE_BASE_URL + "estate/ajax_return_view",
        data: {
            view: "project/estates/forms/AboutMe/emergency_contact/emergency_contact_box_processor"
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function () {
            $('#aboutMe-emergencyContacts-form').html('<img src="' + PROJECT_IMAGE_URL + 'loading_page.gif" style="margin-top:5%;margin-left:10%">');
        },
        success: function (data) {
            $('#aboutMe-emergencyContacts-form').html(data);
        },
        complete: function (data) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
}

//load_emergency_contacts();

var load_pets_request;

function load_pets() {
    if (load_pets_request) {
        load_pets_request.abort();
    }
    load_pets_request = $.ajax({
        type: "POST",
        url: SITE_BASE_URL + "estate/ajax_return_view",
        data: {
            view: "project/estates/forms/MyFamily/pet/pet_box_processor"
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function () {
            $('#myFamily-pets-form').html('<img src="' + PROJECT_IMAGE_URL + 'loading_page.gif" style="margin-top:5%;margin-left:10%">');
        },
        success: function (data) {
            $('#myFamily-pets-form').html(data);
        },
        complete: function (data) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
}

//load_pets();

//add_messages_left_cards();

var add_group_member_select_cards_request;

function add_group_member_select_cards() {
    if (add_group_member_select_cards_request) {
        add_group_member_select_cards_request.abort();
    }
    add_group_member_select_cards_request = $.ajax({
        type: "POST",
        url: SITE_BASE_URL + "project/estates/messageCenterA/processor.php",
        data: {
            action: 'message_enabled_users'
        },
        cache: false,
        success: function (data) {
            $('#group_member_select_chat').html(data);
            //  main.materialSelect();
            // main.material_select('destroy');
            //$('#group_member_select_chat').material_select();
            initiateMaterialMessages();
        }
    });
}

var load_unread_messages_counts_request;

function load_unread_messages_counts() {
    var total_messages_count = 0;
    if (load_unread_messages_counts_request) {
        load_unread_messages_counts_request.abort();
    }
    load_unread_messages_counts_request = $.ajax({
        type: "POST",
        url: SITE_BASE_URL + "project/estates/messageCenterA/processor.php",
        data: {
            action: 'unread_messages_counts'
        },
        cache: false,
        success: function (data) {
            var result_set = $.parseJSON(data);
            if (result_set.error == 0) {
                $.each(result_set.result, function (key, value) {
                    var element_id = 'message_count_' + value.message_channel_type + '_' + value.message_channel_sender;
                    if (parseInt(value.message_channel_count) > 0) {
                        $('#' + element_id).addClass('msg-shape');
                        $('#' + element_id).html(value.message_channel_count);
                        total_messages_count = total_messages_count + parseInt(value.message_channel_count);
                    } else {
                        $('#' + element_id).removeClass('msg-shape');
                        $('#' + element_id).html('');
                    }
                });
                if (parseInt(total_messages_count) > 0) {
                    $('#messages_count_total').addClass('msg-shape');
                    $('#messages_count_total').html(total_messages_count);
                } else {
                    $('#messages_count_total').removeClass('msg-shape');
                    $('#messages_count_total').html('');
                }
            }
        }
    });
}

var load_unread_messages_counts_only_count_request;

function load_unread_messages_counts_only_count() {
    var total_messages_count = 0;
    if (load_unread_messages_counts_only_count_request) {
        load_unread_messages_counts_only_count_request.abort();
    }
    load_unread_messages_counts_only_count_request = $.ajax({
        type: "POST",
        url: SITE_BASE_URL + "project/estates/messageCenterA/processor.php",
        data: {
            action: 'unread_messages_counts'
        },
        cache: false,
        success: function (data) {
            var result_set = $.parseJSON(data);
            if (result_set.error == 0) {
                $.each(result_set.result, function (key, value) {
                    if (parseInt(value.message_channel_count) > 0) {
                        total_messages_count = total_messages_count + parseInt(value.message_channel_count);
                    }
                });
                if (parseInt(total_messages_count) > 0) {
                    $('#messages_count_total').addClass('msg-shape');
                    $('#messages_count_total').html(total_messages_count);
                } else {
                    $('#messages_count_total').removeClass('msg-shape');
                    $('#messages_count_total').html('');
                }
            }
        }
    });
}

var add_messages_left_cards_request;

function add_messages_left_cards() {
    if (add_messages_left_cards_request) {
        add_messages_left_cards_request.abort();
    }
    add_messages_left_cards_request = $.ajax({
        type: "POST",
        url: SITE_BASE_URL + "project/estates/messageCenterA/processor.php",
        data: {
            action: 'message_left_panel'
        },
        beforeSend: function () {
            $('#messages-list-lab-left').html('<img src="' + PROJECT_IMAGE_URL + 'loading_page.gif" style="margin-top:5%;margin-left:10%">');
        },
        cache: false,
        success: function (data) {
            $('#messages-list-lab-left').html(data);
            load_unread_messages_counts();
        }
    });
}


//(function ($) {


// initiateMaterialMessages();
/*(function (SITE_BASE_URL, SITE_INDEX_URL, SITE_LOGOUT_URL, SITE_LOGIN_URL, DOCUMENT_URL,
           MESSAGE_ATTACHMENT_URL, MEMBER_IMG_URL, DEPENDENT_PROFILE_IMG_URL,
           DEPENDENT_GUARDIAN_IMG_URL, DEPENDENT_MEDICAL_IMG_URL, DEPENDENT_SCHOOL_IMG_URL,
           PET_IMG_URL, DEFAULT_AVATAR_IMAGE_URL, PROJECT_IMAGE_URL, SITE_IDLE_TIME_MINUTES, tab_id,
           roles_array_values_obj, relationship_array_values_obj, get_role_guardian,
           PET_IMG_FOLDER, ESTATE_IMG_FOLDER, MEMBER_IMG_FOLDER, PROFILE_IMG_FOLDER) {*/
$(document).ready(function () {

    showMemberCards(true);

    $(document).on('click', '.message_member_li', function (e) {
        e.preventDefault();
        $('.message_member_ul').find('span.name').removeClass('selected-member');
        $(this).find('span.name').addClass('selected-member');
        var main = $('.message-box-display');
        var member_user_id = $(this).data('member-user-id');
        var member_image = $(this).data('member-image');
        var member_full_name = $(this).data('member-full-name');
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/messageCenterA/processor.php",
            url: SITE_BASE_URL + "message/message_box_display",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                //action: 'message_box_display',
                member_user_id: member_user_id
            },
            beforeSend: function () {
                main.html('');
            },
            cache: false,
            success: function (data) {
                main.html(data);
                main.find('.user_image').attr('src', member_image);
                main.find('.user_full_name').html(member_full_name);
                main.find('#message_to_user').val(member_user_id);
                go_to_latest_message();
                load_unread_messages_counts();
            }
        });
    });


    $(document).on('click', '.message_group_li', function (e) {
        e.preventDefault();
        $('.message_member_ul').find('span.name').removeClass('selected-member');
        $(this).find('span.name').addClass('selected-member');
        var main = $('.message-box-display');
        var message_group_id = $(this).data('group-id');
        if (parseInt(message_group_id) > 0) {
            $.ajax({
                type: "POST",
                // url: SITE_BASE_URL + "project/estates/messageCenterA/processor.php",
                url: SITE_BASE_URL + "message/message_group_box_display",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    //action: 'message_group_box_display',
                    message_group_id: message_group_id
                },
                beforeSend: function () {
                    main.html('');
                },
                cache: false,
                success: function (data) {
                    main.html(data);
                    load_unread_messages_counts();
                    go_to_latest_message();
                }
            });
        } else {
            toastr.error("Error");
        }
    });


    $(document).on('change', '#messages-groups-list', function (e) {
        e.preventDefault();
        var main = $('.message-box-display');
        var message_group_id = $(this).val();
        if (parseInt(message_group_id) > 0) {
            $.ajax({
                type: "POST",
                //url: SITE_BASE_URL + "project/estates/messageCenterA/processor.php",
                url: SITE_BASE_URL + "message/message_group_box_display",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    // action: 'message_group_box_display',
                    message_group_id: message_group_id
                },
                beforeSend: function () {
                    main.html('');
                },
                cache: false,
                success: function (data) {
                    main.html(data);
                    load_unread_messages_counts();
                }
            });
        }
    });

    function go_to_latest_message() {
        $('.message_set_container').scrollTop($('.message_set_container')[0].scrollHeight);
    }

    function reset_message() {
        $("#message_attach_image").val(null);
        $("#message_attach_file").val(null);
        $('#message_content').html('');
    }

    $(document).on('click', '.reset_message', function (e) {
        reset_message();
    });


    var attachment_start = '';
    var attachment_end = '';
    var message_attachment_string = '';
    var attachment_type = 0; // 0 - no , 1 - image , 2 - file

    $(document).on('click', '.message_send_button', function (e) {
        e.preventDefault();
        var message_to_user = $(this).closest('form').find('#message_to_user').val();
        var message_message_group_id = $(this).closest('form').find("#message_message_group_id").val();
        var message_content = $(this).closest('form').find('#message_content').html();
        var formdata = new FormData();
        var file = null;
        if (attachment_type == 1) {
            file = $("#message_attach_image").prop('files')[0];
        } else if (attachment_type == 2) {
            file = $("#message_attach_file").prop('files')[0];
        }
        formdata.append("message_attachment", file);
        formdata.append("message_type", attachment_type);
        formdata.append("message_content", message_content);
        formdata.append("message_to_user", message_to_user);
        formdata.append("message_message_group_id", message_message_group_id);
        formdata.append("message_attachment_string", message_attachment_string);

        var url = '';

        if (attachment_type == 1) {
            // formdata.append("action", 'message_imamessage_imagege');
            url = SITE_BASE_URL + "message/message_image";
        } else if (attachment_type == 2) {
            // formdata.append("action", 'message_attachment');
            url = SITE_BASE_URL + "message/message_attachment";
        } else if (attachment_type == 0) {
            if (parseInt(message_message_group_id) > 0) {
                //formdata.append("action", 'message_create_group_message');
                url = SITE_BASE_URL + "message/message_create_group_message";
            } else {
                // formdata.append("action", 'message_create');
                url = SITE_BASE_URL + "message/message_create";
            }
        }

        $.ajax({
            //url: SITE_BASE_URL + "project/estates/messageCenterA/processor.php",
            url: url,// SITE_BASE_URL + "message/message_group_box_display",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            data: formdata,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function (data, textStatus, jqXHR) {
                var result_set = $.parseJSON(data);
                if (result_set.error == 0) {
                    reset_message();
                    $('.message_set_container').append(result_set.result);
                    go_to_latest_message();
                } else {
                    toastr.error(result_set.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                toastr.error('Error !');
            }
        });

    });

    $(document).on('click', '.add_to_my_message_groups', function (e) {
        e.preventDefault(); // message_group_members_user_ids
        var message_group_members_user_ids = $('#group_member_select_chat').val();
        $('#message_group_members_user_ids').val(message_group_members_user_ids);
        $('#myMessageGroupsCreate').modal('show');
    });

    var update_message_groups_request;

    function update_message_groups() {
        if (update_message_groups_request) {
            update_message_groups_request.abort();
        }

        update_message_groups_request =
            $.ajax({
                type: "POST",
                //url: SITE_BASE_URL + "project/estates/messageCenterA/processor.php",
                url: SITE_BASE_URL + "message/message_groups_select",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                /* data: {
                     action: 'message_groups_select'
                 },*/
                cache: false,
                success: function (data) {
                    $('#messages-groups-list').html(data);
                    $('#messages-groups-list').materialSelect();
                    $('#messages-groups-list').closest('input.select-dropdown').addClass('active');
                    $('#messages-groups-list').closest('div.select-wrapper').find('ul').css('width','145px');
                    $('#messages-groups-list').closest('div.select-wrapper').find('ul').css('position','absolute');
                    $('#messages-groups-list').closest('div.select-wrapper').find('ul').css('top','0px');
                    $('#messages-groups-list').closest('div.select-wrapper').find('ul').css('left','0px');
                    $('#messages-groups-list').closest('div.select-wrapper').find('ul').css('opacity','1');
                    $('#messages-groups-list').closest('div.select-wrapper').find('ul').css('display','block');
                }
            });
    }

    update_message_groups();

    $('#message_group_form').submit(function (e) {
        e.preventDefault();
        var message_group_members_user_ids = $('#message_group_members_user_ids').val();
        var message_group_name = $('#message_group_name').val();
        if (message_group_members_user_ids.length > 0 && message_group_name.length > 0) {
            $.ajax({
                type: "POST",
                //url: SITE_BASE_URL + "project/estates/messageCenterA/processor.php",
                url: SITE_BASE_URL + "message/message_group_create",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    //action: 'message_group_create',
                    message_group_name: message_group_name,
                    message_group_members_user_ids: message_group_members_user_ids
                },
                cache: false,
                success: function (data) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        toastr.success(result_set.message);
                    } else {
                        toastr.error(result_set.message);
                    }
                    $('#myMessageGroupsCreate').modal('hide');
                    //update_message_groups();
                    //showMemberCards();
                    location.reload();
                }
            });
        }
    });


    $(document).on('click', '.message_group_send_button', function (e) {
        e.preventDefault();
        var message_message_group_id = $(this).closest('form').find('#message_message_group_id').val();
        var message_content = $(this).closest('form').find('#message_content').html();
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/messageCenterA/processor.php",
            url: SITE_BASE_URL + "message/message_create_group_message",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                // action: 'message_create_group_message',
                message_message_group_id: message_message_group_id,
                message_content: message_content
            },
            cache: false,
            success: function (data) {
                //main.html(data);
                var result_set = $.parseJSON(data);
                if (result_set.error == 0) {
                    reset_message();
                    $('.message_set_container').append(result_set.result);
                    go_to_latest_message();
                } else {
                    toastr.error(result_set.message);
                }
            }
        });
    });


    function readURLImageMessage(input) {
        if (input.prop('files') && input.prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                if ($('#message_content').find('.message_attachment').length > 0) $('#message_content').find('.message_attachment').remove();
                var src = e.target.result;
                message_attachment_string = '<img src="' + src + '" class="message_attachment" id="message_attachment_image_display">';
                $('#message_content').append($(message_attachment_string));
                $('#message_content').focus();
            };
            reader.readAsDataURL(input.prop('files')[0]);
        }
    }

    function readURLAttachmentMessage(input) {
        if (input.prop('files') && input.prop('files')[0]) {
            if ($('#message_content').find('.message_attachment').length > 0) $('#message_content').find('.message_attachment').remove();
            attachment_type = 2;
            var file_name = input.prop('files')[0].name;
            message_attachment_string = '<button contenteditable="false" class="message_attachment">File :' + file_name + '</button>';
            $('#message_content').append($(message_attachment_string));
            $('#message_content').focus();
        }
    }

    $(document).on('change', '#message_attach_image', function () {
        if ($(this).prop('files').length > 0) {
            attachment_type = 1;
            readURLImageMessage($(this));
        } else {
            toastr.error('Error !');
        }
    });

    $(document).on('click', '.message_attachment_show', function (e) {
        e.preventDefault();
        var body = ' <embed src="' + $(this).attr('href') + '"  frameborder="0" width="100%" height="400px">';
        $('#messageAttachmentShowModal .modal-body').html(body);
        $('#messageAttachmentShowModal .download_link').attr('href', $(this).attr('href'));
        $('#messageAttachmentShowModal').modal('show');
    });


    $(document).on('change', '#message_attach_file', function () {
        if ($(this).prop('files').length > 0) {
            readURLAttachmentMessage($(this));
        } else {
            toastr.error('Error !');
        }

    });


    $('#search_messages_member_card_set').keyup(function () {
        var search_val = $(this).val().trim().toLocaleLowerCase();
        if (search_val != '') {
            $.each(message_li_search_json, function (index, value) {
                var show_element = false;
                $.each(value, function (ii, vv) {
                    vv = vv.toLocaleLowerCase();
                    if (vv.search(search_val) != -1) {
                        show_element = true;
                    }
                });
                if (show_element) {
                    $('#' + index).show();
                } else {
                    $('#' + index).hide();
                }
            });
        } else {
            $(".message_member_ul .message_li_set").show();
        }
    });


    $(document).on('click', '.message_group_delete', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var message_message_group_id = $(this).closest('.message_group_li').data('group-id');
        $.ajax({
            type: "POST",
            // url: SITE_BASE_URL + "project/estates/messageCenterA/processor.php",
            url: SITE_BASE_URL + "message/message_create_group_message",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                // action: 'delete_message_group',
                message_message_group_id: message_message_group_id
            },
            cache: false,
            success: function (data) {
                //main.html(data);
                var result_set = $.parseJSON(data);
                if (result_set.error == 0) {
                    //showMemberCards();
                    toastr.success(result_set.message);
                    location.reload();
                } else {
                    toastr.error(result_set.message);
                }
            }
        });
    });

    /*var table_dtRecentActivity = null;

    $('#open_activity_log_modal').click(function () {
        // table_dtRecentActivity.destroy();
        $('#ActivityLogModal').modal('show');
        table_dtRecentActivity = $('#dtRecentActivity').DataTable({
            "processing": true,
            "serverSide": true,
            destroy: true,
            "infoCallback": function (settings, start, end, max, total, pre) {
                return "Showing " + start + " to " + end + " of " + total + " entries.";
            },
            "order": [[0, 'desc']],
            "lengthMenu": [10, 25, 50, 100],
            "ajax": SITE_BASE_URL+"project/estates/activities/server_processing.php"
        });

    });*/

    // dashboard/ajax_activity_log


    $('#open_activity_log_modal').click(function () {

        $.ajax({
            type: "POST",
            // url: SITE_BASE_URL+"project/estates/forms/documentForms/document-modals/document-tabs-modal.php",
            url: SITE_BASE_URL + 'dashboard/ajax_activity_log',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                $('#ActivityLogModal .modal-body').html(data);
                $('#ActivityLogModal').modal('show');
                var displayStart = 0;
                $('#dtRecentActivity').DataTable({
                    "ordering": true, // false to disable sorting (or any other option),
                    'displayStart': displayStart
                });
                $('.dataTables_length').addClass('bs-select');
            }
        });
    });


    function opened_random_continuous_task(card_element) {
        add_tasks_on_dashboard();
        //var random_continuous_task_id = card_element.data('task-id');
        // random_continuous_task_delete(random_continuous_task_id, 1)
    }

    function opened_intermittent_company_task(card_element) {
        var intermittent_company_task_id = card_element.data('task-id');
        intermittent_company_task_delete(intermittent_company_task_id, 1)
    }

    function random_continuous_task_delete(random_continuous_task_id, no_message) {
        $.ajax({
            type: "POST",
            url: SITE_BASE_URL + "project/estates/tasks/processor.php",
            data: {
                action: 'random_continuous_task_delete',
                random_continuous_task_id: random_continuous_task_id
            },
            success: function (data) {
                var result_set = $.parseJSON(data);
                if (result_set.error == 0) {
                    if (no_message != 1)
                        toastr.success(result_set.message);
                } else {
                    if (no_message != 1)
                        toastr.error(result_set.message);
                }
                add_tasks_on_dashboard();
            }
        });
    }

    function intermittent_company_task_delete(intermittent_company_task_id, no_message) {
        $.ajax({
            type: "POST",
            url: SITE_BASE_URL + "project/estates/tasks/processor.php",
            data: {
                action: 'intermittent_company_task_delete',
                intermittent_company_task_id: intermittent_company_task_id
            },
            success: function (data) {
                var result_set = $.parseJSON(data);
                if (result_set.error == 0) {
                    if (no_message != 1)
                        toastr.success(result_set.message);
                } else {
                    if (no_message != 1)
                        toastr.error(result_set.message);
                }
                add_tasks_on_dashboard();
            }
        });
    }

    function random_continuous_task_skip(random_continuous_task_id, no_message) {
        $.ajax({
            type: "POST",
            url: SITE_BASE_URL + "project/estates/tasks/processor.php",
            data: {
                action: 'random_continuous_task_skip',
                random_continuous_task_id: random_continuous_task_id
            },
            success: function (data) {
                var result_set = $.parseJSON(data);
                if (result_set.error == 0) {
                    if (no_message != 1)
                        toastr.success(result_set.message);
                } else {
                    if (no_message != 1)
                        toastr.error(result_set.message);
                }
                add_tasks_on_dashboard();
            }
        });
    }


    function intermittent_company_task_skip(intermittent_company_task_id, no_message) {
        $.ajax({
            type: "POST",
            url: SITE_BASE_URL + "project/estates/tasks/processor.php",
            data: {
                action: 'intermittent_company_task_skip',
                intermittent_company_task_id: intermittent_company_task_id
            },
            success: function (data) {
                var result_set = $.parseJSON(data);
                if (result_set.error == 0) {
                    if (no_message != 1)
                        toastr.success(result_set.message);
                } else {
                    if (no_message != 1)
                        toastr.error(result_set.message);
                }
                add_tasks_on_dashboard();
            }
        });
    }

    $(document).on('click', '.switch_tab_to_update', function (e) {
        e.preventDefault();
        var card_element = $(this).closest('.card');
        var task_skip_task_id = card_element.data('task-id');
        var modal_id = card_element.data('task_popup_id');
        var modal_title = card_element.data('task_popup_title');
        var modal_body = card_element.data('task_popup_body');
        var task_category = card_element.data('task_category');
        var task_more_tasks = card_element.data('task_more_tasks');
        var task_skip_sub_category = card_element.data('task_skip_sub_category');

        var task_type = card_element.data('task-type');

        if (task_type == 'roles_task') {
            window.location = USER_SWITCH_TYPE == 1 ? TAB_KID_MEMBER : TAB_ESTATE_MEMBER ;
            return false;
        }

        if (task_type == 'random_continuous_task') {
            opened_random_continuous_task(card_element);
            return false;
        }

        if (task_type == 'intermittent_company_task') {
            opened_intermittent_company_task(card_element);
            return false;
        }

        if (task_type == 'invitation_email_task') {
            task_delete(task_skip_task_id, task_skip_sub_category, 1);
            return false;
        }

        if (modal_id != 0 && modal_title != 0) {
            task_modal_open(modal_id, modal_title, modal_body);
        }

        if (task_more_tasks == 1) {
            task_delete(task_skip_task_id, task_skip_sub_category, 1);

        } else if (task_category == 'welcome_task') {
            task_delete(task_skip_task_id, task_skip_sub_category, 1);
        }

    });

    $(document).on('click', '.skip_task', function (e) {
        e.preventDefault();
        var card_element = $(this).closest('.card');
        var task_skip_task_id = card_element.data('task-id');
        var task_skip_sub_category = card_element.data('task_skip_sub_category');

        var task_type = card_element.data('task-type');
        if (task_type == 'random_continuous_task') {
            random_continuous_task_skip(task_skip_task_id);
            return false;
        }

        if (task_type == 'intermittent_company_task') {
            intermittent_company_task_skip(task_skip_task_id);
            return false;
        }

        task_skip(task_skip_task_id, task_skip_sub_category);
        add_tasks_on_dashboard();

    });

    $(document).on('click', '.skip_table_task_container .delete_task,.task_container .delete_task', function (e) {
        e.preventDefault();
        var task_container = $(this).closest('.task_container_set');
        var task_skip_task_id = task_container.data('task-id');
        var task_skip_sub_category = task_container.data('task_skip_sub_category');

        var task_type = task_container.data('task-type');
        if (task_type == 'random_continuous_task') {
            random_continuous_task_delete(task_skip_task_id);
            return false;
        }
        if (task_type == 'intermittent_company_task') {
            intermittent_company_task_delete(task_skip_task_id);
            return false;
        }
        task_delete(task_skip_task_id, task_skip_sub_category);

    });

    function task_delete(task_skip_task_id, task_skip_sub_category, no_message) {
        $('#task_panel').html('<img src="' + PROJECT_IMAGE_URL + 'loading_page.gif" style="margin-top:5%;margin-left:10%">');
        $.ajax({
            type: "POST",
            // url: SITE_BASE_URL + "project/estates/tasks/processor.php",
            url: SITE_BASE_URL + "dashboard/ajax_delete_task",
            data: {
                task_skip_task_id: task_skip_task_id,
                task_skip_sub_category: task_skip_sub_category
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                var result_set = $.parseJSON(data);
                if (result_set.error == 0) {
                    if (no_message != 1)
                        toastr.success(result_set.message);
                } else {
                    if (no_message != 1)
                        toastr.error(result_set.message);
                }
                add_tasks_on_dashboard();
            }
        });
    }

    function task_modal_open(modal_id, modal_title, modal_body) {
        var modal_to_open = $('#' + modal_id);
        modal_to_open.find('.modal-title').html(modal_title);
        if (modal_body.length > 0) {
            modal_to_open.find('.modal-body').html(modal_body);
        }
        modal_to_open.modal('toggle');
    }


    function task_skip(task_skip_task_id, task_skip_sub_category, no_message) {
        $('#task_panel').html('<img src="' + PROJECT_IMAGE_URL + 'loading_page.gif" style="margin-top:5%;margin-left:10%">');
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/tasks/processor.php",
            url: SITE_BASE_URL + "dashboard/ajax_skip_task",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                //action: 'task_skip',
                task_skip_task_id: task_skip_task_id,
                task_skip_sub_category: task_skip_sub_category
            },
            success: function (data) {
                var result_set = $.parseJSON(data);
                if (result_set.error == 0) {
                    if (no_message != 1)
                        toastr.success(result_set.message);
                } else {
                    if (no_message != 1)
                        toastr.error(result_set.message);
                }
                add_tasks_on_dashboard();
            }
        });
    }

    /*
        $(document).on('hidden.bs.modal', '#documentTabsModal,#addNewMemberID1,#addNewdependentID1', function () {
            add_tasks_on_dashboard();
        });*/

    /*$(document).on('click', '#btnChange-estate,#btnChange-profile,#btnChange-maritalStatus', function () {
        $('#addNewMemberID1').modal('hide');
    });*/


    $('#open_calendar_events_modal').click(function () {
        add_calendar_events();
    });


    function add_calendar_events() {
        $('#dtEventCalendar').html('');
        // replace with the new table
        $.ajax({
            type: "POST",
            // url: SITE_BASE_URL+"project/estates/events/server_processing.php",
            url: SITE_BASE_URL + "dashboard/ajax_calendar_events",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            cache: false,
            success: function (data) {
                //$('#dtEventCalendar').html(data);
                $('#CalendarEvents .modal-body').html(data);
                $('#dtEventCalendar').DataTable({
                    "ordering": true // false to disable sorting (or any other option),
                });
                $('.dataTables_length').addClass('bs-select');
            }
        });
    }


});


/*})(jQuery);*/


