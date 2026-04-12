function initiateMaterialProfileKID(container) {
    /*container.find('#profileBdayField').pickadate({
        selectYears: 100,
        min: new Date(1902, 3, 20),
        max: new Date(2020, 7, 14),
        format: 'mm/dd/yyyy'
    });*/

    container.find('.phone_us').mask('(000) 000-0000');
}

$(document).ready(function () {

    initiateMaterialProfileKID($('#form-profileKID'));

    var form_site_data;
    var btnChanges_site = "#btnChange-site, #btnChangeNext-site";
    $(btnChanges_site).click(function () {
        if ($(this).attr('id') == 'btnChangeNext-site') {
            $('#aboutMe-profile-form-trigger').trigger('click');
        }
        if (!formSiteChanged) return false;
        formSiteChanged = false;
        form_site_data = $(this).closest('form');
        var site_name = form_site_data.find("#site_name").val();
        var site_owners = form_site_data.find("#site_owners").val();
        $.ajax({
            type: "POST",
            url: SITE_BASE_URL + "kid/ajax_site_edit",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                action_on: 'Site',
                site_name: site_name,
                site_owners: site_owners
            },
            success: function (data) {
                setValuesSite(data, true);
            }
        });
    });


    function setValuesSite(data, error_display, update) {
        var result_set = $.parseJSON(data);
        if (result_set.error != 1) {
            var result = result_set.result;
            $("#site_id").val(result.site_id);
            $("#site_name").val(result.site_name);
            $(".bind_site_name").html(result.site_name);
            $("#site_owners").val(result.site_owners);
            if (result.site_image != '') {
                $("#site_image_image").attr('src', SITE_BASE_URL + SITE_IMG_FOLDER + '/' + result.site_image + '?rand=' + Math.random());
            }

        }

        if (error_display != false) {
            if (result_set.error != 1) {
                // if (formDidChange_site) {
                toastr.success(result_set.message);
                // alert(formDidChange_site);
                //    formDidChange_site = false;
                // }
                // toastr.success(result_set.message);
                // function adds if there is new upload

            } else {
                toastr.error(result_set.message);
            }
            add_image_also_site();
        }
    }

    function add_image_also_site() {
        if ($('#site_picture').prop('files').length > 0) {
            $('#site_picture').trigger('change');
        } else {
            //showMemberCards();
        }
    }

    function readURLSite(input) {
        if (input.prop('files') && input.prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#site_image_image').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.prop('files')[0]);
        }
    }


    $('#site_picture').change(function () {
        var site_id = $("#site_id").val().trim();
        if (site_id == '') {
            readURLSite($(this));
            return false;
        }
        //on change event
        $('#loading_site_image_image').show();
        $('#site_image_image').hide();
        var formdata = new FormData();
        if ($(this).prop('files').length > 0) {
            var file = $(this).prop('files')[0];
            formdata.append("site_picture", file);
            formdata.append("action_on",'Site');

            $(this).replaceWith($(this).val('').clone(true));

            $.ajax({
                // url:SITE_BASE_URL+"project/kid/MyProfile/AboutMe/Site/image_processor.php",
                url: SITE_BASE_URL + "kid/ajax_site_image",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: formdata,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (data, textStatus, jqXHR) {
                    var result_set = $.parseJSON(data);
                    if (result_set.error == 0) {
                        $('#site_image_image').attr('src', result_set.result);
                        $('.site_image_image').attr('src', result_set.result);
                    }
                    toastr.success(result_set.message);
                    $('#loading_site_image_image').hide();
                    $('#site_image_image').show();
                    //make_submit_button_disable($('#btnChange-site'));
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    toastr.error(errorThrown);
                    $('#loading_site_image_image').hide();
                    $('#site_image_image').show();
                    //make_submit_button_disable($('#btnChange-site'));
                    //showMemberCards();
                    // STOP LOADING SPINNER
                }
            });
        }
    });


    var form_profile_kid_data;
    var btnChanges_profile = "#btnChange-KIDprofile, #btnChangeNext-KIDprofile";
    $(document).on('click',btnChanges_profile,function () {
        if ($(this).attr('id') == 'btnChangeNext-KIDprofile') {
            $('#aboutMe-emergencyContacts-form-trigger').trigger('click');
        }
        if (!formProfileKIDChanged) return false;
        formSiteChanged = false;
        form_profile_kid_data = $(this).closest('form');
        var userGender = form_profile_kid_data.find('input[name=userGender]:checked').val();
        var profileFName = form_profile_kid_data.find("#profileFName").val();
        var profileLName = form_profile_kid_data.find("#profileLName").val();
        var profile_email = form_profile_kid_data.find('#profile_email').val();
        var profilePhone = form_profile_kid_data.find('#profilePhone').val();
        var profilePhone2 = form_profile_kid_data.find('#profilePhone2').val();
        //var profileBday = form_profile_kid_data.find('#profileBdayField').val();
        var profileNickName = form_profile_kid_data.find('#profileNickName').val();
        var profileBdayField_month = form_profile_kid_data.find('#profileBdayField_month').val();
        var profileBdayField_day = form_profile_kid_data.find('#profileBdayField_day').val();
        var profileBdayField_age = form_profile_kid_data.find('#profileBdayField_age').val();
        var profileBdayAge = profileBdayField_age+'-'+profileBdayField_month+'-'+profileBdayField_day;
        if(profileBdayAge ==''){
            form_profile_kid_data.find('#profileBdayField_month').val('');
            form_profile_kid_data.find('#profileBdayField_day').val('');
        }
        var validated = validateRequiredElementsSet(['profileFName','profileLName'],form_profile_kid_data);
        if(validated != true){
            toastr.error(validated);return false ;
        }
        $.ajax({
            type: "POST",
            //url: "MyProfile/AboutMe/Profile/processor.php",
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
                profile_birth_day_age: profileBdayAge,
                profile_nickName: profileNickName
            },
            success: function (data) {
                setValuesProfileKID(data, true);
            }
        });
    });


    function setValuesProfileKID(data, error_display, update) {
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
            if (result.profile_bday) {
                var date_split = result.profile_bday.split('-');
                if (parseInt(date_split[0]) > 0)
                    $("#profileBdayField").val('' + date_split[1] + '/' + date_split[2] + '/' + date_split[0]);
            }
            $("#profileNickName").val(result.profile_nickName);
            if (result.profile_image.trim() != '')
                $("#profile_image_img").attr('src', SITE_BASE_URL + PROFILE_IMG_FOLDER + '/' + result.profile_image + '?rand=' + Math.random());
        }
        initiateMaterialProfileKID($('#form-profileKID'));
        if (error_display != false) {
            if (result_set.error != 1) {
                toastr.success(result_set.message);
                add_image_also_profileKID();
            } else {
                toastr.error(result_set.message);
            }
        }
    }

    function add_image_also_profileKID() {
        if ($('#profile_kid_picture').prop('files').length > 0) {
            $('#profile_kid_picture').trigger('change');
        } else {
            showMemberCards();
        }
    }

    function readURLprofileKID(input) {
        if (input.prop('files') && input.prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#profile_image_image').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.prop('files')[0]);
        }
    }


    $(document).on('change','#profile_kid_picture',function () {
        var profile_id = $("#profile_id").val().trim();
        if (profile_id == '') {
            readURLProfileKID($(this));
            return false;
        }
        //on change event
        $('#loading_profile_image_image').show();
        $('#profile_image_image').hide();
        var formdata = new FormData();
        if ($(this).prop('files').length > 0) {
            var file = $(this).prop('files')[0];
            formdata.append("profile_image", file);
            formdata.append("action_on", 'Profile');

            $(this).replaceWith($(this).val('').clone(true));

            $.ajax({
                //url: SITE_BASE_URL+"project/kid/MyProfile/AboutMe/Profile/image_processor.php",
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
                        $('#profile_image_image').attr('src', result_set.result);
                        $('.profile_image_image').attr('src', result_set.result);
                    }
                    toastr.success(result_set.message);
                    $('#loading_profile_image_image').hide();
                    $('#profile_image_image').show();
                    //make_submit_button_disable($('#btnChangeNext-KIDprofile'));
                    showMemberCards();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    toastr.error(errorThrown);
                    $('#loading_profile_image_image').hide();
                    $('#profile_image_image').show();
                    //make_submit_button_disable($('#btnChangeNext-KIDprofile'));
                    showMemberCards();
                    // STOP LOADING SPINNER
                }
            });
        }
    });



    var formFriend = null;
    var btnChanges_friend = "#btnChange-friends";
    $(document).on('click', btnChanges_friend, function () {
        formFriend = $(this).closest('form');
        var friend_member_id = formFriend.find("#friend_member_id").val();
        var friend_gender = formFriend.find('input[name="friend_gender"]:checked').val();
        var friend_first_name = formFriend.find("#friend_first_name").val();
        var friend_last_name = formFriend.find("#friend_last_name").val();
        var friend_email = formFriend.find("#friend_email").val();
        var friend_phone = formFriend.find("#friend_phone").val();
        var friendBdayField_month = formFriend.find('#friendBdayField_month').val();
        var friendBdayField_day = formFriend.find('#friendBdayField_day').val();
        var friendBdayField_age = formFriend.find('#friendBdayField_age').val();
        var friendBdayAge = friendBdayField_age+'-'+friendBdayField_month+'-'+friendBdayField_day;
        if(friendBdayAge ==''){
            form_friend_kid_data.find('#friendBdayField_month').val('');
            form_friend_kid_data.find('#friendBdayField_day').val('');
        }
        var validated = validateRequiredElementsSet(['friend_first_name','friend_last_name'],formFriend);
        if(validated != true){
            toastr.error(validated);return false ;
        }
        $.ajax({
            type: "POST",
            //url: SITE_BASE_URL+"project/kid/MyProfile/AboutMe/Friends/processor.php",
            url: SITE_BASE_URL + "estate/ajax_member_edit",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                action_on: 'Friend',
                member_id: friend_member_id,
                member_gender: friend_gender,
                member_first_name: friend_first_name,
                member_last_name: friend_last_name,
                member_email: friend_email,
                member_phone: friend_phone,
                member_birth_day_age:friendBdayAge
            },
            success: function (data) {
                setValuesFriend(data, true, true);
            }
        });
    });


    function setValuesFriend(data, error_display, update) {
        var result_set = $.parseJSON(data);

        if (result_set.error != 1) {
            var result = result_set.result;
            $("#friend_member_id").val(result.member_id);
            $(".friend_gender" + result.member_gender).prop("checked", true);
            $("#friend_first_name").val(result.member_first_name);
            $("#friend_last_name").val(result.member_last_name);
            $("#friend_email").val(result.member_email);
            $('#friend-inviteBtn').data('member-member-id',result.member_id);
            if (result.member_email != '') {
                $('.member_email').removeClass('validated_false');
                $('#btnChangeFriendNewInvite').removeClass('disabled_invite');
                $('#friendNewInviteStatusContainer').show();
            }else {
                $('#btnChangeFriendNewInvite').addClass('disabled_invite');
                $('#friendNewInviteStatusContainer').hide();
            }
            $('#btnChangeFriendNewInvite').show();
            $("#friend_phone").val(result.member_phone);

            if (result.member_image.trim() != '')
                $(".friend_image_img").attr('src', SITE_BASE_URL + MEMBER_IMG_FOLDER + '/' + result.member_image + '?rand=' + Math.random());
        }
        //initiate_friend_elements();
        initiateMaterialFriend($('#form-friends'));
        if (error_display != false) {
            if (result_set.error != 1) {
                // if(formDidChange_maritalStatus) {
                toastr.success(result_set.message);
                // formDidChange_maritalStatus = false;
                // }
                // toastr.success(result_set.message);
                // function adds if there is new upload
                add_image_also_friend();
            } else {
                toastr.error(result_set.message);
            }
        }
    }

    function add_image_also_friend() {
        if ($('#friend_picture').prop('files').length > 0) {
            $('#friend_picture').trigger('change');
        } else {
            showMemberCards();
        }
    }

    function readURLFriend(input) {
        if (input.prop('files') && input.prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.friend_image_img').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.prop('files')[0]);
        }
    }


    $(document).on('change', '#friend_picture', function () {
        var friend_member_id = $("#friend_member_id").val().trim();
        if (friend_member_id == '') {
            readURLFriend($(this));
            return false;
        }
        //on change event
        $('#loading').show();
        $('#friend_image_img').hide();
        var formdata = new FormData();
        if ($(this).prop('files').length > 0) {
            var file = $(this).prop('files')[0];
            formdata.append("member_image", file);
            formdata.append("member_id", friend_member_id);
            formdata.append("action_on", 'Friend');
            $(this).replaceWith($(this).val('').clone(true));

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
                        showMemberCards();
                        $('.friend_image_img').attr('src', result_set.result);
                    }
                    if (result_set.error != 1)
                        toastr.success(result_set.message);
                    else
                        toastr.error(result_set.message);
                    $('#loading').hide();
                    $('#friend_image_img').show();
                    //make_submit_button_disable($('#btnChange-friends'));

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error(errorThrown);
                    $('#loading').hide();
                    $('#friend_image_img').show();
                    //make_submit_button_disable($('#btnChange-friends'));
                    showMemberCards();

                }
            });
        }
    });

    initiateMaterialFriend($('#form-friends'));


});