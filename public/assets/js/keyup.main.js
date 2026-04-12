/* function make_submit_button_disable(element) {
     element.html('Update');
     element.removeClass('btn-warning');
     element.css('font-size', '.6rem',);
     element.addClass('btn-primary');
     element.addClass('disabled');
 }

 function make_submit_button_enable(element) {
     element.html('Save your changes');
     element.removeClass('disabled');
     element.css('font-size', '.8rem',);
     element.removeClass('btn-primary');
     element.addClass('btn-warning');
 }*/


var formDidChange_estate = false;
var formDidChange_profile = false;
var formDidChange_maritalStatus = false;

$(document).ready(function () {
    $("#btnChange-estate, #btnChange-profile, #btnChange-erContacts,#btnChange-maritalStatus, #btnChange-dependents, #btnChange-beneficiaries, #btnChange-pet, #btnChange-work, #btnChange-education, #btnChange-military, #btnChange-volunteer, #btnChange-banking, #btnChange-property, #btnChange-asset, #btnChange-retirement, #btnChange-tax, #btnChange-business, #btnChange-health, #btnChange-dental, #btnChange-longTermCare").addClass('disabled');
    $(document).on('change', '#addNewMemberID1 #form-estate :input', function () {
        if (!$(this).hasClass('change_trigger_disabled')) {
            formDidChange_estate = true;
            $("#addNewMemberID1 #btnChange-estate").html('Save your changes');
            $("#addNewMemberID1 #btnChange-estate").removeClass('disabled');
            $("#addNewMemberID1 #btnChange-estate").css('font-size', '.8rem',);
            $("#addNewMemberID1 #btnChange-estate").removeClass('btn-primary');
            $("#addNewMemberID1 #btnChange-estate").addClass('btn-warning');
        }
    });

    $("#form-estate :input").change(function () {
        if (!$(this).hasClass('change_trigger_disabled')) {
            formDidChange_estate = true;
            $("#btnChangeNext-estate").html('Save / Next');
            // $("#btnChangeNext-estate").removeClass('disabled');
            $("#btnChangeNext-estate").css('font-size', '.8rem',);
            $("#btnChangeNext-estate").removeClass('btn-primary');
            $("#btnChangeNext-estate").addClass('btn-warning');

            $("#btnChange-estate").html('Save your changes');
            $("#btnChange-estate").removeClass('disabled');
            $("#btnChange-estate").css('font-size', '.8rem',);
            $("#btnChange-estate").removeClass('btn-primary');
            $("#btnChange-estate").addClass('btn-warning');
        }

        //$("#btnChangeNext-estate").name('active');
        // formDidChange_estate = true;
    });


    $(document).on('change', '#addNewMemberID1 #form-memberNew :input', function () {
        if (!$(this).hasClass('change_trigger_disabled')) {
            $(this).closest('form').find('.cancel_button_set').html('Cancel');
            $("#addNewMemberID1 #btnChange-ADDmemberNew").html('Save your changes');
            $("#addNewMemberID1 #btnChange-ADDmemberNew").removeClass('disabled');
            $("#addNewMemberID1 #btnChange-ADDmemberNew").css('font-size', '.8rem');
            $("#addNewMemberID1 #btnChange-ADDmemberNew").removeClass('btn-primary');
            $("#addNewMemberID1 #btnChange-ADDmemberNew").addClass('btn-warning');
        }
    });

    $(document).on('click', '#addNewMemberID1 #btnChange-ADDmemberNew', function () {
        $(this).closest('form').find('.cancel_button_set').html('Close');
        $("#addNewMemberID1 #btnChange-ADDmemberNew").html('Update');
        $("#addNewMemberID1 #btnChange-ADDmemberNew").css('font-size', '.64rem');
        $("#addNewMemberID1 #btnChange-ADDmemberNew").addClass('disabled');
        $("#addNewMemberID1 #btnChange-ADDmemberNew").removeClass('btn-warning');
        $("#addNewMemberID1 #btnChange-ADDmemberNew").addClass('btn-primary');
    });

    $(document).on('change', '#addNewdependentID1 #form_profile_dependent :input', function () {
        if (!$(this).hasClass('change_trigger_disabled')) {

            $("#addNewdependentID1 #btnChange-dependents").html('Save your changes');
            $("#addNewdependentID1 #btnChange-dependents").removeClass('disabled');
            $("#addNewdependentID1 #btnChange-dependents").css('font-size', '.8rem');
            $("#addNewdependentID1 #btnChange-dependents").removeClass('btn-primary');
            $("#addNewdependentID1 #btnChange-dependents").addClass('btn-warning');
        }
    });

    $(document).on('click', '#addNewdependentID1 #btnChange-dependents', function () {
        $("#addNewdependentID1 #btnChange-dependents").html('Update');
        $("#addNewdependentID1 #btnChange-dependents").css('font-size', '.8rem');
        $("#addNewdependentID1 #btnChange-dependents").addClass('disabled');
        $("#addNewdependentID1 #btnChange-dependents").removeClass('btn-warning');
        $("#addNewdependentID1 #btnChange-dependents").addClass('btn-primary');
    });


    $(document).on('change', '#addNewdependentID1 #form_guardian_dependent :input', function () {
        if (!$(this).hasClass('change_trigger_disabled')) {

            $("#addNewdependentID1 #btnChange-ADDGuardianmemberNew").html('Save Change');
            $("#addNewdependentID1 #btnChange-ADDGuardianmemberNew").removeClass('disabled');
            $("#addNewdependentID1 #btnChange-ADDGuardianmemberNew").css('font-size', '.8rem');
            $("#addNewdependentID1 #btnChange-ADDGuardianmemberNew").removeClass('btn-primary');
            $("#addNewdependentID1 #btnChange-ADDGuardianmemberNew").addClass('btn-warning');
        }
    });

    $(document).on('click', '#addNewdependentID1 #btnChange-ADDGuardianmemberNew', function () {
        $("#addNewdependentID1 #btnChange-ADDGuardianmemberNew").html('Update');
        $("#addNewdependentID1 #btnChange-ADDGuardianmemberNew").css('font-size', '.8rem');
        $("#addNewdependentID1 #btnChange-ADDGuardianmemberNew").addClass('disabled');
        $("#addNewdependentID1 #btnChange-ADDGuardianmemberNew").removeClass('btn-warning');
        $("#addNewdependentID1 #btnChange-ADDGuardianmemberNew").addClass('btn-primary');
    });


    $(document).on('change', '#addNewdependentID1 #form_medical_dependent :input', function () {
        $("#addNewdependentID1 #btnChange-dependents-medical").html('Save Changes');
        $("#addNewdependentID1 #btnChange-dependents-medical").removeClass('disabled');
        $("#addNewdependentID1 #btnChange-dependents-medical").css('font-size', '.8rem');
        $("#addNewdependentID1 #btnChange-dependents-medical").removeClass('btn-primary');
        $("#addNewdependentID1 #btnChange-dependents-medical").addClass('btn-warning');
    });

    $(document).on('click', '#addNewdependentID1 #btnChange-dependents-medical', function () {
        $("#addNewdependentID1 #btnChange-dependents-medical").html('Save Changes');
        $("#addNewdependentID1 #btnChange-dependents-medical").css('font-size', '.8rem');
        $("#addNewdependentID1 #btnChange-dependents-medical").addClass('disabled');
        $("#addNewdependentID1 #btnChange-dependents-medical").removeClass('btn-warning');
        $("#addNewdependentID1 #btnChange-dependents-medical").addClass('btn-primary');
    });


    $(document).on('change', '#addNewdependentID1 #form_dependent_school_content :input', function () {
        $("#addNewdependentID1 #btnChange-dependents-school").html('Save Changes');
        $("#addNewdependentID1 #btnChange-dependents-school").removeClass('disabled');
        $("#addNewdependentID1 #btnChange-dependents-school").css('font-size', '.8rem');
        $("#addNewdependentID1 #btnChange-dependents-school").removeClass('btn-primary');
        $("#addNewdependentID1 #btnChange-dependents-school").addClass('btn-warning');
    });

    $(document).on('click', '#addNewdependentID1 #btnChange-dependents-school', function () {
        $("#addNewdependentID1 #btnChange-dependents-school").html('Save Changes');
        $("#addNewdependentID1 #btnChange-dependents-school").css('font-size', '.8rem');
        $("#addNewdependentID1 #btnChange-dependents-school").addClass('disabled');
        $("#addNewdependentID1 #btnChange-dependents-school").removeClass('btn-warning');
        $("#addNewdependentID1 #btnChange-dependents-school").addClass('btn-primary');
    });


    $(document).on('change', '#addNewMemberID1 #form_profile_dependent :input', function () {
        if (!$(this).hasClass('change_trigger_disabled')) {

            $("#addNewMemberID1 #btnChange-dependents").html('Save your changes');
            $("#addNewMemberID1 #btnChange-dependents").removeClass('disabled');
            $("#addNewMemberID1 #btnChange-dependents").css('font-size', '.8rem');
            $("#addNewMemberID1 #btnChange-dependents").removeClass('btn-primary');
            $("#addNewMemberID1 #btnChange-dependents").addClass('btn-warning');
        }
    });

    $(document).on('click', '#addNewMemberID1 #btnChange-dependents', function () {
        $("#addNewMemberID1 #btnChange-dependents").html('Update');
        $("#addNewMemberID1 #btnChange-dependents").css('font-size', '.8rem');
        $("#addNewMemberID1 #btnChange-dependents").addClass('disabled');
        $("#addNewMemberID1 #btnChange-dependents").removeClass('btn-warning');
        $("#addNewMemberID1 #btnChange-dependents").addClass('btn-primary');
    });


    $(document).on('change', '#addNewMemberID1 #form_guardian_dependent :input', function () {
        $("#addNewMemberID1 #btnChange-ADDGuardianmemberNew").html('Add/Update member');
        $("#addNewMemberID1 #btnChange-ADDGuardianmemberNew").removeClass('disabled');
        $("#addNewMemberID1 #btnChange-ADDGuardianmemberNew").css('font-size', '.8rem');
        $("#addNewMemberID1 #btnChange-ADDGuardianmemberNew").removeClass('btn-primary');
        $("#addNewMemberID1 #btnChange-ADDGuardianmemberNew").addClass('btn-warning');
    });

    $(document).on('click', '#addNewMemberID1 #btnChange-ADDGuardianmemberNew', function () {
        $("#addNewMemberID1 #btnChange-ADDGuardianmemberNew").html('Add/Update member');
        $("#addNewMemberID1 #btnChange-ADDGuardianmemberNew").css('font-size', '.8rem');
        $("#addNewMemberID1 #btnChange-ADDGuardianmemberNew").addClass('disabled');
        $("#addNewMemberID1 #btnChange-ADDGuardianmemberNew").removeClass('btn-warning');
        $("#addNewMemberID1 #btnChange-ADDGuardianmemberNew").addClass('btn-primary');
    });


    $(document).on('change', '#addNewMemberID1 #form_medical_dependent :input', function () {
        $("#addNewMemberID1 #btnChange-dependents-medical").html('Save Changes');
        $("#addNewMemberID1 #btnChange-dependents-medical").removeClass('disabled');
        $("#addNewMemberID1 #btnChange-dependents-medical").css('font-size', '.8rem');
        $("#addNewMemberID1 #btnChange-dependents-medical").removeClass('btn-primary');
        $("#addNewMemberID1 #btnChange-dependents-medical").addClass('btn-warning');
    });

    $(document).on('click', '#addNewMemberID1 #btnChange-dependents-medical', function () {
        $("#addNewMemberID1 #btnChange-dependents-medical").html('Save Changes');
        $("#addNewMemberID1 #btnChange-dependents-medical").css('font-size', '.8rem');
        $("#addNewMemberID1 #btnChange-dependents-medical").addClass('disabled');
        $("#addNewMemberID1 #btnChange-dependents-medical").removeClass('btn-warning');
        $("#addNewMemberID1 #btnChange-dependents-medical").addClass('btn-primary');
    });


    $(document).on('change', '#addNewMemberID1 #form_dependent_school_content :input', function () {
        $("#addNewMemberID1 #btnChange-dependents-school").html('Save Changes');
        $("#addNewMemberID1 #btnChange-dependents-school").removeClass('disabled');
        $("#addNewMemberID1 #btnChange-dependents-school").css('font-size', '.8rem');
        $("#addNewMemberID1 #btnChange-dependents-school").removeClass('btn-primary');
        $("#addNewMemberID1 #btnChange-dependents-school").addClass('btn-warning');
    });

    $(document).on('click', '#addNewMemberID1 #btnChange-dependents-school', function () {
        $("#addNewMemberID1 #btnChange-dependents-school").html('Save Changes');
        $("#addNewMemberID1 #btnChange-dependents-school").css('font-size', '.8rem');
        $("#addNewMemberID1 #btnChange-dependents-school").addClass('disabled');
        $("#addNewMemberID1 #btnChange-dependents-school").removeClass('btn-warning');
        $("#addNewMemberID1 #btnChange-dependents-school").addClass('btn-primary');
    });


    $(document).on('change', '#addNewMemberID1 #form-beneficiaries :input', function () {
        $("#addNewMemberID1 #btnChange-beneficiaries").html('Save Changes');
        $("#addNewMemberID1 #btnChange-beneficiaries").removeClass('disabled');
        $("#addNewMemberID1 #btnChange-beneficiaries").css('font-size', '.8rem');
        $("#addNewMemberID1 #btnChange-beneficiaries").removeClass('btn-primary');
        $("#addNewMemberID1 #btnChange-beneficiaries").addClass('btn-warning');
    });

    $(document).on('click', '#addNewMemberID1 #btnChange-beneficiaries', function () {
        $("#addNewMemberID1 #btnChange-beneficiaries").html('Save Changes');
        $("#addNewMemberID1 #btnChange-beneficiaries").css('font-size', '.64rem');
        $("#addNewMemberID1 #btnChange-beneficiaries").addClass('disabled');
        $("#addNewMemberID1 #btnChange-beneficiaries").removeClass('btn-warning');
        $("#addNewMemberID1 #btnChange-beneficiaries").addClass('btn-primary');
    });


    $(document).on('change', '#addNewMemberID1 #form-emergency_contacts :input', function () {
        $("#addNewMemberID1 #btnChange-emergency_contacts").html('Save Changes');
        $("#addNewMemberID1 #btnChange-emergency_contacts").removeClass('disabled');
        $("#addNewMemberID1 #btnChange-emergency_contacts").css('font-size', '.8rem');
        $("#addNewMemberID1 #btnChange-emergency_contacts").removeClass('btn-primary');
        $("#addNewMemberID1 #btnChange-emergency_contacts").addClass('btn-warning');
    });

    $(document).on('click', '#addNewMemberID1 #btnChange-emergency_contacts', function () {
        $("#addNewMemberID1 #btnChange-emergency_contacts").html('Save Changes');
        $("#addNewMemberID1 #btnChange-emergency_contacts").css('font-size', '.64rem');
        $("#addNewMemberID1 #btnChange-emergency_contacts").addClass('disabled');
        $("#addNewMemberID1 #btnChange-emergency_contacts").removeClass('btn-warning');
        $("#addNewMemberID1 #btnChange-emergency_contacts").addClass('btn-primary');
    });


    $(document).on('change', '#addNewMemberID1 #form-profile :input', function () {
        if (!$(this).hasClass('change_trigger_disabled')) {
            formDidChange_profile = true;
            $("#addNewMemberID1 #btnChange-profile").html('Save your changes');
            $("#addNewMemberID1 #btnChange-profile").removeClass('disabled');
            $("#addNewMemberID1 #btnChange-profile").css('font-size', '.8rem');
            $("#addNewMemberID1 #btnChange-profile").removeClass('btn-primary');
            $("#addNewMemberID1 #btnChange-profile").addClass('btn-warning');
        }
    });

    $("#form-profile :input").change(function () {
        if (!$(this).hasClass('change_trigger_disabled')) {
            formDidChange_profile = true;
            $("#btnChangeNext-profile").html('Save / Next');
            // $("#btnChangeNext-profile").removeClass('disabled');
            $("#btnChangeNext-profile").css('font-size', '.8rem');
            $("#btnChangeNext-profile").removeClass('btn-primary');
            $("#btnChangeNext-profile").addClass('btn-warning');

            $("#btnChange-profile").html('Save your changes');
            $("#btnChange-profile").removeClass('disabled');
            $("#btnChange-profile").css('font-size', '.8rem');
            $("#btnChange-profile").removeClass('btn-primary');
            $("#btnChange-profile").addClass('btn-warning');
        }
    });
    $("#form-erContacts :input").change(function () {
        if (!$(this).hasClass('change_trigger_disabled')) {
            $("#btnChange-erContacts").html('Save your changes');
            $("#btnChange-erContacts").removeClass('disabled');
            $("#btnChange-erContacts").css('font-size', '.8rem');
            $("#btnChange-erContacts").removeClass('btn-primary');
            $("#btnChange-erContacts").addClass('btn-warning');

            $("#btnChangeNext-erContacts").html('Save / Next');
            // $("#btnChangeNext-erContacts").removeClass('disabled');
            $("#btnChangeNext-erContacts").css('font-size', '.8rem');
            $("#btnChangeNext-erContacts").removeClass('btn-primary');
            $("#btnChangeNext-erContacts").addClass('btn-warning');
        }
    });

    $(document).on('change', '#addNewMemberID1 #form-maritalStatus :input', function () {
        if (!$(this).hasClass('change_trigger_disabled')) {

            $("#addNewMemberID1 #btnChange-maritalStatus").html('Save your changes');
            $("#addNewMemberID1 #btnChange-maritalStatus").removeClass('disabled');
            $("#addNewMemberID1 #btnChange-maritalStatus").css('font-size', '.8rem');
            $("#addNewMemberID1 #btnChange-maritalStatus").removeClass('btn-primary');
            $("#addNewMemberID1 #btnChange-maritalStatus").addClass('btn-warning');
        }
    });

    $("#form-maritalStatus :input").change(function () {
        if (!$(this).hasClass('change_trigger_disabled')) {

            $("#btnChange-maritalStatus").html('Save your changes');
            $("#btnChange-maritalStatus").removeClass('disabled');
            $("#btnChange-maritalStatus").css('font-size', '.8rem');
            $("#btnChange-maritalStatus").removeClass('btn-primary');
            $("#btnChange-maritalStatus").addClass('btn-warning');

            $("#btnChangeNext-maritalStatus").html('Save / Next');
            // $("#btnChangeNext-maritalStatus").removeClass('disabled');
            $("#btnChangeNext-maritalStatus").css('font-size', '.8rem');
            $("#btnChangeNext-maritalStatus").removeClass('btn-primary');
            $("#btnChangeNext-maritalStatus").addClass('btn-warning');
            formDidChange_maritalStatus = true;
        }
    });
    $(document).on('change', "#form-dependents :input", function () {
        $("#btnChange-dependents").html('Save your changes');
        $("#btnChange-dependents").removeClass('disabled');
        $("#btnChange-dependents").css('font-size', '.8rem');
        $("#btnChange-dependents").removeClass('btn-primary');
        $("#btnChange-dependents").addClass('btn-warning');
    });
    /*
            $($(this)).each(function (i,e) {
                if($(e).hasClass('change_trigger_disabled')){
                    continue ;
                }
            });*/
    /*$(document).on('change', "#form_profile_dependent :input", function () {
       // if($(this).hasClass('change_trigger_disabled'))return false ;
       // console.log($(this));
             // if($(this).hasClass('change_trigger_disabled'))return;
        $($(this)).each(function (i,e) {
           // if($(e).hasClass('change_trigger_disabled')){
               // continue ;
            if($(e).hasClass('change_trigger_disabled')) {
                return false;
            }
            //}
        });
        $("#btnChange-dependents").html('Save Changes');
        $("#btnChange-dependents").removeClass('disabled');
        $("#btnChange-dependents").css('font-size', '.8rem');
        $("#btnChange-dependents").removeClass('btn-primary');
        $("#btnChange-dependents").addClass('btn-warning');
    });*/

    $(document).on('change', "#form_guardian_dependent :input", function () {
        // $("#btnChange-dependents").html('Save Changes');
        $("#btnChange-ADDGuardianmemberNew").removeClass('disabled');
        // $("#btnChange-dependents").css('font-size', '.8rem');
        //  $("#btnChange-dependents").removeClass('btn-primary');
        //  $("#btnChange-dependents").addClass('btn-warning');
    });

    $(document).on('change', "#form_medical_dependent :input", function () {
        // $("#btnChange-dependents").html('Save Changes');
        $("#btnChange-dependents-medical").removeClass('disabled');
        // $("#btnChange-dependents").css('font-size', '.8rem');
        //  $("#btnChange-dependents").removeClass('btn-primary');
        //  $("#btnChange-dependents").addClass('btn-warning');
    });

    $("#form-beneficiaries :input").change(function () {
        $("#btnChange-beneficiaries").html('Save your changes');
        $("#btnChange-beneficiaries").removeClass('disabled');
        $("#btnChange-beneficiaries").css('font-size', '.8rem');
        $("#btnChange-beneficiaries").removeClass('btn-primary');
        $("#btnChange-beneficiaries").addClass('btn-warning');
    });


    $(document).on('change', '#form-pets :input', function () {
        if (!$(this).hasClass('change_trigger_disabled')) {

            $("#btnChange-pet").html('Save your changes');
            $("#btnChange-pet").removeClass('disabled');
            $("#btnChange-pet").css('font-size', '.8rem');
            $("#btnChange-pet").removeClass('btn-primary');
            $("#btnChange-pet").addClass('btn-warning');
        }
    });

    $("#form-work :input").change(function () {
        $("#btnChange-work").html('Save your changes');
        $("#btnChange-work").removeClass('disabled');
        $("#btnChange-work").css('font-size', '.8rem');
        $("#btnChange-work").removeClass('btn-primary');
        $("#btnChange-work").addClass('btn-warning');
    });
    $("#form-education :input").change(function () {
        $("#btnChange-education").html('Save your changes');
        $("#btnChange-education").removeClass('disabled');
        $("#btnChange-education").css('font-size', '.8rem');
        $("#btnChange-education").removeClass('btn-primary');
        $("#btnChange-education").addClass('btn-warning');
    });
    $("#form-military :input").change(function () {
        $("#btnChange-military").html('Save your changes');
        $("#btnChange-military").removeClass('disabled');
        $("#btnChange-military").css('font-size', '.8rem');
        $("#btnChange-military").removeClass('btn-primary');
        $("#btnChange-military").addClass('btn-warning');
    });
    $("#form-volunteer :input").change(function () {
        $("#btnChange-volunteer").html('Save your changes');
        $("#btnChange-volunteer").removeClass('disabled');
        $("#btnChange-volunteer").css('font-size', '.8rem');
        $("#btnChange-volunteer").removeClass('btn-primary');
        $("#btnChange-volunteer").addClass('btn-warning');
    });
    $("#form-banking :input").change(function () {
        $("#btnChange-banking").html('Save your changes');
        $("#btnChange-banking").removeClass('disabled');
        $("#btnChange-banking").css('font-size', '.8rem');
        $("#btnChange-banking").removeClass('btn-primary');
        $("#btnChange-banking").addClass('btn-warning');
    });
    $("#form-property :input").change(function () {
        $("#btnChange-property").html('Save your changes');
        $("#btnChange-property").removeClass('disabled');
        $("#btnChange-property").css('font-size', '.8rem');
        $("#btnChange-property").removeClass('btn-primary');
        $("#btnChange-property").addClass('btn-warning');
    });
    $("#form-asset :input").change(function () {
        $("#btnChange-asset").html('Save your changes');
        $("#btnChange-asset").removeClass('disabled');
        $("#btnChange-asset").css('font-size', '.8rem');
        $("#btnChange-asset").removeClass('btn-primary');
        $("#btnChange-asset").addClass('btn-warning');
    });
    $("#form-retirement :input").change(function () {
        $("#btnChange-retirement").html('Save your changes');
        $("#btnChange-retirement").removeClass('disabled');
        $("#btnChange-retirement").css('font-size', '.8rem');
        $("#btnChange-retirement").removeClass('btn-primary');
        $("#btnChange-retirement").addClass('btn-warning');
    });
    $("#form-tax :input").change(function () {
        $("#btnChange-tax").html('Save your changes');
        $("#btnChange-tax").removeClass('disabled');
        $("#btnChange-tax").css('font-size', '.8rem');
        $("#btnChange-tax").removeClass('btn-primary');
        $("#btnChange-tax").addClass('btn-warning');
    });
    $("#form-business :input").change(function () {
        $("#btnChange-business").html('Save your changes');
        $("#btnChange-business").removeClass('disabled');
        $("#btnChange-business").css('font-size', '.8rem');
        $("#btnChange-business").removeClass('btn-primary');
        $("#btnChange-business").addClass('btn-warning');
    });
    $("#form-health :input").change(function () {
        $("#btnChange-health").html('Save your changes');
        $("#btnChange-health").removeClass('disabled');
        $("#btnChange-health").css('font-size', '.8rem');
        $("#btnChange-health").removeClass('btn-primary');
        $("#btnChange-health").addClass('btn-warning');
    });
    $("#form-dental :input").change(function () {
        $("#btnChange-dental").html('Save your changes');
        $("#btnChange-dental").removeClass('disabled');
        $("#btnChange-dental").css('font-size', '.8rem');
        $("#btnChange-dental").removeClass('btn-primary');
        $("#btnChange-dental").addClass('btn-warning');
    });
    $("#form-longTermCare :input").change(function () {
        $("#btnChange-longTermCare").html('Save your changes');
        $("#btnChange-longTermCare").removeClass('disabled');
        $("#btnChange-longTermCare").css('font-size', '.8rem');
        $("#btnChange-longTermCare").removeClass('btn-primary');
        $("#btnChange-longTermCare").addClass('btn-warning');
    });


    $(document).on('click', '#addNewMemberID1 #btnChange-estate', function () {
        $("#addNewMemberID1 #btnChange-estate").html('Update');
        $("#addNewMemberID1 #btnChange-estate").css('font-size', '.64rem');
        $("#addNewMemberID1 #btnChange-estate").addClass('disabled');
        $("#addNewMemberID1 #btnChange-estate").removeClass('btn-warning');
        $("#addNewMemberID1 #btnChange-estate").addClass('btn-primary');
    });

    $("#btnChange-estate").click(function () {
        $("#btnChange-estate").html('Update');
        $("#btnChange-estate").css('font-size', '.64rem');
        $("#btnChange-estate").addClass('disabled');
        $("#btnChange-estate").removeClass('btn-warning');
        $("#btnChange-estate").addClass('btn-primary');

        $("#btnChangeNext-estate").html('Next');
        $("#btnChangeNext-estate").css('font-size', '.64rem');
        // $("#btnChangeNext-estate").addClass('disabled');
        $("#btnChangeNext-estate").removeClass('btn-warning');
        $("#btnChangeNext-estate").addClass('btn-primary');
    });
    $("#btnChangeNext-estate").click(function () {
        $("#btnChange-estate").html('Update');
        $("#btnChange-estate").css('font-size', '.64rem');
        $("#btnChange-estate").addClass('disabled');
        $("#btnChange-estate").removeClass('btn-warning');
        $("#btnChange-estate").addClass('btn-primary');

        $("#btnChangeNext-estate").html('Next');
        $("#btnChangeNext-estate").css('font-size', '.64rem');
        // $("#btnChangeNext-estate").addClass('disabled');
        $("#btnChangeNext-estate").removeClass('btn-warning');
        $("#btnChangeNext-estate").addClass('btn-primary');
    });

    $(document).on('click', '#addNewMemberID1 #btnChange-profile', function () {
        $("#btnChange-profile").html('Update');
        $("#btnChange-profile").css('font-size', '.64rem');
        $("#btnChange-profile").addClass('disabled');
        $("#btnChange-profile").removeClass('btn-warning');
        $("#btnChange-profile").addClass('btn-primary');
    });

    $("#btnChange-profile").click(function () {
        $("#btnChange-profile").html('Update');
        $("#btnChange-profile").css('font-size', '.64rem');
        $("#btnChange-profile").addClass('disabled');
        $("#btnChange-profile").removeClass('btn-warning');
        $("#btnChange-profile").addClass('btn-primary');

        $("#btnChangeNext-profile").html('Next');
        $("#btnChangeNext-profile").css('font-size', '.64rem');
        // $("#btnChangeNext-profile").addClass('disabled');
        $("#btnChangeNext-profile").removeClass('btn-warning');
        $("#btnChangeNext-profile").addClass('btn-primary');
        // formDidChange = !formDidChange;
    });
    $("#btnChangeNext-profile").click(function () {
        $("#btnChangeNext-profile").html('Next');
        $("#btnChangeNext-profile").css('font-size', '.64rem');
        // $("#btnChangeNext-profile").addClass('disabled');
        $("#btnChangeNext-profile").removeClass('btn-warning');
        $("#btnChangeNext-profile").addClass('btn-primary');
        // formDidChange = !formDidChange;

        $("#btnChange-profile").html('Update');
        $("#btnChange-profile").css('font-size', '.64rem');
        $("#btnChange-profile").addClass('disabled');
        $("#btnChange-profile").removeClass('btn-warning');
        $("#btnChange-profile").addClass('btn-primary');


    });
    $("#btnChange-erContacts").click(function () {
        $("#btnChange-erContacts").html('Update');
        $("#btnChange-erContacts").css('font-size', '.64rem');
        $("#btnChange-erContacts").addClass('disabled');
        $("#btnChange-erContacts").removeClass('btn-warning');
        $("#btnChange-erContacts").addClass('btn-primary');

        $("#btnChangeNext-erContacts").html('Next');
        $("#btnChangeNext-erContacts").css('font-size', '.64rem');
        // $("#btnChangeNext-erContacts").addClass('disabled');
        $("#btnChangeNext-erContacts").removeClass('btn-warning');
        $("#btnChangeNext-erContacts").addClass('btn-primary');
    });
    $("#btnChangeNext-erContacts").click(function () {
        $("#btnChange-erContacts").html('Update');
        $("#btnChange-erContacts").css('font-size', '.64rem');
        $("#btnChange-erContacts").addClass('disabled');
        $("#btnChange-erContacts").removeClass('btn-warning');
        $("#btnChange-erContacts").addClass('btn-primary');

        $("#btnChangeNext-erContacts").html('Next');
        $("#btnChangeNext-erContacts").css('font-size', '.64rem');
        // $("#btnChangeNext-erContacts").addClass('disabled');
        $("#btnChangeNext-erContacts").removeClass('btn-warning');
        $("#btnChangeNext-erContacts").addClass('btn-primary');
    });

    $(document).on('click', '#addNewMemberID1 #btnChange-maritalStatus', function () {
        $("#addNewMemberID1 #btnChange-maritalStatus").html('Update');
        $("#addNewMemberID1 #btnChange-maritalStatus").css('font-size', '.64rem');
        $("#addNewMemberID1 #btnChange-maritalStatus").addClass('disabled');
        $("#addNewMemberID1 #btnChange-maritalStatus").removeClass('btn-warning');
        $("#addNewMemberID1 #btnChange-maritalStatus").addClass('btn-primary');
    });

    $("#btnChange-maritalStatus").click(function () {
        $("#btnChange-maritalStatus").html('Update');
        $("#btnChange-maritalStatus").css('font-size', '.64rem');
        $("#btnChange-maritalStatus").addClass('disabled');
        $("#btnChange-maritalStatus").removeClass('btn-warning');
        $("#btnChange-maritalStatus").addClass('btn-primary');

        $("#btnChangeNext-maritalStatus").html('Next');
        $("#btnChangeNext-maritalStatus").css('font-size', '.64rem');
        // $("#btnChangeNext-maritalStatus").addClass('disabled');
        $("#btnChangeNext-maritalStatus").removeClass('btn-warning');
        $("#btnChangeNext-maritalStatus").addClass('btn-primary');
    });
    $("#btnChangeNext-maritalStatus").click(function () {
        $("#btnChange-maritalStatus").html('Update');
        $("#btnChange-maritalStatus").css('font-size', '.64rem');
        $("#btnChange-maritalStatus").addClass('disabled');
        $("#btnChange-maritalStatus").removeClass('btn-warning');
        $("#btnChange-maritalStatus").addClass('btn-primary');

        $("#btnChangeNext-maritalStatus").html('Next');
        $("#btnChangeNext-maritalStatus").css('font-size', '.64rem');
        // $("#btnChangeNext-maritalStatus").addClass('disabled');
        $("#btnChangeNext-maritalStatus").removeClass('btn-warning');
        $("#btnChangeNext-maritalStatus").addClass('btn-primary');
    });
    $("#btnChange-dependents").click(function () {
        $("#btnChange-dependents").html('Update');
        $("#btnChange-dependents").css('font-size', '.64rem');
        $("#btnChange-dependents").addClass('disabled');
        $("#btnChange-dependents").removeClass('btn-warning');
        $("#btnChange-dependents").addClass('btn-primary');
    });
    $("#btnChange-beneficiaries").click(function () {
        $("#btnChange-beneficiaries").html('Update');
        $("#btnChange-beneficiaries").css('font-size', '.64rem');
        $("#btnChange-beneficiaries").addClass('disabled');
        $("#btnChange-beneficiaries").removeClass('btn-warning');
        $("#btnChange-beneficiaries").addClass('btn-primary');
    });
    $(document).on('click', '#btnChange-pet', function () {
        $("#btnChange-pet").html('Update');
        $("#btnChange-pet").css('font-size', '.64rem');
        $("#btnChange-pet").addClass('disabled');
        $("#btnChange-pet").removeClass('btn-warning');
        $("#btnChange-pet").addClass('btn-primary');
    });
    $("#btnChange-work").click(function () {
        $("#btnChange-work").html('Update');
        $("#btnChange-work").css('font-size', '.64rem');
        $("#btnChange-work").addClass('disabled');
        $("#btnChange-work").removeClass('btn-warning');
        $("#btnChange-work").addClass('btn-primary');
    });
    $("#btnChange-education").click(function () {
        $("#btnChange-education").html('Update');
        $("#btnChange-education").css('font-size', '.64rem');
        $("#btnChange-education").addClass('disabled');
        $("#btnChange-education").removeClass('btn-warning');
        $("#btnChange-education").addClass('btn-primary');
    });
    $("#btnChange-military").click(function () {
        $("#btnChange-military").html('Update');
        $("#btnChange-military").css('font-size', '.64rem');
        $("#btnChange-military").addClass('disabled');
        $("#btnChange-military").removeClass('btn-warning');
        $("#btnChange-military").addClass('btn-primary');
    });
    $("#btnChange-volunteer").click(function () {
        $("#btnChange-volunteer").html('Update');
        $("#btnChange-volunteer").css('font-size', '.64rem');
        $("#btnChange-volunteer").addClass('disabled');
        $("#btnChange-volunteer").removeClass('btn-warning');
        $("#btnChange-volunteer").addClass('btn-primary');
    });

    $("#btnChange-banking").click(function () {
        $("#btnChange-banking").html('Update');
        $("#btnChange-banking").css('font-size', '.64rem');
        $("#btnChange-banking").addClass('disabled');
        $("#btnChange-banking").removeClass('btn-warning');
        $("#btnChange-banking").addClass('btn-primary');
    });
    $("#btnChange-property").click(function () {
        $("#btnChange-property").html('Update');
        $("#btnChange-property").css('font-size', '.64rem');
        $("#btnChange-property").addClass('disabled');
        $("#btnChange-property").removeClass('btn-warning');
        $("#btnChange-property").addClass('btn-primary');
    });
    $("#btnChange-asset").click(function () {
        $("#btnChange-asset").html('Update');
        $("#btnChange-asset").css('font-size', '.64rem');
        $("#btnChange-asset").addClass('disabled');
        $("#btnChange-asset").removeClass('btn-warning');
        $("#btnChange-asset").addClass('btn-primary');
    });
    $("#btnChange-retirement").click(function () {
        $("#btnChange-retirement").html('Update');
        $("#btnChange-retirement").css('font-size', '.64rem');
        $("#btnChange-retirement").addClass('disabled');
        $("#btnChange-retirement").removeClass('btn-warning');
        $("#btnChange-retirement").addClass('btn-primary');
    });
    $("#btnChange-tax").click(function () {
        $("#btnChange-tax").html('Update');
        $("#btnChange-tax").css('font-size', '.64rem');
        $("#btnChange-tax").addClass('disabled');
        $("#btnChange-tax").removeClass('btn-warning');
        $("#btnChange-tax").addClass('btn-primary');
    });
    $("#btnChange-business").click(function () {
        $("#btnChange-business").html('Update');
        $("#btnChange-business").css('font-size', '.64rem');
        $("#btnChange-business").addClass('disabled');
        $("#btnChange-business").removeClass('btn-warning');
        $("#btnChange-business").addClass('btn-primary');
    });
    $("#btnChange-health").click(function () {
        $("#btnChange-health").html('Update');
        $("#btnChange-health").css('font-size', '.64rem');
        $("#btnChange-health").addClass('disabled');
        $("#btnChange-health").removeClass('btn-warning');
        $("#btnChange-health").addClass('btn-primary');
    });
    $("#btnChange-dental").click(function () {
        $("#btnChange-dental").html('Update');
        $("#btnChange-dental").css('font-size', '.64rem');
        $("#btnChange-dental").addClass('disabled');
        $("#btnChange-dental").removeClass('btn-warning');
        $("#btnChange-dental").addClass('btn-primary');
    });
    $("#btnChange-longTermCare").click(function () {
        $("#btnChange-longTermCare").html('Update');
        $("#btnChange-longTermCare").css('font-size', '.64rem');
        $("#btnChange-longTermCare").addClass('disabled');
        $("#btnChange-longTermCare").removeClass('btn-warning');
        $("#btnChange-longTermCare").addClass('btn-primary');
    });

//
    <!-- ONCHANGE / KEYUP DETECTION -->
// ============?

// ============?
});


