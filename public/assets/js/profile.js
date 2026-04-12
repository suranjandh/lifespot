/*(function ($, SITE_BASE_URL, SITE_INDEX_URL, SITE_LOGOUT_URL, SITE_LOGIN_URL, DOCUMENT_URL,
           MESSAGE_ATTACHMENT_URL, MEMBER_IMG_URL, DEPENDENT_PROFILE_IMG_URL,
           DEPENDENT_GUARDIAN_IMG_URL, DEPENDENT_MEDICAL_IMG_URL, DEPENDENT_SCHOOL_IMG_URL,
           PET_IMG_URL, DEFAULT_AVATAR_IMAGE_URL, PROJECT_IMAGE_URL, SITE_IDLE_TIME_MINUTES, tab_id,
           roles_array_values_obj, relationship_array_values_obj, get_role_guardian,
           PET_IMG_FOLDER, ESTATE_IMG_FOLDER, MEMBER_IMG_FOLDER, PROFILE_IMG_FOLDER) {*/

$(document).ready(function () {
    var form_estate_data;
    var estate_name_added_by_estate_step = 0;
    var btnChanges_estate = "#btnChange-estate, #btnChangeNext-estate";
    $(document).on('click', btnChanges_estate, function () {
        form_estate_data = $(this).closest('form');
        if (!formDidChange_estate) return false;

        var estate_id = form_estate_data.find("#estate_id").val();
        var estate_name = form_estate_data.find("#estate_name").val();
        var estate_owner_name = form_estate_data.find("#estate_owner_name").val();
        var estate_address = form_estate_data.find("#estate_address").val();
        var estate_address2 = form_estate_data.find("#estate_address2").val();
        var estate_city = form_estate_data.find("#estate_city").val();
        var estate_zip = form_estate_data.find("#estate_zip").val();
        var estate_state = form_estate_data.find("#estate_state").val();
        var estate_notes = form_estate_data.find("#estate_notes").val();
        var estate_is_primary_residence = form_estate_data.find('input[name=estate_is_primary_residence]:checked').val();
        var estate_does_own_home = form_estate_data.find('input[name=estate_does_own_home]:checked').val();
        var validated = validateRequiredElementsSet(['estate_name', 'estate_owner_name'], form_estate_data);
        if (validated != true) {
            toastr.error(validated);
            return false;
        }
        $.ajax({
            type: "POST",
            url: SITE_BASE_URL + "estate/ajax_estate_edit",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                action_on: 'Estate',
                estate_id: estate_id,
                estate_name: estate_name,
                estate_owner_name: estate_owner_name,
                estate_address: estate_address,
                estate_address2: estate_address2,
                estate_city: estate_city,
                estate_zip: estate_zip,
                estate_state: estate_state,
                estate_notes: estate_notes,
                estate_is_primary_residence: estate_is_primary_residence,
                estate_does_own_home: estate_does_own_home
            },
            success: function (data) {
                setValuesEstate(data, true);
                check_and_load_snapshot();
            }
        });
    });


    function setValuesEstate(data, error_display, update) {
        var result_set = $.parseJSON(data);
        if (result_set.error != 1) {
            var result = result_set.result;
            $('#estate_id').val(result.estate_id);
            $('#' + result.profile_gender + '-profile').prop("checked", true);

            if (result.estate_name.trim() != '') {
                $("#estate_name").val(result.estate_name);
                $("#estate_name_added_by_estate").html(result.estate_name);
                $("#estate_name_added_by_estate").data("added-estate-name", 1);

            }
            if (result.estate_owner_name.trim() != '') {
                $("#estate_owner_name").val(result.estate_owner_name);
            }

            $("#estate_address").val(result.estate_address);
            $("#estate_address2").val(result.estate_address2);
            $("#estate_city").val(result.estate_city);
            $("#estate_zip").val(result.estate_zip);
            $("#estate_state").val(result.estate_state);
            $("#estate_notes").val(result.estate_notes);
            if (result.estate_is_primary_residence == 1) $('.estate_is_primary_residence').prop("checked", true);
            else $('.estate_is_primary_residence').prop("checked", false);
            if (result.estate_does_own_home == 1) $('.estate_does_own_home').prop("checked", true);
            else $('.estate_does_own_home').prop("checked", false);
            if (result.estate_image != '') {
                $("#estate_image_image").attr('src', SITE_BASE_URL + ESTATE_IMG_FOLDER + '/' + result.estate_image + '?rand=' + Math.random());
                $(".estate_image_image").attr('src', SITE_BASE_URL + ESTATE_IMG_FOLDER + '/' + result.estate_image + '?rand=' + Math.random());
            }
        }

        if (error_display != false) {
            if (result_set.error != 1) {
                if (formDidChange_estate) {
                    // alert(formDidChange_estate);
                    formDidChange_estate = false;
                }
                toastr.success(result_set.message);
                add_image_also_estate();
            } else {
                toastr.error(result_set.message);
            }
        }
    }

    function add_image_also_estate() {
        if ($('#estate_picture').prop('files').length > 0) {
            $('#estate_picture').trigger('change');
        } else {
            showMemberCards();
        }
    }

    function readURLEstate(input) {
        if (input.prop('files') && input.prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#estate_image_image').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.prop('files')[0]);
        }
    }

    /*  $.ajax({
          type: "POST",
          url: SITE_BASE_URL+"project/estates/forms/About-Me/Estate/processor.php",
          data: {
              action: 'read'
          },
          success: function (data) {
              setValuesEstate(data, false, false)
          }
      });*/


    $(document).on('change', '#estate_picture', function () {
        var estate_id = $("#estate_id").val().trim();
        if (estate_id == '') {
            readURLEstate($(this));
            return false;
        }
        //on change event
        $('#loading_estate_image_image').show();
        $('#estate_image_image').hide();
        var formdata = new FormData();
        if ($(this).prop('files').length > 0) {
            var file = $(this).prop('files')[0];
            formdata.append("estate_image", file);
            formdata.append("action_on", 'Estate');
            $(this).replaceWith($(this).val('').clone(true));

            $.ajax({
                //url: SITE_BASE_URL+"project/estates/forms/About-Me/Estate/image_processor.php",
                url: SITE_BASE_URL + "estate_image/ajax_estate_image",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: formdata,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (data, textStatus, jqXHR) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        $('#estate_image_image').attr('src', result_set.result);
                        $('.estate_image_image').attr('src', result_set.result);
                        toastr.success(result_set.message);
                    } else {
                        toastr.error(result_set.message);
                    }

                    $('#loading_estate_image_image').hide();
                    $('#estate_image_image').show();
                    showMemberCards();

                    //make_submit_button_disable($('#btnChange-estate'));
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    toastr.error(errorThrown);
                    $('#loading_estate_image_image').hide();
                    $('#estate_image_image').show();
                    //make_submit_button_disable($('#btnChange-estate'));
                    showMemberCards();
                    // STOP LOADING SPINNER
                }
            });
        }
    });


    var form = null;
    var btnChanges_profile = "#btnChange-profile, #btnChangeNext-profile";
    $(document).on('click', btnChanges_profile, function () {
        form = $(this).closest('form');
        if (!formDidChange_profile) return false;

        var userGender = form.find('input[name=userGender]:checked').val();
        var profileFName = form.find("#profileFName").val();
        var profileLName = form.find("#profileLName").val();
        var profile_email = form.find('#profile_email').val();
        var profilePhone = form.find('#profilePhone').val();
        var profilePhone2 = form.find('#profilePhone2').val();
        var profileBday = convert_date(form.find('#profileBdayField').val());
        var profileMaritalStatus = form.find('#profileMaritalStatus').val();
        var profileDependents = form.find('#profileDependents').val();
        var profileEthnicity = form.find('#profileEthnicity').val();
        var profileNickName = form.find('#profileNickName').val();
        var profileNotes = form.find('#profileNotes').val();
        var validated = validateRequiredElementsSet(['profileFName', 'profileLName'], form);
        if (validated != true) {
            toastr.error(validated);
            return false;
        }
        $.ajax({
            type: "POST",
            url: SITE_BASE_URL + "estate/ajax_profile_edit",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                action_on: 'Profile',
                profile_gender: userGender,
                profile_first_name: profileFName,
                profile_last_name: profileLName,
                profile_email: profile_email,
                profile_phone: profilePhone,
                profile_phone2: profilePhone2,
                profile_birth_day: profileBday,
                profile_maritalStatus: profileMaritalStatus,
                profile_dependents: profileDependents,
                profile_nickName: profileNickName,
                profile_profile_notes: profileNotes
            },
            success: function (data) {
                setValuesProfile(data, true, false);
            }
        });
    });

    function setValuesProfile(data, error_display, update) {
        var result_set = $.parseJSON(data);
        if (result_set.error != 1) {
            var result = result_set.result;
            $("#profile_id").val(result.profile_id);
            //$('#' + result.profile_gender + '-profile').prop("checked", true);
            //$('input[name=userGender].prop("checked", true);
            $('.' + result.profile_gender + '-profile').prop("checked", true);
            if (result.profile_first_name.trim() != '') {
                $("#profileFName").val(result.profile_first_name);
                $('.bind_profile_first_name').html(result.profile_first_name);
            } else {
                $("#profileFName").val(result.user_first_name);
                $('.bind_profile_first_name').html(result.user_first_name);
            }
            if (result.profile_email.trim() != '') {
                $("#profile_email").val(result.profile_email);
            } else {
                $("#profile_email").val(result.user_email);
            }
            if (result.profile_last_name.trim() != '') {
                $("#profileLName").val(result.profile_last_name);
            } else {
                $("#profileLName").val(result.user_last_name);
            }
            $("#profilePhone").val(result.profile_phone);
            $("#profilePhone2").val(result.profile_phone2);
            $("#profileDependents").val(result.profile_dependents);
            if (result.profile_birth_day) {
                var date_split = result.profile_birth_day.split('-');
                if (parseInt(date_split[0]) > 0)
                    $("#profileBdayField").val('' + date_split[1] + '/' + date_split[2] + '/' + date_split[0]);
            }
            if (result.profile_maritalStatus != '')
                setMarriedProfile(result.profile_maritalStatus);
            $("#profileEthnicity").val(result.profile_ethnicity);
            $("#profileNickName").val(result.profile_nickName);
            $("#profileNotes").val(result.profile_profile_notes);
            if (result.profile_image != '')
                $("#profile_image_img").attr('src', SITE_BASE_URL + PROFILE_IMG_FOLDER + '/' + result.profile_image + '?rand=' + Math.random());
        }
        initiateMaterialProfile($('#form-profile'));
        if (error_display != false) {
            if (result_set.error != 1) {
                if (formDidChange_profile) {
                    formDidChange_profile = false;
                }
                // toastr.success(result_set.message);
                // function adds if there is new upload
                toastr.success(result_set.message);
                add_image_also_profile();
            } else {
                toastr.error(result_set.message);
            }
        }
    }

    var image_uploading_also = false;

    function add_image_also_profile() {
        if ($('#profile_picture').prop('files').length > 0) {
            image_uploading_also = true;
            $('#profile_picture').trigger('change');
        } else {
            showMemberCards();
        }
    }

    function readURLProfile(input) {
        if (input.prop('files') && input.prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#profile_image_img').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.prop('files')[0]);
        }
    }

    function setMarriedProfile(key) {
        /* $('#profileMaritalStatus option').each(function () {
             if ($(this).val() == key) {
                 $(this).prop('selected', true);
             }
         });
         $('#profileMaritalStatus').material_select();*/
    }


    // initiateProfile();

    $(document).on('change', '#profile_picture', function () {
        var profile_id = $("#profile_id").val().trim();
        if (profile_id == '') {
            readURLProfile($(this));
            return false;
        }
        //on change event
        var formdata = new FormData();
        if ($(this).prop('files').length > 0) {
            var file = $(this).prop('files')[0];
            formdata.append("profile_image", file);
            formdata.append("action_on", 'Profile');
            $(this).replaceWith($(this).val('').clone(true));

            $.ajax({
                // url: SITE_BASE_URL+"project/estates/forms/About-Me/Profile/image_processor.php",
                url: SITE_BASE_URL + "estate_image/ajax_profile_image",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: formdata,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (data, textStatus, jqXHR) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        $('#profile_image_img').attr('src', result_set.result);
                        $('.profile_image_img').attr('src', result_set.result);
                    }
                    toastr.success(result_set.message);
                    //showMemberCards();
                    //make_submit_button_disable($('#btnChange-profile'));
                    // if(image_uploading_also){
                    // if (!(($("#addNewMemberID1").data('bs.modal') || {})._isShown)) {
                    showMemberCards();
                    //  }
                    //    image_uploading_also = false ;
                    // }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    toastr.error(errorThrown);
                    //make_submit_button_disable($('#btnChange-profile'));
                    // if(image_uploading_also){
                    // if (!(($("#addNewMemberID1").data('bs.modal') || {})._isShown)) {
                    //    showMemberCards();
                    // }                            //    image_uploading_also = false ;
                    // }
                    // STOP LOADING SPINNER

                }
            });
        }
    });

    initiateMaterialProfile($('#form-profile'));


    var formSpouse = null;
    var btnChanges_maritalStatus = "#btnChange-maritalStatus, #btnChangeNext-maritalStatus";
    $(document).on('click', btnChanges_maritalStatus,
        function () {
            formSpouse = $(this).closest('form');
            var spouse_member_id = formSpouse.find("#spouse_member_id").val();
            var spouse_gender = formSpouse.find('input[name="spouse_gender"]:checked').val();
            var spouse_first_name = formSpouse.find("#spouse_first_name").val();
            var spouse_last_name = formSpouse.find("#spouse_last_name").val();
            var spouse_email = formSpouse.find("#spouse_email").val();
            var spouse_role_in_estate_array = getRolesArraySpouse();
            var spouse_role_in_estate = spouse_role_in_estate_array.length > 0 ? spouse_role_in_estate_array.join('|') : '';
            var spouse_phone = formSpouse.find("#spouse_phone").val();
            var spouse_birth_day = convert_date(formSpouse.find("#spouse_birth_day").val());
            var spouse_anniversary = convert_date(formSpouse.find("#spouse_anniversary").val());
            var spouse_special_notes = formSpouse.find("#spouse_special_notes").val();
            var spouse_join_account_access = formSpouse.find('input[name="spouse_join_account_access"]:checked').val();
            var validated = validateRequiredElementsSet(['spouse_first_name', 'spouse_last_name'], formSpouse);
            if (validated != true) {
                toastr.error(validated);
                return false;
            }
            $.ajax({
                type: "POST",
                //url: SITE_BASE_URL+"project/estates/forms/My-Family/maritalStatus/processor.php",
                url: SITE_BASE_URL + "estate/ajax_member_edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    action_on: 'Spouse',
                    member_id: spouse_member_id,
                    member_gender: spouse_gender,
                    member_first_name: spouse_first_name,
                    member_last_name: spouse_last_name,
                    member_email: spouse_email,
                    member_role_in_estate: spouse_role_in_estate,
                    member_phone: spouse_phone,
                    member_birth_day: spouse_birth_day,
                    member_anniversary: spouse_anniversary,
                    member_special_notes: spouse_special_notes,
                    member_join_account_access: spouse_join_account_access
                },
                success: function (data) {
                    setValuesSpouse(data, true, true);
                    // showMemberCards();
                }
            });
        });

    function getRolesArraySpouse() {
        var roles_set = [];
        $(formSpouse.find('#spouse_role_in_estate option:selected')).each(function () {
            roles_set.push($(this).val());
        });
        return roles_set;
    }

    function setRolesSpouse(rolesSet, update) {
        var spouse_roles_in_estate = rolesSet.split('|');
        $('#spouse_role_in_estate option').prop('selected', false);
        $.each(spouse_roles_in_estate, function (i, e) {
            $('#spouse_role_in_estate option').each(function (ii, ee) {
                if ($(this).val() == e) {
                    $(this).prop('selected', true);
                    return false;
                }
            });
        });
        $('#spouse_role_in_estate').material_select();
    }


    function getRelationshipSpouse() {
        var relationship = 0;
        $($('#maritalStatus-relationship').find('li.active')).each(function () {
            var active_li_text = $(this).text();
            $.each(relationship_array_values_obj, function (i, e) {
                if (e == active_li_text) {
                    relationship = i;
                }
            })
        });
        relationship = relationship > 0 ? relationship : 0;
        return relationship;
    }

    function setRelationshipSpouse(key) {
        key = key - 1;
        $('#spouse_relationship_in_estate').prevAll('.select-dropdown').children('li:eq(' + key + ')').addClass('active').trigger('click');
    }

    function setValuesSpouse(data, error_display, update) {
        var result_set = $.parseJSON(data);

        if (result_set.error != 1) {
            var result = result_set.result;
            $("#spouse_member_id").val(result.member_id);
            $(".spouse_gender" + result.member_gender).prop("checked", true);
            if (result.spouse_join_account_access == 1)
                $(".spouse_join_account_access").prop("checked", true);
            $("#spouse_first_name").val(result.member_first_name);
            $("#spouse_last_name").val(result.member_last_name);
            $("#spouse_email").val(result.member_email);
            if (result.member_role_in_estate.trim() != '')
                setRolesSpouse(result.member_role_in_estate, update);//
            $("#spouse_phone").val(result.member_phone);
            if (result.member_birth_day) {
                var spouse_birth_day = result.member_birth_day.split('-');
                if (parseInt(spouse_birth_day[1]) != 0)
                    $("#spouse_birth_day").val('' + spouse_birth_day[1] + '/' + spouse_birth_day[2] + '/' + spouse_birth_day[0]);
            }
            if (result.member_anniversary) {
                var spouse_anniversary = result.member_anniversary.split('-');//
                if (parseInt(spouse_anniversary[1]) != 0)
                    $("#spouse_anniversary").val('' + spouse_anniversary[1] + '/' + spouse_anniversary[2] + '/' + spouse_anniversary[0]);
            }
            $("#spouse_special_notes").val(result.member_special_notes);//
            if (result.member_image != '')
                $(".spouse_image_img").attr('src', SITE_BASE_URL + MEMBER_IMG_FOLDER + '/' + result.member_image + '?rand=' + Math.random());
            if (result.member_email != '') {
                $('.member_email').removeClass('validated_false');
                $('#btnChange-maritalStatusInvite').removeClass('disabled_invite');
                $('#maritalStatusInviteStatusContainer').show();
                $('#maritalStatus-inviteBtn').data('member-member-id', result.member_id);
            } else {
                $('#btnChange-maritalStatusInvite').addClass('disabled_invite');
                $('#maritalStatusInviteStatusContainer').hide();
            }
            if (result_set.result.member_associated_user == 0)
                $('#btnChange-maritalStatusInvite').show();

        }
        //initiate_spouse_elements();
        initiateMaterialSpouse($('#form-maritalStatus'));
        if (error_display != false) {
            if (result_set.error != 1) {
                if (formDidChange_maritalStatus) {
                    toastr.success(result_set.message);
                    formDidChange_maritalStatus = false;
                }
                toastr.success(result_set.message);
                // function adds if there is new upload
                add_image_also_spouse();
            } else {
                toastr.error(result_set.message);
            }
        }
    }

    function add_image_also_spouse() {
        if ($('#spouse_picture').prop('files').length > 0) {
            $('#spouse_picture').trigger('change');
        } else {
            showMemberCards();
        }
    }

    function readURLSpouse(input) {
        if (input.prop('files') && input.prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.spouse_image_img').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.prop('files')[0]);
        }
    }

    /*   function load_spouse() {
           $.ajax({
               type: "POST",
               url: SITE_BASE_URL+"project/estates/forms/My-Family/maritalStatus/processor.php",
               data: {
                   action: 'read'
               },
               success: function (data) {
                   setValuesSpouse(data, false, false)
               }
           });
       }*/

    $(document).on('change', '#spouse_picture', function () {
        var spouse_member_id = $("#spouse_member_id").val().trim();
        if (spouse_member_id == '') {
            readURLSpouse($(this));
            return false;
        }
        //on change event
        $('#loading').show();
        $('#spouse_image_img').hide();
        var formdata = new FormData();
        if ($(this).prop('files').length > 0) {
            var file = $(this).prop('files')[0];
            formdata.append("member_image", file);
            formdata.append("member_id", spouse_member_id);
            formdata.append("action_on", 'Spouse');
            $(this).replaceWith($(this).val('').clone(true));
            $.ajax({
                //url: SITE_BASE_URL+"project/estates/forms/My-Family/maritalStatus/image_processor.php",
                url: SITE_BASE_URL + "estate_image/ajax_member_image",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: formdata,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (data, textStatus, jqXHR) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        $('.spouse_image_img').attr('src', result_set.result);
                    }
                    if (result_set.error != 1)
                        toastr.success(result_set.message);
                    else
                        toastr.error(result_set.message);
                    $('#loading').hide();
                    $('#spouse_image_img').show();
                    //make_submit_button_disable($('#btnChange-maritalStatus'));
                    showMemberCards();

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error(errorThrown);
                    $('#loading').hide();
                    $('#spouse_image_img').show();
                    //make_submit_button_disable($('#btnChange-maritalStatus'));
                    showMemberCards();

                }
            });
        }
    });

    initiateMaterialSpouse($('#form-maritalStatus'));

    //$('.profile_image_img').attr('src', '<?=$profile_found_image?>');

    var form_profile_dependent;
    var form_medical_dependent;
    var form_school_dependent;
    var form_guardian_dependent;

    $(document).on('click', '.dependents_content_box', function (e) {
        e.preventDefault();
        $('#add_new_dependent_modal').html('');
        $("#addNewdependentID1").find('.modal-body').html('');
        $("#addNewdependentID1").data('bs.modal', null);
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/forms/My-Family/dependents/popup_modal/dependent_main.php",
            url: SITE_BASE_URL + "estate/ajax_dependent_popup",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                dependent_member_id: $(this).data('member-id')
            },
            success: function (data) {
                //  $('#addNewdependentID1').html(data);
                $('#add_new_dependent_modal').html(data);
                //$('#dependents-closeBtn').show();
                $("#addNewdependentID1").modal('show');
                initiateMaterialDependent($("#addNewdependentID1"));
            }
        });
    });

    $(document).on('click', '.dependent_main_tabs .nav-link', function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        $('.dependent_main_panels .tab-pane').removeClass('fade in show active');
        $('.dependent_main_panels ' + href).addClass('fade in show active');
    });

    function getRelationshipDependent() {
        var relationship = 0;
        $($('#profileDependent-relationship').find('li.active')).each(function () {
            var active_li_text = $(this).text();
            $.each(relationship_array_values_obj, function (i, e) {
                if (e.trim() == active_li_text.trim()) {
                    relationship = i;
                }
            })
        });
        relationship = relationship > 0 ? relationship : 0;
        return relationship;
    }

    function getRolesArrayDependent() {
        var roles_set = [];
        $(form_profile_dependent.find('#dependent_role_in_estate option:selected')).each(function () {
            roles_set.push($(this).val());
        });
        return roles_set;
    }

    $(document).on('click', "#btnChange-dependents , #btnChangeNext-dependents", function () {
        form_profile_dependent = $(this).closest('form');

        if (form_profile_dependent.find('#btnChange-dependents').hasClass('xdisabled')
            && $(this).attr('id') == 'btnChangeNext-dependents') {
            $('#panel_guardian_dependent_click').trigger('click');
            return false;
        } else if ($(this).attr('id') == 'btnChangeNext-dependents') {
            $('#panel_guardian_dependent_click').trigger('click');
        }

        var dependent_member_id = form_profile_dependent.find("#dependent_member_id").val();//
        var dependent_gender = form_profile_dependent.find('input[name="dependent_gender"]:checked').val();//
        var dependent_relationship_to_owner = form_profile_dependent.find('#dependent_relationship_to_owner').val(); //getRelationshipDependent();//
        var dependent_first_name = form_profile_dependent.find("#dependent_first_name").val();//
        var dependent_last_name = form_profile_dependent.find("#dependent_last_name").val();//
        var dependent_email = form_profile_dependent.find("#dependent_email").val();//
        var dependent_phone = form_profile_dependent.find("#dependent_phone").val();//
        var dependent_role_in_estate_ar = getRolesArrayDependent();//
        var dependent_role_in_estate = dependent_role_in_estate_ar.join('|');//
        var dependent_birth_day = convert_date(form_profile_dependent.find("#dependent_birth_day").val());//
        var dependent_address = form_profile_dependent.find("#dependent_address").val();//
        var dependent_address2 = form_profile_dependent.find("#dependent_address2").val();//
        var dependent_city = form_profile_dependent.find("#dependent_city").val();//
        var dependent_state = form_profile_dependent.find("#dependent_state").val();//
        var dependent_zip = form_profile_dependent.find("#dependent_zip").val();//
        var dependent_special_notes = form_profile_dependent.find("#dependent_special_notes").val();//
        var validated = validateRequiredElementsSet(['dependent_first_name', 'dependent_last_name', 'dependent_birth_day'], form_profile_dependent);
        var document_element = form_profile_dependent.find("#profileDependentDocs");
        if (validated != true) {
            toastr.error(validated);
            return false;
        }
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/forms/My-Family/dependents/processor.php",
            url: SITE_BASE_URL + "estate/ajax_member_edit",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                action_on: 'Dependent',
                member_id: dependent_member_id,
                member_gender: dependent_gender,
                member_relationship_to_owner: dependent_relationship_to_owner,
                member_first_name: dependent_first_name,
                member_last_name: dependent_last_name,
                member_email: dependent_email,
                member_phone: dependent_phone,
                member_role_in_estate: dependent_role_in_estate,
                member_birth_day: dependent_birth_day,
                member_address: dependent_address,
                member_address2: dependent_address2,
                member_city: dependent_city,
                member_state: dependent_state,
                member_zip: dependent_zip,
                member_special_notes: dependent_special_notes
            },
            success: function (data) {
                var result_set = $.parseJSON(data);
                if (result_set.error == 0) {
                    $("#addNewdependentID1 #dependent_member_id").val(result_set.result.member_id);
                    $("#addNewdependentID1 #guardian_dependent_id").val(result_set.result.member_id);
                    add_document_open(document_element, result_set.result.member_id);
                    $("#dependent-inviteBtn").data('member-member-id', result_set.result.member_id);
                    if (dependent_email != '') {
                        form_profile_dependent.find('.member_email').removeClass('validated_false');
                        form_profile_dependent.find('#btnChange-dependentInvite').removeClass('disabled_invite');
                        form_profile_dependent.find('#profile_InviteStatusContainer').show();
                    } else {
                        form_profile_dependent.find('#btnChange-dependentInvite').addClass('disabled_invite');
                        form_profile_dependent.find('#profile_InviteStatusContainer').hide();
                    }
                    if (result_set.result.member_associated_user == 0)
                        form_profile_dependent.find('#btnChange-dependentInvite').show();
                    toastr.success(result_set.message);
                    add_image_also_dependent();
                } else {
                    toastr.error(result_set.message);
                }


            }
        });

    });

    function readURLDependent(input) {
        if (input.prop('files') && input.prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#dependent_img__img').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.prop('files')[0]);
        }
    }

    $(document).on('change', '#dependent_picture', function () {
        var dependent_member_id = $(this).closest('form').find("#dependent_member_id").val().trim();
        if (dependent_member_id == '') {
            readURLDependent($(this));
            return false;
        }
        //on change event
        $('#loading').show();
        var formdata = new FormData();
        if ($(this).prop('files').length > 0) {
            var file = $(this).prop('files')[0];
            formdata.append("member_image", file);
            //formdata.append("dependent_picture_type", 'profile');
            formdata.append("member_id", dependent_member_id);
            formdata.append("action_on", 'Dependent');

            $(this).replaceWith($(this).val('').clone(true));

            $.ajax({
                //url: SITE_BASE_URL + "project/estates/forms/My-Family/dependents/image_processor.php",
                url: SITE_BASE_URL + "estate_image/ajax_member_image",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: formdata,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (data, textStatus, jqXHR) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        $('#dependent_img__img').attr('src', result_set.result);
                        toastr.success(result_set.message);
                        // if (!(($("#addNewMemberID1").data('bs.modal') || {})._isShown)
                        //    && !(($("#addNewdependentID1").data('bs.modal') || {})._isShown)) {
                        showMemberCards();
                        //  }

                    } else {
                        toastr.error(result_set.message);
                    }
                    $('#loading').hide();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    $('#loading').hide();
                    $('#dependent_img__img').show();
                    /*if (!(($("#addNewMemberID1").data('bs.modal') || {})._isShown)
                        && !(($("#addNewdependentID1").data('bs.modal') || {})._isShown)) {
                        showMemberCards();
                    }*/
                    showMemberCards();
                    // STOP LOADING SPINNER
                }
            });
        } else {
            //finalizeDependentAddEdit();
        }
    });

    $(document).on('change', '#dependent_medical_picture', function () {
        var dependent_member_id = $(this).closest('form').find("#dependent_member_id").val().trim();
        if (dependent_member_id == '') {
            readURLDependent($(this));
            return false;
        }
        //on change event
        $('#loading').show();
        var formdata = new FormData();
        if ($(this).prop('files').length > 0) {
            var file = $(this).prop('files')[0];
            formdata.append("dependent_medical_image", file);
            formdata.append("dependent_member_id", dependent_member_id);
            formdata.append("action_on", "DependentMedical");

            $(this).replaceWith($(this).val('').clone(true));

            $.ajax({
                //url: SITE_BASE_URL + "project/estates/forms/My-Family/dependents/image_processor.php",
                url: SITE_BASE_URL + "estate_image/ajax_dependent_medical_image",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: formdata,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (data, textStatus, jqXHR) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        $('#dependent_medical_img__img').attr('src', result_set.result);
                        toastr.success(result_set.message);

                    } else {
                        toastr.error(result_set.message);
                    }
                    $('#loading').hide();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    // toastr.error(errorThrown);
                    $('#loading').hide();
                    $('#dependent_medical_img__img').show();
                    // STOP LOADING SPINNER
                }
            });
        } else {
            //finalizeDependentAddEdit();
        }
    });

    /*$(document).on('change', '#dependent_guardian_picture', function () {
        var guardian_member_new_member_id = $(this).closest('form').find("#guardian_member_new_member_id").val().trim();
        if (guardian_member_new_member_id == '') {
            readURLDependent($(this));
            return false;
        }
        //on change event
        $('#loading').show();
        var formdata = new FormData();
        if ($(this).prop('files').length > 0) {
            var file = $(this).prop('files')[0];
            formdata.append("member_image", file);
            formdata.append("member_id", guardian_member_new_member_id);
            $(this).replaceWith($(this).val('').clone(true));

            $.ajax({
                //url: SITE_BASE_URL + "project/estates/forms/My-Family/dependents/image_processor.php",
                url: SITE_BASE_URL + "estate_image/ajax_member_image",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: formdata,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (data, textStatus, jqXHR) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        $('#dependent_guardian_img__img').attr('src', result_set.result);
                        toastr.success(result_set.message);

                    } else {
                        toastr.error(result_set.message);
                    }
                    $('#loading').hide();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    // toastr.error(errorThrown);
                    $('#loading').hide();
                    $('#dependent_guardian_img__img').show();
                    // STOP LOADING SPINNER
                }
            });
        } else {
            //finalizeDependentAddEdit();
        }
    });*/

    $(document).on('change', '#dependent_school_picture', function () {
        var dependent_member_id = $(this).closest('form').find("#dependent_member_id").val().trim();
        if (dependent_member_id == '') {
            readURLDependent($(this));
            return false;
        }
        //on change event
        $('#loading').show();
        var formdata = new FormData();
        if ($(this).prop('files').length > 0) {
            var file = $(this).prop('files')[0];
            formdata.append("dependent_school_image", file);
            formdata.append("dependent_member_id", dependent_member_id);
            formdata.append("action_on", "DependentSchool");

            $(this).replaceWith($(this).val('').clone(true));

            $.ajax({
                // url: SITE_BASE_URL + "project/estates/forms/My-Family/dependents/image_processor.php",
                url: SITE_BASE_URL + "estate_image/ajax_dependent_school_image",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: formdata,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (data, textStatus, jqXHR) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        $('#dependent_school_img__img').attr('src', result_set.result);
                        toastr.success(result_set.message);

                    } else {
                        toastr.error(result_set.message);
                    }
                    $('#loading').hide();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    // toastr.error(errorThrown);
                    $('#loading').hide();
                    $('#dependent_school_img__img').show();
                    // STOP LOADING SPINNER
                }
            });
        } else {
            //finalizeDependentAddEdit();
        }
    });


    $(document).on('click', '.dependents-closeBtn', function (e) {
        e.preventDefault();
        $("#addNewdependentID1").modal('hide');
        //showMemberCards();
    });

    /*function updateCardsDependentEnd() {

    }
*/

// guardian member
    $(document).on('click', "#btnChange-ADDGuardianmemberNew , #ADDGuardianNext-dependents", function (e) {
        e.preventDefault();
        form_guardian_dependent = $(this).closest('form');

        if (form_guardian_dependent.find('#btnChange-ADDGuardianmemberNew').hasClass('xdisabled')
            && $(this).attr('id') == 'ADDGuardianNext-dependents') {
            $('#panel_medical_dependent_click').trigger('click');
            return false;
        } else if ($(this).attr('id') == 'ADDGuardianNext-dependents') {
            $('#panel_medical_dependent_click').trigger('click');
        }
        //$("#btnChange-dependents").removeClass('xdisabled');
        //$("#btnChange-ADDGuardianmemberNew").removeClass('xdisabled');
        //$("#btnChange-dependents-medical").removeClass('xdisabled');

        var guardian_dependent_id = form_guardian_dependent.find("#guardian_dependent_id").val();
        //var member_guardian_dependents_array = form_guardian_dependent.find("#member_guardian_dependents").val();
        //var member_guardian_dependents = member_guardian_dependents_array.join(',');
        var member_member_id = form_guardian_dependent.find("#guardian_member_new_member_id").val();
        var member_gender = form_guardian_dependent.find('input[name="guardian_member_gender"]:checked').val();
        //var member_relationship = getRelationshipMemberGuardian();
        var member_relationship_in_estate = form_guardian_dependent.find("#guardian_member_relationship_in_estate").val();
        var member_role_in_estate_array = getRolesArrayMemberGuardian();
        var member_role_in_estate = member_role_in_estate_array.join('|');
        var member_first_name = form_guardian_dependent.find("#guardian_member_first_name").val();
        var member_last_name = form_guardian_dependent.find("#guardian_member_last_name").val();
        var member_email = form_guardian_dependent.find("#guardian_member_email").val();
        var member_phone = form_guardian_dependent.find("#guardian_member_phone").val();

        var member_address = form_guardian_dependent.find("#guardian_member_address").val();
        var member_address2 = form_guardian_dependent.find("#guardian_member_address2").val();

        var member_city = form_guardian_dependent.find("#guardian_member_city").val();
        var member_state = form_guardian_dependent.find("#guardian_member_state").val();

        var member_zip = form_guardian_dependent.find("#guardian_member_zip").val();

        var member_birth_day = convert_date(form_guardian_dependent.find("#guardian_member_birth_day").val());
        var member_notes = form_guardian_dependent.find("#guardian_member_notes").val();
        var document_element = form_guardian_dependent.find("#guardian_memberNewDocs");
        if (guardian_dependent_id != 0 && guardian_dependent_id != '') {
            var validated = validateRequiredElementsSet(['guardian_member_first_name', 'guardian_member_last_name'], form_guardian_dependent);
            if (validated != true) {
                toastr.error(validated);
                return false;
            }
            $.ajax({
                type: "POST",
                //url: SITE_BASE_URL + "project/estates/forms/memberForms/processor.php",
                url: SITE_BASE_URL + "estate/ajax_member_edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    action_on: 'GuardianMember',
                    member_id: member_member_id,
                    member_gender: member_gender,
                    member_relationship_to_owner: member_relationship_in_estate,
                    member_role_in_estate: member_role_in_estate,
                    member_first_name: member_first_name,
                    member_last_name: member_last_name,
                    member_email: member_email,
                    member_phone: member_phone,
                    member_address: member_address,
                    member_address2: member_address2,
                    member_city: member_city,
                    member_state: member_state,
                    member_zip: member_zip,
                    member_birth_day: member_birth_day,
                    member_special_notes: member_notes,
                    // guardian_dependent_id: guardian_dependent_id//,
                    //member_guardian_dependents: member_guardian_dependents
                    dependent_id: guardian_dependent_id
                },
                success: function (data) {
                    // setValuesmember(data,true,true)
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        form_guardian_dependent.find("#guardian_member_new_member_id").val(result_set.result.member_id);
                        add_document_open(document_element, result_set.result.member_id);
                        if (member_email != '') {
                            form_guardian_dependent.find('.member_email').removeClass('validated_false');
                            $('#btnChange-dependentGuardianInvite').removeClass('disabled_invite');
                            $('#guardian_dependent_InviteStatusContainer').show();
                        } else {
                            $('#btnChange-dependentGuardianInvite').addClass('disabled_invite');
                            $('#guardian_dependent_InviteStatusContainer').hide();
                        }
                        if (result_set.result.member_associated_user == 0)
                            $('#btnChange-dependentGuardianInvite').show();
                        toastr.success(result_set.message);
                        add_image_also_member_guardian();
                    } else {
                        toastr.error(result_set.message);
                    }
                }
            });
        } else {
            toastr.error("You should create Dependent Profile first");
        }
    });


    var search_val = '';
    var guardian_member_first_name_request;
    $(document).on('keyup', "#guardian_member_first_name", function () {
        search_val = $(this).val().trim();
        var guardian_dependent_id = $('#guardian_dependent_id').val();
        if (search_val == '') {
            $("#guardian_suggesstion-box").html('');
        } else {
            if (guardian_member_first_name_request) {
                guardian_member_first_name_request.abort();
            }
            guardian_member_first_name_request = $.ajax({
                type: "POST",
                // url: SITE_BASE_URL + "project/estates/forms/memberForms/processor.php",
                url: SITE_BASE_URL + "estate/ajax_member_guardian_suggest",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    //action: 'auto_search_guardian_dependent',
                    member_first_name: search_val,
                    current_member_id: guardian_dependent_id
                },
                beforeSend: function () {
                    // $("search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function (data) {
                    $("#guardian_suggesstion-box").show();
                    if (search_val != '') {
                        $("#guardian_suggesstion-box").html(data.trim());
                    }
                    // $("#search-documents-input").css("background","#FFF");
                }
            });
        }
    });

    $(document).on('click', '.guardian_prediction_close', function () {
        $("#guardian_suggesstion-box").html('');
    });


    $(document).on('click', '.guardian_prediction_add', function () {
        var member_id = $(this).data('member-id');
        if (member_id) {
            $.ajax({
                type: "POST",
                //url: SITE_BASE_URL + "project/estates/forms/My-Family/dependents/processor.php",
                url: SITE_BASE_URL + "estate/ajax_get_member",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    member_id: member_id
                },
                beforeSend: function () {
                },
                success: function (data) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        setMemberGuardianResult(result_set.result);
                        toastr.success("Guardian Data Loaded. Please save to store");
                    } else {
                        toastr.error(result_set.message);
                    }
                    $("#guardian_suggesstion-box").html('');
                }
            });
        }
    });

    function setMemberGuardianResult(result) {
//        var member_guardian_dependents_array = form_guardian_dependent.find("#member_guardian_dependents").val();
        //     var member_guardian_dependents = member_guardian_dependents_array.join(',');
        $("#guardian_member_new_member_id").val(result.member_id);
        $('#guardian_member_gender' + result.member_gender).prop("checked", true);

        setRelationshipMemberGuardian(result.member_relationship_to_owner);
        setRolesMemberGuardian(result.member_role_in_estate);


        $("#guardian_member_first_name").val(result.member_first_name);
        $("#guardian_member_last_name").val(result.member_last_name);
        $("#guardian_member_email").val(result.member_email);
        $("#guardian_member_phone").val(result.member_phone);
        $("#guardian_member_address").val(result.member_address);
        $("#guardian_member_address2").val(result.member_address2);
        $("#guardian_member_city").val(result.member_city);
        $("#guardian_member_state").val(result.member_state);
        $("#guardian_member_zip").val(result.member_zip);
        $("#guardian_member_notes").val(result.member_special_notes);
        $("#guardian_member_relationship_in_estate").val(result.member_relationship_to_owner);
        $('#member_guardian_dependents').html(result.guardian_member_select_options);

        if (result.member_birth_day) {
            var date_split = result.member_birth_day.split('-');
            if (parseInt(date_split[0]) > 0)
                $("#guardian_member_birth_day").val('' + date_split[1] + '/' + date_split[2] + '/' + date_split[0]);
        }
        var src = DEFAULT_AVATAR_IMAGE_URL;
        if (result.member_image && result.member_is_dependent == 1) {
            src = DEPENDENT_PROFILE_IMG_URL + '/' + result.member_image;
        } else if (result.member_image) {
            src = SITE_BASE_URL + MEMBER_IMG_FOLDER + '/' + result.member_image;
        }

        $('#guardian_member_img__img').attr('src', src + "?rand=" + Math.random());
    }

    function setRolesMemberGuardian(rolesSet) {
        var MemberGuardian_roles_in_estate = rolesSet.split('|');
        MemberGuardian_roles_in_estate.push(400);
        $('#guardian_member_role_in_estate option').prop('selected', false);
        $.each(MemberGuardian_roles_in_estate, function (i, e) {
            $('#guardian_member_role_in_estate option').each(function (ii, ee) {
                if ($(this).val() == e) {
                    $(this).prop('selected', true);
                    return false;
                }
            });
        });
        $('#guardian_member_role_in_estate').material_select();
    }


    function setRelationshipMemberGuardian(key) {
        key = key - 1;
        $('#guardian_member_relationship_in_estate').prevAll('.select-dropdown').children('li:eq(' + key + ')').addClass('active').trigger('click');
    }

    function getRolesArrayMemberGuardian() {

        var roles_set = [];
        $(form_guardian_dependent.find('#guardian_member_role_in_estate option:selected')).each(function () {
            roles_set.push($(this).val());
        });
        if (roles_set.indexOf(400) == -1) {
            roles_set.push(400);
        }
        return roles_set;
    }


    function getRelationshipMemberGuardian() {
        var relationship = 0;
        $(form_guardian_dependent.find('#guardian_memberNew-relationship').find('li.active')).each(function () {
            var active_li_text = $(this).text();
            $.each(relationship_array_values_obj, function (i, e) {
                if (e == active_li_text) {
                    relationship = i;
                }
            });
        });
        relationship = relationship > 0 ? relationship : 0;
        return relationship;
    }


    function add_image_also_member_guardian() {
        if (form_guardian_dependent.find('#guardian_member_picture').prop('files').length > 0) {
            form_guardian_dependent.find('#guardian_member_picture').trigger('change');
        } else {
            showMemberCards();
        }
    }

    function readURLMemberGuardian(input) {
        if (input.prop('files') && input.prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.guardian_member_img__img').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.prop('files')[0]);
        }
    }

    $(document).on('change', '#guardian_member_picture', function () {
        var member_member_id = $("#guardian_member_new_member_id").val();
        if (member_member_id.trim() == '' || !(parseInt(member_member_id) > 0)) {
            readURLMemberGuardian($(this));
            return false;
        }
        //on change event
        $('#loading').show();
        //$('#member_img__img').hide();
        var formdata = new FormData();
        if ($(this).prop('files').length > 0) {
            var file = $(this).prop('files')[0];
            formdata.append("member_image", file);
            formdata.append("member_id", member_member_id);
            formdata.append("action_on", 'GuardianMember');
            $.ajax({
                //url: SITE_BASE_URL + "project/estates/forms/memberForms/image_processor.php",
                url: SITE_BASE_URL + "estate_image/ajax_member_image",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: formdata,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (data, textStatus, jqXHR) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        $('#guardian_member_img__img').attr('src', result_set.result);
                        toastr.success(result_set.message);
                        showMemberCards();
                    } else {
                        toastr.error(result_set.message);
                    }

                    $('#loading').hide();

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    //$('#spouse_error_message').html("Image Upload Error. Please Retry !");
                    toastr.error(errorThrown);
                    $('#loading').hide();
                    $('#guardian_member_img__img').show();
                    showMemberCards();
                    // STOP LOADING SPINNER
                }

            });
        }


    });


    ////////////////////////////////////////////////////////


    $(document).on('click', "#btnChange-dependents-medical , #btnNext-dependents-medical", function () {
        form_medical_dependent = $(this).closest('form');

        if (form_medical_dependent.find('#btnChange-dependents-medical').hasClass('xdisabled')
            && $(this).attr('id') == 'btnNext-dependents-medical') {
            $('#panel_school_dependent_click').trigger('click');
            return false;
        } else if ($(this).attr('id') == 'btnNext-dependents-medical') {
            $('#panel_school_dependent_click').trigger('click');
        }
        //$("#btnChange-dependents").removeClass('xdisabled');
        //$("#btnChange-ADDGuardianmemberNew").removeClass('xdisabled');
        //$("#btnChange-dependents-medical").removeClass('xdisabled');

        var dependent_member_id = form_medical_dependent.find("#dependent_member_id").val();//
        var dependent_medical_primary_care = form_medical_dependent.find("#dependent_medical_primary_care").val();
        var dependent_medical_name = form_medical_dependent.find("#dependent_medical_name").val();
        var dependent_medical_email = form_medical_dependent.find("#dependent_medical_email").val();
        var dependent_medical_phone = form_medical_dependent.find("#dependent_medical_phone").val();
        var dependent_medical_web = form_medical_dependent.find("#dependent_medical_web").val();
        var dependent_medical_address = form_medical_dependent.find("#dependent_medical_address").val();
        var dependent_medical_address2 = form_medical_dependent.find("#dependent_medical_address2").val();
        var dependent_medical_city = form_medical_dependent.find("#dependent_medical_city").val();
        var dependent_medical_state = form_medical_dependent.find("#dependent_medical_state").val();
        var dependent_medical_zip = form_medical_dependent.find("#dependent_medical_zip").val();
        var dependent_medical_special_notes = form_medical_dependent.find("#dependent_medical_special_notes").val();
        if (dependent_member_id.trim() != '' || parseInt(dependent_member_id) > 0) {
            var validated = validateRequiredElementsSet(['dependent_medical_name'], form_medical_dependent);
            if (validated != true) {
                toastr.error(validated);
                return false;
            }
            $.ajax({
                type: "POST",
                // url: SITE_BASE_URL + "project/estates/forms/My-Family/dependents/processor.php",
                url: SITE_BASE_URL + "estate/ajax_edit_dependent_medical",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    action_on: 'DependentMedical',
                    dependent_medical_member_id: dependent_member_id,
                    dependent_medical_primary_care: dependent_medical_primary_care,
                    dependent_medical_name: dependent_medical_name,
                    dependent_medical_email: dependent_medical_email,
                    dependent_medical_phone: dependent_medical_phone,
                    dependent_medical_web: dependent_medical_web,
                    dependent_medical_address: dependent_medical_address,
                    dependent_medical_address2: dependent_medical_address2,
                    dependent_medical_city: dependent_medical_city,
                    dependent_medical_state: dependent_medical_state,
                    dependent_medical_zip: dependent_medical_zip,
                    dependent_medical_special_notes: dependent_medical_special_notes
                },
                success: function (data) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        toastr.success(result_set.message);
                        // add_image_also_dependent();
                    } else {
                        toastr.error(result_set.message);
                    }


                }
            });
        } else {
            toastr.error("Please Save Dependent Profile First !");
        }
    });


    function getSchoolGradeDependent() {
        var relationship = 0;
        $($('#schoolGrade').find('li.active')).each(function () {
            relationship = $(this).text();
        });
        return relationship;
    }

    $(document).on('click', "#btnChange-dependents-school", function () {
        form_school_dependent = $(this).closest('form');
        var dependent_member_id = form_school_dependent.find("#dependent_member_id").val();

        var dependent_school_name = form_school_dependent.find("#dependent_school_name").val();
        var dependent_school_grade = getSchoolGradeDependent();
        var dependent_school_email = form_school_dependent.find("#dependent_school_email").val();
        var dependent_school_phone = form_school_dependent.find("#dependent_school_phone").val();
        var dependent_school_counselor = form_school_dependent.find("#dependent_school_counselor").val();
        var dependent_school_address = form_school_dependent.find("#dependent_school_address").val();
        var dependent_school_address2 = form_school_dependent.find("#dependent_school_address2").val();
        var dependent_school_city = form_school_dependent.find("#dependent_school_city").val();
        var dependent_school_state = form_school_dependent.find("#dependent_school_state").val();
        var dependent_school_zip = form_school_dependent.find("#dependent_school_zip").val();
        var dependent_school_special_notes = form_school_dependent.find("#dependent_school_special_notes").val();

        if (dependent_member_id.trim() != '' || parseInt(dependent_member_id) > 0) {
            var validated = validateRequiredElementsSet(['dependent_school_name'], form_school_dependent);
            if (validated != true) {
                toastr.error(validated);
                return false;
            }
            $.ajax({
                type: "POST",
                //url: SITE_BASE_URL + "project/estates/forms/My-Family/dependents/processor.php",
                url: SITE_BASE_URL + "estate/ajax_edit_dependent_school",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    action_on: 'DependentSchool',
                    dependent_school_member_id: dependent_member_id,
                    dependent_school_name: dependent_school_name,
                    dependent_school_grade: dependent_school_grade,
                    dependent_school_email: dependent_school_email,
                    dependent_school_phone: dependent_school_phone,
                    dependent_school_counselor: dependent_school_counselor,
                    dependent_school_address: dependent_school_address,
                    dependent_school_address2: dependent_school_address2,
                    dependent_school_city: dependent_school_city,
                    dependent_school_state: dependent_school_state,
                    dependent_school_zip: dependent_school_zip,
                    dependent_school_special_notes: dependent_school_special_notes
                },
                success: function (data) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        //$("#dependent_member_id").val(result_set.result.dependent_member_id);
                        toastr.success(result_set.message);
                        // add_image_also_dependent();
                    } else {
                        toastr.error(result_set.message);
                    }


                }
            });
        } else {
            toastr.error("Please Save Dependent Profile First !");
        }
    });

    function getRolesArrayDependentGuardian() {
        var roles_set = [];
        $(form_guardian_dependent.find('#dependent_guardian_role_in_estate option:selected')).each(function () {
            roles_set.push($(this).val());
        });
        return roles_set;
    }


    $(document).on('click', '.dependents_content_box_delete', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var yes_delete = confirm("Want to delete?");
        if (yes_delete) {
            $.ajax({
                type: "POST",
                url: SITE_BASE_URL + "project/estates/forms/My-Family/dependents/processor.php",
                data: {
                    action: 'delete',
                    dependent_member_id: $(this).data('member-id')
                },
                success: function (data) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        showMemberCards();
                        toastr.success(result_set.message);
                    } else {
                        toastr.error(result_set.message);
                    }
                }
            });
        }
    });


    function add_image_also_dependent() {
        if ($('#dependent_picture').prop('files').length > 0) {
            $('#dependent_picture').trigger('change');
        } else {
            showMemberCards();
        }
    }


    var formBeneficiary = null;
    var btnChanges_beneficiaries = "#btnChange-beneficiaries";
    $(document).on('click', btnChanges_beneficiaries, function () {
        formBeneficiary = $(this).closest('form');
        var beneficiary_member_id = formBeneficiary.find("#beneficiary_member_id").val();
        var beneficiary_gender = formBeneficiary.find('input[name="beneficiary_gender"]:checked').val();
        var beneficiary_first_name = formBeneficiary.find("#beneficiary_first_name").val();
        var beneficiary_last_name = formBeneficiary.find("#beneficiary_last_name").val();
        var beneficiary_email = formBeneficiary.find("#beneficiary_email").val();
        var beneficiary_phone = formBeneficiary.find("#beneficiary_phone").val();
        var beneficiary_bday = convert_date(formBeneficiary.find("#beneficiary_bday").val());
        var beneficiary_anniversary = convert_date(formBeneficiary.find("#beneficiary_anniversary").val());
        var beneficiary_special_notes = formBeneficiary.find("#beneficiary_special_notes").val();
        //var beneficiary_gifts = formBeneficiary.find("#beneficiary_gifts").val();
        var validated = validateRequiredElementsSet(['beneficiary_first_name', 'beneficiary_last_name'], formBeneficiary);
        if (validated != true) {
            toastr.error(validated);
            return false;
        }
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL+"project/estates/forms/My-Family/beneficiaries/processor.php",
            url: SITE_BASE_URL + "estate/ajax_member_edit",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                action_on: 'Beneficiary',
                member_id: beneficiary_member_id,
                member_gender: beneficiary_gender,
                member_first_name: beneficiary_first_name,
                member_last_name: beneficiary_last_name,
                member_email: beneficiary_email,
                member_phone: beneficiary_phone,
                member_birth_day: beneficiary_bday,
                member_anniversary: beneficiary_anniversary,
                member_special_notes: beneficiary_special_notes
            },
            success: function (data) {
                setValuesBeneficiary(data, true, true);
            }
        });
    });


    function setValuesBeneficiary(data, error_display, update) {
        var result_set = $.parseJSON(data);

        if (result_set.error != 1) {
            var result = result_set.result;
            $("#beneficiary_member_id").val(result.member_id);
            $(".beneficiary_gender" + result.member_gender).prop("checked", true);
            $("#beneficiary_first_name").val(result.member_first_name);
            $("#beneficiary_last_name").val(result.member_last_name);
            $("#beneficiary_email").val(result.member_email);
            $("#beneficiary_phone").val(result.member_phone);
            if (result.member_birth_day) {
                var beneficiary_birth_day = result.member_birth_day.split('-');
                if (parseInt(beneficiary_birth_day[1]) != 0)
                    $("#beneficiary_bday").val('' + beneficiary_birth_day[1] + '/' + beneficiary_birth_day[2] + '/' + beneficiary_birth_day[0]);
            }
            if (result.member_anniversary) {
                var beneficiary_anniversary = result.member_anniversary.split('-');//
                if (parseInt(beneficiary_anniversary[1]) != 0)
                    $("#beneficiary_anniversary").val('' + beneficiary_anniversary[1] + '/' + beneficiary_anniversary[2] + '/' + beneficiary_anniversary[0]);
            }
            $("#beneficiary_special_notes").val(result.member_special_notes);//
            if (result.member_image.trim() != '')
                $(".beneficiary_image_img").attr('src', SITE_BASE_URL + MEMBER_IMG_FOLDER + '/' + result.member_image + '?rand=' + Math.random());
            if (result.member_email != '') {
                $('.member_email').removeClass('validated_false');
                $('#btnChangeBeneficiaryNewInvite').removeClass('disabled_invite');
                $('#beneficiaryNewInviteStatusContainer').show();
            } else {
                $('#btnChangeBeneficiaryNewInvite').addClass('disabled_invite');
                $('#beneficiaryNewInviteStatusContainer').hide();
            }
            if (result_set.result.member_associated_user == 0)
                $('#btnChangeBeneficiaryNewInvite').show();
        }
        //initiate_beneficiary_elements();
        initiateMaterialBeneficiary($('#form-beneficiaries'));
        if (error_display != false) {
            if (result_set.error != 1) {
                // if(formDidChange_maritalStatus) {
                toastr.success(result_set.message);
                // formDidChange_maritalStatus = false;
                // }
                // toastr.success(result_set.message);
                // function adds if there is new upload
                add_image_also_beneficiary();
            } else {
                toastr.error(result_set.message);
            }
        }
    }

    function add_image_also_beneficiary() {
        if ($('#beneficiary_picture').prop('files').length > 0) {
            $('#beneficiary_picture').trigger('change');
        } else {
            showMemberCards();
        }
    }

    function readURLBeneficiary(input) {
        if (input.prop('files') && input.prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.beneficiary_image_img').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.prop('files')[0]);
        }
    }


    $(document).on('change', '#beneficiary_picture', function () {
        var beneficiary_member_id = $("#beneficiary_member_id").val().trim();
        if (beneficiary_member_id == '') {
            readURLBeneficiary($(this));
            return false;
        }
        //on change event
        $('#loading').show();
        $('#beneficiary_image_img').hide();
        var formdata = new FormData();
        if ($(this).prop('files').length > 0) {
            var file = $(this).prop('files')[0];
            formdata.append("member_picture", file);
            formdata.append("member_id", beneficiary_member_id);
            formdata.append("action_on", 'Beneficiary');
            $(this).replaceWith($(this).val('').clone(true));

            $.ajax({
                //url: SITE_BASE_URL+"project/estates/forms/My-Family/beneficiaries/image_processor.php",
                url: SITE_BASE_URL + "estate_image/ajax_member_image",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: formdata,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (data, textStatus, jqXHR) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        $('.beneficiary_image_img').attr('src', result_set.result);
                    }
                    if (result_set.error != 1)
                        toastr.success(result_set.message);
                    else
                        toastr.error(result_set.message);
                    $('#loading').hide();
                    $('#beneficiary_image_img').show();
                    //make_submit_button_disable($('#btnChange-beneficiaries'));
                    showMemberCards();

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error(errorThrown);
                    $('#loading').hide();
                    $('#beneficiary_image_img').show();
                    //make_submit_button_disable($('#btnChange-beneficiaries'));
                    showMemberCards();

                }
            });
        }
    });

    initiateMaterialBeneficiary($('#form-beneficiaries'));


    var formEmergency_contact = null;
    var btnChanges_emergency_contact = "#btnChange-emergency_contacts";
    $(document).on('click', btnChanges_emergency_contact, function () {
        formEmergency_contact = $(this).closest('form');
        var emergency_contact_member_id = formEmergency_contact.find("#emergency_contact_member_id").val();
        var emergency_contact_gender = formEmergency_contact.find('input[name="emergency_contact_gender"]:checked').val();
        var emergency_contact_first_name = formEmergency_contact.find("#emergency_contact_first_name").val();
        var emergency_contact_last_name = formEmergency_contact.find("#emergency_contact_last_name").val();
        var emergency_contact_email = formEmergency_contact.find("#emergency_contact_email").val();
        var emergency_contact_phone = formEmergency_contact.find("#emergency_contact_phone").val();
        var emergency_contact_special_notes = formEmergency_contact.find("#emergency_contact_special_notes").val();
        var validated = validateRequiredElementsSet(['emergency_contact_first_name', 'emergency_contact_last_name'], formEmergency_contact);
        if (validated != true) {
            toastr.error(validated);
            return false;
        }
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL+"project/estates/forms/About-Me/emergency_contact/processor.php",
            url: SITE_BASE_URL + "estate/ajax_member_edit",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                action_on: 'EmergencyContact',
                member_id: emergency_contact_member_id,
                member_gender: emergency_contact_gender,
                member_first_name: emergency_contact_first_name,
                member_last_name: emergency_contact_last_name,
                member_email: emergency_contact_email,
                member_phone: emergency_contact_phone,
                member_special_notes: emergency_contact_special_notes
            },
            success: function (data) {
                setValuesEmergency_contact(data, true, true);
            }
        });
    });


    function setValuesEmergency_contact(data, error_display, update) {
        var result_set = $.parseJSON(data);

        if (result_set.error != 1) {
            var result = result_set.result;
            $("#emergency_contact_member_id").val(result.member_id);
            $(".emergency_contact_gender" + result.member_gender).prop("checked", true);
            $("#emergency_contact_first_name").val(result.member_first_name);
            $("#emergency_contact_last_name").val(result.member_last_name);
            $("#emergency_contact_email").val(result.member_email);
            $("#emergency_contact_phone").val(result.member_phone);
            $("#emergency_contact_special_notes").val(result.member_special_notes);//
            if (result.member_image.trim() != '')
                $(".emergency_contact_image_img").attr('src', SITE_BASE_URL + MEMBER_IMG_FOLDER + '/' + result.member_image + '?rand=' + Math.random());

            if (result.member_email != '') {
                $('.member_email').removeClass('validated_false');
                $('#btnChangeemergency_contactInvite').removeClass('disabled_invite');
                $('#emergency_contactNewInviteStatus').show();
            } else {
                $('#btnChangeemergency_contactInvite').addClass('disabled_invite');
                $('#emergency_contactNewInviteStatus').hide();
            }
            if (result_set.result.member_associated_user == 0)
                $('#btnChangeemergency_contactInvite').show();
        }
        //initiate_emergency_contact_elements();
        initiateMaterialEmergency_contact($('#form-emergency_contacts'));
        if (error_display != false) {
            if (result_set.error != 1) {
                // if(formDidChange_maritalStatus) {
                toastr.success(result_set.message);
                // formDidChange_maritalStatus = false;
                // }
                // toastr.success(result_set.message);
                // function adds if there is new upload
                add_image_also_emergency_contact();
            } else {
                toastr.error(result_set.message);
            }
        }
    }

    function add_image_also_emergency_contact() {
        if ($('#emergency_contact_picture').prop('files').length > 0) {
            $('#emergency_contact_picture').trigger('change');
        } else {
            showMemberCards();
        }
    }

    function readURLEmergency_contact(input) {
        if (input.prop('files') && input.prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.emergency_contact_image_img').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.prop('files')[0]);
        }
    }


    $(document).on('change', '#emergency_contact_picture', function () {
        var emergency_contact_member_id = $("#emergency_contact_member_id").val().trim();
        if (emergency_contact_member_id == '') {
            readURLEmergency_contact($(this));
            return false;
        }
        //on change event
        $('#loading').show();
        $('#emergency_contact_image_img').hide();
        var formdata = new FormData();
        if ($(this).prop('files').length > 0) {
            var file = $(this).prop('files')[0];
            formdata.append("member_image", file);
            formdata.append("member_id", emergency_contact_member_id);
            formdata.append("action_on", 'EmergencyContact');
            $(this).replaceWith($(this).val('').clone(true));

            $.ajax({
                //url: SITE_BASE_URL+"project/estates/forms/About-Me/emergency_contact/image_processor.php",
                url: SITE_BASE_URL + "estate_image/ajax_member_image",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: formdata,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (data, textStatus, jqXHR) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        $('.emergency_contact_image_img').attr('src', result_set.result);
                    }
                    if (result_set.error != 1)
                        toastr.success(result_set.message);
                    else
                        toastr.error(result_set.message);
                    $('#loading').hide();
                    $('#emergency_contact_image_img').show();
                    //make_submit_button_disable($('#btnChange-emergency_contacts'));
                    showMemberCards();

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error(errorThrown);
                    $('#loading').hide();
                    $('#emergency_contact_image_img').show();
                    //make_submit_button_disable($('#btnChange-emergency_contacts'));
                    showMemberCards();

                }
            });
        }
    });

    initiateMaterialEmergency_contact($('#form-emergency_contacts'));


    var formPet = null;
    var btnChanges_pet = "#btnChange-pet";
    $(document).on('click', btnChanges_pet, function () {
        formPet = $(this).closest('form');
        var pet_id = formPet.find("#pet_id").val();
        var pet_gender = formPet.find('input[name="pet_gender"]:checked').val();
        var pet_name = formPet.find("#pet_name").val();
        var pet_clinic_name = formPet.find("#pet_clinic_name").val();

        var pet_description = formPet.find("#pet_description").val();
        var pet_tag_id = formPet.find("#pet_tag_id").val();
        var pet_veterinarian_phone = formPet.find("#pet_veterinarian_phone").val();
        var pet_birth_day = convert_date(formPet.find("#pet_birth_day").val());
        var pet_doctor_name = formPet.find("#pet_doctor_name").val();
        var pet_guardian = formPet.find('#pet_guardian_member_id').val();//("#pet_guardian").val();
        var pet_guardian_first_name = formPet.find('#pet_guardian_first_name').val();
        var pet_guardian_last_name = formPet.find('#pet_guardian_last_name').val();
        var pet_notes = formPet.find("#pet_notes").val();

        var validated = validateRequiredElementsSet(['pet_name'], formPet);
        if (validated != true) {
            toastr.error(validated);
            return false;
        }

        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL+"project/estates/forms/My-Family/pet/processor.php",
            url: SITE_BASE_URL + "estate/ajax_pet_edit",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                action_on: 'Pet',
                pet_id: pet_id,
                pet_gender: pet_gender,
                pet_name: pet_name,
                pet_clinic_name: pet_clinic_name,
                pet_description: pet_description,
                pet_tag_id: pet_tag_id,
                pet_veterinarian_phone: pet_veterinarian_phone,
                pet_birth_day: pet_birth_day,
                pet_doctor_name: pet_doctor_name,
                pet_guardian: pet_guardian,
                pet_guardian_first_name: pet_guardian_first_name,
                pet_guardian_last_name: pet_guardian_last_name,
                pet_notes: pet_notes
            },
            success: function (data) {
                setValuesPet(data, true, true, $(this));
            }
        });
    });


    function setValuesPet(data, error_display, update, element) {
        var result_set = $.parseJSON(data);

        if (result_set.error != 1) {
            var result = result_set.result;
            $("#pet_id").val(result.pet_id);
            $(".pet_gender" + result.pet_gender).prop("checked", true);
            $("#pet_name").val(result.pet_name);
            $("#pet_clinic_name").val(result.pet_clinic_name);
            $("#pet_description").val(result.pet_description);
            $("#pet_tag_id").val(result.pet_tag_id);
            $("#pet_veterinarian_phone").val(result.pet_veterinarian_phone);//
            $("#pet_doctor_name").val(result.pet_doctor_name);//
            $("#pet_guardian").val(result.pet_guardian);//
            $("#pet_notes").val(result.pet_notes);//
            var document_element = formPet.find("#pet_documents");
            if (result.pet_birth_day) {
                var pet_birth_day = result.pet_birth_day.split('-');
                if (parseInt(pet_birth_day[1]) != 0)
                    $("#pet_birth_day").val('' + pet_birth_day[1] + '/' + pet_birth_day[2] + '/' + pet_birth_day[0]);
            }
            if (result.pet_image != '')
                $(".pet_image_img").attr('src', SITE_BASE_URL + PET_IMG_FOLDER + '/' + result.pet_image + '?rand=' + Math.random());

            add_document_open(document_element, result_set.result.pet_id);
        }
        //initiate_pet_elements();
        initiateMaterialPet($('#form-pets'));
        if (error_display != false) {
            if (result_set.error != 1) {
                // if(formDidChange_maritalStatus) {
                toastr.success(result_set.message);
                // formDidChange_maritalStatus = false;
                // }
                // toastr.success(result_set.message);
                // function adds if there is new upload
                add_image_also_pet();
            } else {
                toastr.error(result_set.message);
            }
        }
    }

    function add_image_also_pet() {
        if ($('#pet_picture').prop('files').length > 0) {
            $('#pet_picture').trigger('change');
        } else {
            showMemberCards();
        }
    }

    function readURLPet(input) {
        if (input.prop('files') && input.prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.pet_image_img').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.prop('files')[0]);
        }
    }


    $(document).on('change', '#pet_picture', function () {
        var pet_id = $("#pet_id").val().trim();
        if (pet_id == '') {
            readURLPet($(this));
            return false;
        }
        //on change event
        $('#loading').show();
        $('#pet_image_img').hide();
        var formdata = new FormData();
        if ($(this).prop('files').length > 0) {
            var file = $(this).prop('files')[0];
            formdata.append("pet_picture", file);
            formdata.append("pet_id", pet_id);
            formdata.append("action_on", 'Pet');
            $(this).replaceWith($(this).val('').clone(true));

            $.ajax({
                //url: SITE_BASE_URL+"project/estates/forms/My-Family/pet/image_processor.php",
                url: SITE_BASE_URL + "estate_image/ajax_pet_image",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: formdata,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (data, textStatus, jqXHR) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        $('.pet_image_img').attr('src', result_set.result);
                    }
                    if (result_set.error != 1)
                        toastr.success(result_set.message);
                    else
                        toastr.error(result_set.message);
                    $('#loading').hide();
                    $('#pet_image_img').show();
                    //make_submit_button_disable($('#btnChange-pets'));
                    showMemberCards();

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error(errorThrown);
                    $('#loading').hide();
                    $('#pet_image_img').show();
                    //make_submit_button_disable($('#btnChange-pets'));
                    showMemberCards();
                }
            });
        }
    });

    initiateMaterialPet($('#form-pets'));

    var search_val = '';
    var pet_guardian_member_first_name_request;
    $(document).on('keyup', "#pet_guardian_first_name", function () {
        search_val = $(this).val().trim();
        if (search_val == '') {
            $("#pet_guardian_suggesstion-box").html('');
        } else {
            if (pet_guardian_member_first_name_request) {
                pet_guardian_member_first_name_request.abort();
            }
            pet_guardian_member_first_name_request = $.ajax({
                type: "POST",
                // url: SITE_BASE_URL + "project/estates/forms/memberForms/processor.php",
                url: SITE_BASE_URL + "estate/ajax_pet_guardian_suggest",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    member_first_name: search_val,
                    current_member_id: 0
                },
                beforeSend: function () {
                    // $("search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function (data) {
                    $("#pet_guardian_suggesstion-box").show();
                    if (search_val != '') {
                        $("#pet_guardian_suggesstion-box").html(data.trim());
                    }
                    // $("#search-documents-input").css("background","#FFF");
                }
            });
        }
    });


    $(document).on('click', '.guardian_prediction_pet_add', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var member_id = $(this).data('member-id');
        if (member_id) {
            $.ajax({
                type: "POST",
                //url: SITE_BASE_URL + "project/estates/forms/My-Family/dependents/processor.php",
                url: SITE_BASE_URL + "estate/ajax_get_member",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    //action: 'get_member_for_guardian',
                    member_id: member_id
                },
                beforeSend: function () {
                },
                success: function (data) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        // setPetGuardianResult(result_set.result);
                        $('#pet_guardian_first_name').val(result_set.result.member_first_name);
                        $('#pet_guardian_last_name').val(result_set.result.member_last_name);
                        $('#pet_guardian_member_id').val(result_set.result.member_id);
                        toastr.success("Pet Caregiver Data Loaded. Please save to store");
                    } else {
                        toastr.error(result_set.message);
                    }
                    $("#pet_guardian_suggesstion-box").html('');
                }
            });
        }
    });

});


/*})(jQuery);*/

