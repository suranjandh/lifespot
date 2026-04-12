function initiateMaterialMember(container) {
    //container.find('.mdb-select').material_select();
    // container.find('.mdb-select').material_select('destroy');
    //  container.find('.mdb-select').material_select();

    container.find('#member_role_in_estate').material_select('destroy');
    container.find('#member_role_in_estate').material_select();

    container.find('#member_guardian_dependents').material_select('destroy');
    container.find('#member_guardian_dependents').material_select();
    $('#addNewMemberID1 #member_birth_day').pickadate({
        selectYears: 100,
        min: new Date(1902, 3, 20),
        max: new Date(2020, 7, 14),
        format: 'mm/dd/yyyy'
    });
    $('#addNewMemberID1 .phone_us').mask('(000) 000-0000');
}


function initiateMaterialDependent(container) {

    //container.find("#guardian_member_role_in_estate").material_select();
    //container.find("#member_guardian_dependents").material_select();
    container.find('#guardian_member_role_in_estate').material_select('destroy');
    container.find('#guardian_member_role_in_estate').material_select();

    container.find('#dependent_role_in_estate').material_select('destroy');
    container.find('#dependent_role_in_estate').material_select();

    container.find('#member_guardian_dependents').material_select('destroy');
    container.find('#member_guardian_dependents').material_select();


    container.find('#dependent_birth_day').pickadate({
        selectYears: 100,
        min: new Date(1902, 3, 20),
        max: new Date(2020, 7, 14),
        format: 'mm/dd/yyyy'
    });

    container.find('#guardian_member_birth_day').pickadate({
        selectYears: 100,
        min: new Date(1902, 3, 20),
        max: new Date(2020, 7, 14),
        format: 'mm/dd/yyyy'
    });
    // container.find('.mdb-select-dependent').material_select();
    container.find('#dependent_school_grade').material_select('destroy');
    container.find('#dependent_school_grade').material_select();
    container.find('.phone_us').mask('(000) 000-0000');

    // container.find('#dependent_school_grade').material_select();
}

function initiateMaterialDocumentUpload(container) {
    // container.find('.mdb-select').material_select('destroy');
    // container.find('.mdb-select').material_select();
    container.find('#document_category').material_select('destroy');
    container.find('#document_category').material_select();

    container.find('#document_category_sub').material_select('destroy');
    container.find('#document_category_sub').material_select();

    container.find('#document_category_sub_sub').material_select('destroy');
    container.find('#document_category_sub_sub').material_select();

    container.find('#document_category_sub_sub_sub').material_select('destroy');
    container.find('#document_category_sub_sub_sub').material_select();

    container.find('#document_content_type').material_select('destroy');
    container.find('#document_content_type').material_select();


}


function initiateMaterialDocumentUploadNew(container) {
    // container.find('.mdb-select').material_select('destroy');
    // container.find('.mdb-select').material_select();
    container.find('#document_category').material_select('destroy');
    container.find('#document_category').material_select();

    container.find('#document_category_sub').material_select('destroy');
    container.find('#document_category_sub').material_select();

    container.find('#document_category_sub_sub').material_select('destroy');
    container.find('#document_category_sub_sub').material_select();

    container.find('#document_category_sub_sub_sub').material_select('destroy');
    container.find('#document_category_sub_sub_sub').material_select();

    container.find('#document_created').pickadate({
        selectYears: 100,
        min: new Date(1902, 3, 20),
        max: new Date(2020, 7, 14),
        format: 'mm/dd/yyyy'
    });


}


function initiateMaterialSpouse(container) {
    container.find('#spouse_birth_day').pickadate({
        selectYears: 100,
        min: new Date(1902, 3, 20),
        max: new Date(2020, 7, 14),
        format: 'mm/dd/yyyy'
    });
    container.find('#spouse_anniversary').pickadate({
        selectYears: 100,
        min: new Date(1902, 3, 20),
        max: new Date(2020, 7, 14),
        format: 'mm/dd/yyyy'
    });
    container.find('.phone_us').mask('(000) 000-0000');

    //container.find('#spouse_role_in_estate').material_select();
    if (container.attr('id') == 'addNewMemberID1') {
        container.find('#spouse_role_in_estate').material_select('destroy');
        container.find('#spouse_role_in_estate').material_select();
    }
}

function initiateMaterialBeneficiary(container) {
    container.find('#beneficiary_bday').pickadate({
        selectYears: 100,
        min: new Date(1902, 3, 20),
        max: new Date(2020, 7, 14),
        format: 'mm/dd/yyyy'
    });
    container.find('#beneficiary_anniversary').pickadate({
        selectYears: 100,
        min: new Date(1902, 3, 20),
        max: new Date(2020, 7, 14),
        format: 'mm/dd/yyyy'
    });
    container.find('.phone_us').mask('(000) 000-0000');

}

function initiateMaterialEmergency_contact(container) {
    container.find('.phone_us').mask('(000) 000-0000');
}

function initiateMaterialFriend(container) {
    container.find('.phone_us').mask('(000) 000-0000');
}


function initiateMaterialPet(container) {
    container.find('#pet_birthday').pickadate({
        selectYears: 100,
        min: new Date(1902, 3, 20),
        max: new Date(2020, 7, 14),
        format: 'mm/dd/yyyy'
    });

    container.find('.phone_us').mask('(000) 000-0000');
}

function initiateMaterialProfile(container) {

    container.find('#profileBdayField').pickadate({
        selectYears: 100,
        min: new Date(1902, 3, 20),
        max: new Date(2020, 7, 14),
        format: 'mm/dd/yyyy'
    });

    // container.find('#profileMaritalStatus').material_select();
    if (container.attr('id') == 'addNewMemberID1') {
        container.find('#profileMaritalStatus').material_select('destroy');
        container.find('#profileMaritalStatus').material_select();
    }

    container.find('.phone_us').mask('(000) 000-0000');

}


function initiateMaterialMessages() {
    $('#group_member_select_chat').material_select('destroy');
    $('#group_member_select_chat').material_select();
    $('#messages-groups-list').material_select('destroy');
    $('#messages-groups-list').material_select();
}

function validateRequiredElementsSet(elements_set, form) {
    var validated = true;
    var not_validate = [];
    $.each(elements_set, function (i, e) {
        var element = form !== undefined ? form.find('#' + e) : $('#' + e);
        element.removeClass('validated_false');
        if (element.val().trim() == '') {
            validated = false;
            element.addClass('validated_false');
            var label = element.parent().find('label').html();
            not_validate.push(label);
        }
    });
    var message = not_validate.join(',');
    message = not_validate.length > 1 ? message + " fields required !" : message + " field required !";
    return validated ? validated : message;
}

function add_document_open(document_element, member_id) {
    document_element.removeClass('documents_disabled');
    document_element.data('document-category-sub-sub', member_id);

}

function convert_date(dateString) {
    if (dateString.trim() == '') return '';
    var date = new Date(dateString),
        yr = date.getFullYear(),
        month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
        day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
        newDate = yr + '-' + month + '-' + day;
    return newDate;
}


var idleMax = SITE_IDLE_TIME_MINUTES; // Logout after ? minutes of IDLE
var idleTime = 0;
var idleInterval = setInterval("timerIncrement()", 60000);  // 1 minute interval
$("body").mousemove(function (event) {
    idleTime = 0; // reset to zero
});

// count minutes
function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > idleMax) {
        window.location = SITE_LOGOUT_URL;
    }
    // ajax logout
    $.ajax({
        type: "POST",
        //url: SITE_BASE_URL+"project/estates/common/processor.php",
        url: SITE_BASE_URL + "check_session",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            action: 'check_session'
        },
        success: function (data) {
            var result_set = $.parseJSON(data);
            if (result_set.error == 1) {
                toastr.error(result_set.message);
                window.location = SITE_LOGOUT_URL;
            }
        }
    });
}






