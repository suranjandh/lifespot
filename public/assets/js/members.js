/*(function (SITE_BASE_URL, SITE_INDEX_URL, SITE_LOGOUT_URL, SITE_LOGIN_URL, DOCUMENT_URL,
           MESSAGE_ATTACHMENT_URL, MEMBER_IMG_URL, DEPENDENT_PROFILE_IMG_URL,
           DEPENDENT_GUARDIAN_IMG_URL, DEPENDENT_MEDICAL_IMG_URL, DEPENDENT_SCHOOL_IMG_URL,
           PET_IMG_URL, DEFAULT_AVATAR_IMAGE_URL, PROJECT_IMAGE_URL, SITE_IDLE_TIME_MINUTES, tab_id,
           roles_array_values_obj, relationship_array_values_obj, get_role_guardian,
           PET_IMG_FOLDER, ESTATE_IMG_FOLDER, MEMBER_IMG_FOLDER, PROFILE_IMG_FOLDER) {*/

$(document).ready(function () {

    $(document).on('click', '.member_content_box_delete', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var yes_delete = confirm("Want to delete?");
        if (yes_delete) {
            $.ajax({
                type: "POST",
                //url: SITE_BASE_URL + "project/estates/forms/memberForms/processor.php",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: SITE_BASE_URL + 'estate/member_delete',
                data: {
                    action_on: 'Member',
                    member_member_id: $(this).data('member-member-id')
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

    $(document).on('click', '.pet_content_box_delete', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var yes_delete = confirm("Want to delete?");
        if (yes_delete) {
            $.ajax({
                type: "POST",
                url: SITE_BASE_URL + "project/estates/forms/My-Family/pet/processor.php",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: SITE_BASE_URL + 'estate/pet_delete',
                data: {
                    action_on: 'Pet',
                    pet_id: $(this).data('pet-pet-id')
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

    $(document).on('click', '.lifespot_content_box_delete', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#lifeSpotDeleteModal').modal('show');
    });

    $(document).on('click', '#cancel_lifespot_delete', function (e) {
        $('#lifeSpotDeleteModal').modal('hide');
    });

    $(document).on('click', '#confirm_lifespot_delete', function (e) {
        var lifespot_password = $('#lifespot_password').val().trim();
        if (lifespot_password != '') {
            $.ajax({
                type: "POST",
                url: SITE_BASE_URL + "project/estates/forms/About-Me/Profile/processor.php",
                data: {
                    action: 'delete_lifespot',
                    lifespot_password: lifespot_password
                },
                success: function (data) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        window.location = SITE_LOGOUT_URL;
                    } else {
                        toastr.error(result_set.message);
                    }
                }
            });
        } else {
            toastr.error("Please fill password");
        }
    });


    $(document).on('click', '#profile-closeBtn', function (e) {
        e.preventDefault();
        //showMemberCards();
        $("#addNewMemberID1").modal('toggle');
    });

    $(document).on('click', '#member-closeBtn', function (e) {
        e.preventDefault();
        //showMemberCards();
        $("#addNewMemberID1").modal('toggle');
    });


    $(document).on('click', '#addNewMemberID1 .close', function (e) {
        e.preventDefault();
        //showMemberCards();
        //add_dependent_cards();
        $("#addNewMemberID1").modal('toggle');
    });

    var member_id = 0;
    var member_type = '';

    $(document).on('click', '.member_content_box', function () {
        if ($(this).hasClass("cancel_click")) return false;
        member_id = $(this).data('member-member-id');
        member_type = $(this).data('member-type');
        var modal_title = '';
        //var url = '';
        var url = SITE_BASE_URL + "estate/ajax_member_popup";

        var data = null;

        //if (member_type == 'new_estate' || member_type == 'current_estate') {
        if (member_type == 'estate') {
            //url = SITE_BASE_URL + "project/estates/forms/About-Me/Estate/estates.php";
            modal_title = 'Estate';
            data = {
                view: "project.estates.forms.AboutMe.Estate.estates"
            };
        }
        //if (member_type == 'new_member' || member_type == 'current_member') {
        else if (member_type == 'member') {
            //url = SITE_BASE_URL + "project/estates/forms/memberForms/members.php";
            data = {
                view: "project.estates.forms.memberForms.members",
                member_member_id: member_id
            };
            modal_title = 'Member';
        } else if (member_type == 'spouse') {
            //else if (member_type == 'current_spouse') {
            //url = SITE_BASE_URL + "project/estates/forms/My-Family/maritalStatus/maritalStatus.php";
            data = {
                view: "project.estates.forms.MyFamily.maritalStatus.maritalStatus",
                member_member_id: member_id
            };
            modal_title = 'Spouse';
        } else if (member_type == 'dependent') {
            //else if (member_type == 'current_dependent') {
            //url = SITE_BASE_URL + "project/estates/forms/My-Family/dependents/popup_modal/dependent_main.php";
            data = {
                view: "project.estates.forms.MyFamily.dependents.popup_modal.dependent_main",
                dependent_member_id: member_id
            };
            modal_title = 'Dependent';
        } else if (member_type == 'profile') {
            // else if (member_type == 'current_profile') {
            //url = SITE_BASE_URL + "project/estates/forms/About-Me/Profile/profiles.php";
            data = {
                view: "project.estates.forms.AboutMe.Profile.profiles",
                member_member_id: member_id
            };
            modal_title = 'Lifespot Owner';
        } else if (member_type == 'beneficiary') {
            //{ else if (member_type == 'current_beneficiary') {
            //url = SITE_BASE_URL + "project/estates/forms/My-Family/beneficiaries/beneficiaries.php";
            data = {
                view: "project.estates.forms.MyFamily.beneficiaries.beneficiaries",
                member_member_id: member_id
            };
            modal_title = 'Beneficiary';
        } else if (member_type == 'emergency_contact') {
            // else if (member_type == 'current_emergency_contact') {
            // url = SITE_BASE_URL + "project/estates/forms/About-Me/emergency_contact/emergency_contacts.php";
            data = {
                view: "project.estates.forms.AboutMe.emergency_contact.emergency_contacts",
                member_member_id: member_id
            };
            modal_title = 'Emergency Contact';
        } else if (member_type == 'friend') {
            // else if (member_type == 'current_friend') {
            // url = SITE_BASE_URL + "project/kid/MyProfile/AboutMe/Friends/friends.php";
            data = {
                view: "project.kid.MyProfile.AboutMe.Friends.friends",
                member_member_id: member_id
            };
            modal_title = 'Friend';
        } else if (member_type == 'pet') {
            //else if (member_type == 'current_pet') {
            //url = SITE_BASE_URL + "project/estates/forms/My-Family/pet/pets.php";
            data = {
                view: "project.estates.forms.MyFamily.pet.pets",
                pet_id: member_id
            };
            modal_title = 'Pet';
        }
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: url,
            data: data,
            success: function (data) {
                $('#add_new_member_modal').html(data);
                $("#addNewMemberID1 .modal-title").html(modal_title);
                // $('#btnChange-ADDmemberNew').text('Update');
                $("#addNewMemberID1 .cancel").show();
                $("#addNewMemberID1").modal('toggle');
                member_pop_up_initiate_elements(member_type);
            }
        });
    });


    function member_pop_up_initiate_elements(member_type) {
        $('#member-closeBtn').show();
        $('#dependents-closeBtn').show();

        if (member_type == 'member') {
            initiateMaterialMember($("#addNewMemberID1"));
        } else if (member_type == 'spouse') {
            initiateMaterialSpouse($("#addNewMemberID1"));
        } else if (member_type == 'dependent') {
            initiateMaterialDependent($("#addNewMemberID1"));
        } else if (member_type == 'profile') {
            initiateMaterialProfile($("#addNewMemberID1"));
        } else if (member_type == 'beneficiary') {
            initiateMaterialBeneficiary($("#addNewMemberID1"));
        } else if (member_type == 'emergency_contact') {
            initiateMaterialEmergency_contact($("#addNewMemberID1"));
        } else if (member_type == 'friend') {
            initiateMaterialFriend($("#addNewMemberID1"));
        } else if (member_type == 'pet') {
            initiateMaterialPet($("#addNewMemberID1"));
        }

    }

    $(document).on('click', "#btnChange-ADDmemberNew", function (e) {
        e.preventDefault();
        var member_member_id = $("#member_new_member_id").val();
        var member_gender = $('input[name="member_gender"]:checked').val();
        //var member_relationship = getRelationshipMember();
        var member_relationship_to_owner = $('#member_relationship_to_owner').val(); //getRelationshipDependent();//
        var member_role_in_estate_array = getRolesArrayMember();
        var member_role_in_estate = member_role_in_estate_array.join('|');
        var member_first_name = $("#member_first_name").val();
        var member_last_name = $("#member_last_name").val();
        var member_email = $("#member_email").val();
        var member_phone = $("#member_phone").val();

        var member_address = $("#member_address").val();
        var member_address2 = $("#member_address2").val();

        var member_city = $("#member_city").val();
        var member_state = $("#member_state").val();

        var member_zip = $("#member_zip").val();

        var member_birth_day = convert_date($("#member_birth_day").val());
        var member_notes = $("#member_notes").val();
        var member_guardian_dependents = $("#member_guardian_dependents").val().join(',');

        var document_element = $('#memberNewDocs');

        var validated = validateRequiredElementsSet(['member_first_name', 'member_last_name']);
        if (validated != true) {
            toastr.error(validated);
            return false;
        }
        /* if(validateRequiredElementsSet(['member_first_name','member_last_name'])) {

         }else {
             toastr.error("Member first name , last name required");
         }*/
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/forms/memberForms/processor.php",
            url: SITE_BASE_URL + "estate/ajax_member_edit",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                action_on: 'Member',
                member_id: member_member_id,
                member_gender: member_gender,
                member_relationship_to_owner: member_relationship_to_owner,
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
                member_guardian_dependents: member_guardian_dependents
            },
            success: function (data) {
                var result_set = $.parseJSON(data);
                if (result_set.error == 0) {
                    $("#member_new_member_id").val(result_set.result.member_id);
                    $("#memberNew-inviteBtn").data('member-member-id', result_set.result.member_id);
                    add_document_open(document_element, result_set.result.member_id);
                    if (member_email != '') {
                        $('.member_email').removeClass('validated_false');
                        $('#btnChangeMemberNewInvite').removeClass('disabled_invite');
                        $('#memberNewInviteStatus').show();
                    } else {
                        $('#btnChangeMemberNewInvite').addClass('disabled_invite');
                        $('#memberNewInviteStatus').hide();
                    }
                    if (result_set.result.member_associated_user == 0)
                        $('#btnChangeMemberNewInvite').show();
                    toastr.success(result_set.message);
                    add_image_also_member();
                } else {
                    toastr.error(result_set.message);
                }
            }
        });

    });


    function getRolesArrayMember() {
        var roles_set = [];
        $(('#member_role_in_estate option:selected')).each(function () {
            roles_set.push($(this).val());
        });
        return roles_set;
    }


    function getRelationshipMember() {
        var relationship = 0;
        $($('#memberNew-relationship').find('li.active')).each(function () {
            //relationship = relationship_array_values_obj.indexOf();
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


    function add_image_also_member() {
        if ($('#member_picture').prop('files').length > 0) {
            $('#member_picture').trigger('change');
        } else {
            showMemberCards();
        }
    }

    function readURLMember(input) {
        if (input.prop('files') && input.prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#member_img__img').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.prop('files')[0]);
        }
    }

    $(document).on('change', '#member_picture', function () {
        var member_member_id = $("#member_new_member_id").val();
        if (member_member_id.trim() == '' || !(parseInt(member_member_id) > 0)) {
            readURLMember($(this));
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
            formdata.append("action_on", 'Member');
            $.ajax({
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
                        $('#member_img__img').attr('src', result_set.result);
                        toastr.success(result_set.message);
                    } else {
                        toastr.error(result_set.message);
                    }

                    $('#loading').hide();
                    showMemberCards();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    //$('#spouse_error_message').html("Image Upload Error. Please Retry !");
                    toastr.error(errorThrown);
                    $('#loading').hide();
                    $('#member_img__img').show();
                    showMemberCards();
                    // STOP LOADING SPINNER
                }

            });
        }


    });


    $(document).on('click', '.member_share_modal_open', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var member_content_box = $(this).closest('.member_content_box');
        var member_name = member_content_box.data('member-name');
        var member_id = member_content_box.data('member-member-id');
        $.ajax({
            type: "POST",
            /*url: SITE_BASE_URL + "project/estates/forms/memberForms/member_box_processor_sharing.php",
            data: {
                member_id: member_id
            },*/
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: SITE_BASE_URL + 'estate/ajax_return_view',
            data: {
                view: "project.estates.forms.memberForms.member_box_processor_sharing",
                member_id: member_id
            },
            success: function (data) {
                $('#MemberShareModal .modal-title').html('<i class="fas fa-share-alt"></i> Share Member Details With ' + member_name);
                $('#MemberShareModal .modal-body').html(data);
                $('#MemberShareModal').modal('show');
            }
        });
    });


    $(document).on('click', '.invite_member_overview_modal_open', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var member_content_box = $(this).closest('.member_content_box');
        var member_name = member_content_box.data('member-name');
        var member_id = member_content_box.data('member-member-id');
        $.ajax({
            type: "POST",
           // url: SITE_BASE_URL + "project/estates/forms/memberForms/invitation_status.php",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: SITE_BASE_URL + 'estate/ajax_return_view',
            data: {
                member_id: member_id,
                view:"project/estates/forms/memberForms/invitation_status"
            },
            success: function (data) {
                $('#MemberShareModal .modal-title').html('<i class="far fa-dot-circle"></i> Member Invitations Overview ');
                $('#MemberShareModal .modal-body').html(data);
                $('#MemberShareModal').modal('show');
            }
        });
    });


    $(document).on('click', '.share_member_details', function (e) {
        var member_content_box = $(this).closest('.member-share-li');
        var member_share_to_member_id = member_content_box.data('share-to-member-id');
        var member_shared_member_id = member_content_box.data('member-member-id');
        var member_share_member_type = member_content_box.data('member-type');
        var shared = $(this).is(':checked') ? 1 : 0;
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/forms/memberForms/processor.php",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: SITE_BASE_URL + 'estate/ajax_share_unshare_member',
            data: {
                member_share_to_member_id: member_share_to_member_id,
                member_shared_member_id: member_shared_member_id,
                member_share_member_type: member_share_member_type,
                shared: shared
            },
            success: function (data) {
                var result_set = $.parseJSON(data);
                if (result_set.error != 1) {
                    if (shared)
                        toastr.success(result_set.message);
                    else
                        toastr.warning(result_set.message);
                } else {
                    toastr.error(result_set.message);
                }
            }
        });
    });


    $(document).on('click', '.cancel_click_temp', function (e) {
        e.stopPropagation();
        e.preventDefault();
    });


    function enable_dependent_select() {
        var member_guardian_dependents = $('#member_guardian_dependents');
        member_guardian_dependents.prop("disabled", false);
        member_guardian_dependents.material_select();
    }

    $(document).on('change', '.member_role_in_estate_for_dependents', function () {
        var roles_set = $(this).val();
        if (roles_set.indexOf("6") >= 0) {
            enable_dependent_select();
        }
    });


    $(document).on('click', '.open_account_overview', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/forms/memberForms/processor.php",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: SITE_BASE_URL + 'estate/ajax_return_view',
            data: {
              //  action: 'get_account_overview'
                view: "project/estates/forms/memberForms/account_overview"
            },
            success: function (data) {
                $('#accountOverviewModal .modal-title').html('<h2 class="h1-responsive font-weight-bold text-center my-1">LifeSpot Account Overview</h2>');
                $('#accountOverviewModal .modal-body').html(data);
                $("#accountOverviewModal").modal('show');
            }
        });

    });

    $(document).on('click', '.open_account_info_share_overview', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $.ajax({
            type: "POST",
            /* url: SITE_BASE_URL + "project/estates/forms/memberForms/processor.php",
             data: {
                 action: 'get_account_info_share_overview'
             },*/
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: SITE_BASE_URL + 'estate/ajax_return_view',
            data: {
                view: "project.estates.forms.memberForms.account_info_share_overview",
            },
            success: function (data) {
                $('#accountOverviewModal .modal-title').html('<h2 class="h1-responsive font-weight-bold text-center my-1">Information Share Overview</h2>');
                $('#accountOverviewModal .modal-body').html(data);
                $("#accountOverviewModal").modal('show');
            }
        });

    });
    //get_shared_documents_to_member  member_overview_card single-news data_display
    $(document).on('click', '.get_shared_documents_to_member', function () {
        var member_overview_card = $(this).closest('.member_overview_card');
        var data_display = $(this).closest('.single-news').find('.data_display');
        if (!(data_display.html().length > 0)) {
            $('.data_display').html('');
            var member_id = member_overview_card.data('member-id');
            $.ajax({
                type: "POST",
                //url: SITE_BASE_URL + "project/estates/forms/memberForms/processor.php",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: SITE_BASE_URL + 'estate/ajax_return_view',
                data: {
                    view: "project.estates.forms.memberForms.shared_documents_list",
                    // action: 'get_shared_documents_to_member',
                    member_id: member_id
                },
                success: function (data) {
                    data_display.html(data);
                }
            });
        } else {
            $('.data_display').html('');
        }
    });


    $(document).on('click', '.get_shared_information_to_member', function () {
        var member_overview_card = $(this).closest('.member_overview_card');
        var data_display = $(this).closest('.single-news').find('.data_display');
        if (!(data_display.html().length > 0)) {
            $('.data_display').html('');
            var member_id = member_overview_card.data('member-id');
            $.ajax({
                type: "POST",
                //url: SITE_BASE_URL + "project/estates/forms/memberForms/processor.php",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: SITE_BASE_URL + 'estate/ajax_return_view',
                data: {
                    view: "project.estates.forms.memberForms.shared_information_list",
                   // action: 'get_shared_information_to_member',
                    member_id: member_id
                },
                success: function (data) {
                    data_display.html(data);
                }
            });
        } else {
            $('.data_display').html('');
        }
    });


    //get_shared_documents_to_member  member_overview_card single-news data_display
    $(document).on('click', '.get_invitation_status_to_member', function () {
        var member_overview_card = $(this).closest('.member_overview_card');
        var data_display = $(this).closest('.single-news').find('.data_display');
        if (!(data_display.html().length > 0)) {
            $('.data_display').html('');
            var member_id = member_overview_card.data('member-id');
            $.ajax({
                type: "POST",
                // url: SITE_BASE_URL + "project/estates/forms/memberForms/processor.php",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: SITE_BASE_URL + 'estate/ajax_return_view',
                data: {
                    view: "project.estates.forms.memberForms.invitation_status_member",
                    //action: 'get_invitation_status_to_member',
                    member_id: member_id
                },
                success: function (data) {
                    data_display.html(data);
                }
            });
        } else {
            $('.data_display').html('');
        }
    });


    $(document).on('click', '.document_share_modal_open', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var member_content_box = $(this).closest('.member_content_box');
        var member_name = member_content_box.data('member-name');
        var member_id = member_content_box.data('member-member-id');
        var member_type = member_content_box.data('member-type');

        if (member_type == 'profile') {
            $.ajax({
                type: "POST",
                //url: SITE_BASE_URL + "project/estates/forms/memberForms/processor.php",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: SITE_BASE_URL + 'estate/ajax_return_view',
                data: {
                    view: "project/estates/forms/memberForms/account_document_share_overview",
                    member_id: member_id
                },
                success: function (data) {
                    $('#accountOverviewModal .modal-title').html('<h5 class="h5-responsive font-weight-bold text-center my-1">Shared Documents Overview</h5>');
                    $('#accountOverviewModal .modal-body').html(data);
                    $("#accountOverviewModal").modal('show');
                }
            });
        } else {
            $.ajax({
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: SITE_BASE_URL + 'estate/ajax_return_view',
                data: {
                    view: "project/estates/forms/memberForms/shared_documents_list",
                   // action: 'get_shared_documents_to_member',
                    member_id: member_id
                },
                success: function (data) {
                    $('#accountOverviewModal .modal-title').html('<h5 class="h5-responsive font-weight-bold text-center my-1">Shared Documents with ' + member_name + '</h5>');
                    $('#accountOverviewModal .modal-body').html(data);
                    $("#accountOverviewModal").modal('show');
                }
            });
        }

    });

    $('#search_members_cards_set').keyup(function () {
        var search_val = $(this).val().trim().toLocaleLowerCase();
        if (search_val != '') {
            $.each(member_card_data_array, function (i, item) {
                //alert(data[i].PageName);
                var name = member_card_data_array[i][0].toLocaleLowerCase();
                var element_id = member_card_data_array[i][1];
                if (name.search(search_val) != -1) {
                    $('#' + element_id).show();
                } else {
                    $('#' + element_id).hide();
                }
            });
        } else {
            $("#members-content .member-cardLayout").show();
        }
    });

    function invite_member_step_1(member_id) {
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/emails/processor.php",
            url: SITE_BASE_URL + "email/ajax_get_invitation_email",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                member_id: member_id
            },
            success: function (data) {
                $('#invitationEmailModal .modal-title').html("Invitation Email");
                $('#invitationEmailModal .modal-body').data('member-id', member_id);
                $('#invitationEmailModal .modal-body .main_message').html(data);
                $('#invitationEmailModal .modal-body .custom_message').show();

                $('#invitationEmailModal .modal-body #invitation_email_preview').show();
                $('#invitationEmailModal .modal-body #invitation_email_previous').hide();
                $('#invitationEmailModal .modal-body #invitation_email_send').hide();
                $('#invitationEmailModal .modal-body #invitation_email_discard').hide();
                $('#invitationEmailModal .modal-body .buttons_set').prop('disabled', false);


                $('#invitationEmailModal').modal('show');
            }
        });
    }

    // invitation_email_preview invitation_email_previous invitation_email_send  invitation_email_discard

    function invite_member_step_2(member_id, custom_message_invitation_email) {
        $.ajax({
            type: "POST",
            url: SITE_BASE_URL + "email/ajax_get_invitation_email",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                member_id: member_id,
                custom_message_invitation_email: custom_message_invitation_email
            },
            success: function (data) {
                $('#invitationEmailModal .modal-title').html("Invitation Email Preview");
                $('#invitationEmailModal .modal-body .main_message').html(data);
                $('#invitationEmailModal .modal-body .custom_message').hide();

                $('#invitationEmailModal .modal-body #invitation_email_preview').hide();
                $('#invitationEmailModal .modal-body #invitation_email_previous').show();
                $('#invitationEmailModal .modal-body #invitation_email_send').show();
                $('#invitationEmailModal .modal-body #invitation_email_discard').show();
                $('#invitationEmailModal .modal-body .buttons_set').prop('disabled', false);
                $('#invitationEmailModal').modal('show');
            }
        });
    }


    function invite_member_step_3(member_id, custom_message_invitation_email) {
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/emails/processor.php",
            url: SITE_BASE_URL + "email/ajax_send_invitation_email",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                member_id: member_id,
                custom_message_invitation_email: custom_message_invitation_email
            },
            success: function (data) {
                $('#invitationEmailModal').modal('hide');
                toastr.success("Invitation Sent");
                showMemberCards();
                add_dependent_cards();
            }
        });
    }

    $(document).on('click', '#invitationEmailModal .invite_process_buttons', function (e) {
        e.preventDefault();
    });

    $(document).on('click', '.invite_member_open', function (e) {
        e.preventDefault();
        e.stopPropagation();
        if ($(this).hasClass('disabled_invite')) {
            //alert('aaa');
            $(this).closest('form').find('.member_email').addClass('validated_false');
            return false;
        }

        var member_card = $(this).closest('.content_box');
        var member_id = member_card.data('member-member-id');
        // var member_email_validated = member_card.data('member-email-validated');

        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL + "project/estates/emails/processor.php",
            url: SITE_BASE_URL + "email/ajax_validate_member_email",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                member_id: member_id
            },
            success: function (data) {
                var result_set = $.parseJSON(data);
                if (result_set.error == 0) {
                    $('#custom_message_invitation_email').val('');
                    invite_member_step_1(member_id);
                } else {
                    $('#messageModal .modal-title').html("");
                    $('#messageModal .modal-body').html("Please add a valid email for member before invite.");
                    $('#messageModal').modal('show');
                }
            }
        });
        /* else {
             $('#messageModal .modal-title').html("");
             $('#messageModal .modal-body').html("Please add a valid email for member before invite.");
             $('#messageModal').modal('show');
         }*/

    });


    $(document).on('click', '#invitation_email_preview', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var member_card = $(this).closest('.modal-body');
        var member_id = member_card.data('member-id');
        var custom_message_invitation_email = $('#custom_message_invitation_email').val().trim();
        invite_member_step_2(member_id, custom_message_invitation_email);
    });


    $(document).on('click', '#invitation_email_previous', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var member_card = $(this).closest('.modal-body');
        var member_id = member_card.data('member-id');
        invite_member_step_1(member_id);
    });


    $(document).on('click', '#invitation_email_discard', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $('#invitationEmailModal .modal-body .main_message').html('');
        $('#invitationEmailModal').modal('hide');
    });

    $(document).on('click', '#invitation_email_send', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var member_card = $(this).closest('.modal-body');
        var member_id = member_card.data('member-id');
        var custom_message_invitation_email = $('#custom_message_invitation_email').val().trim();
        $('#invitationEmailModal .modal-body .buttons_set').prop('disabled', true);
        invite_member_step_3(member_id, custom_message_invitation_email);
    });

    $(document).on('click', '.message_member_open', function (e) {
        e.stopPropagation();
        window.location = $(this).data('href');
    });

    // add on top
});
/*})(jQuery);*/

