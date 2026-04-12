<style>
    .footer-special-color {
        background-color: rgb(182, 184, 189);
    }

    .footer_border {
        height: 6px;
        background: black;
    }

</style>

<footer class="page-footer footer-special-color xelegant-color xcenter-on-small-only px-0 pb-3 mt-0">
    <!--Call to action-->
    <div class="call-to-action text-center pt-3">
        <a href=""><h4>

            </h4></a>

    </div>
    <!--/.Call to action-->

    <!--<hr>-->
    @php
        //    include 'footer_flex_content.php';
    @endphp
    @include('project.layouts.footer_flex_content')


</footer>
<!--/.Footer-->
<!-- SCRIPTS -->
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ Config::get('constants.MDB.SITE_MDB_URL') }}js/mdb.min.js"></script>
<script>
    var USER_SWITCH_TYPE = {{Auth::check()  ? auth()->user()->user_access : 0}}; // 0 - normal estate 1 -kid
    var TAB_ESTATE_MEMBER = '{{Config::get('constants.TAB_ESTATE_MEMBER')}}';
    var TAB_KID_MEMBER = '{{Config::get('constants.TAB_KID_MEMBER')}}';

    var SITE_BASE_URL = '{{Config::get('constants.SITE_BASE_URL')}}';
    var SITE_INDEX_URL = '{{Config::get('constants.SITE_INDEX_URL')}}';
    var SITE_LOGOUT_URL = '{{Config::get('constants.SITE_LOGOUT_URL')}}';
    var SITE_LOGIN_URL = '{{Config::get('constants.SITE_LOGIN_URL')}}';
    var DOCUMENT_URL = '{{Config::get('constants.DOCUMENT_URL')}}';

    var MESSAGE_ATTACHMENT_URL = '{{Config::get('constants.MESSAGE_ATTACHMENT_URL')}}';
    var MEMBER_IMG_URL = '{{Config::get('constants.MEMBER_IMG_URL')}}';
    var DEPENDENT_PROFILE_IMG_URL = '{{Config::get('constants.DEPENDENT_PROFILE_IMG_URL')}}';
    var DEPENDENT_GUARDIAN_IMG_URL = '{{Config::get('constants.DEPENDENT_GUARDIAN_IMG_URL')}}';
    var DEPENDENT_MEDICAL_IMG_URL = '{{Config::get('constants.DEPENDENT_MEDICAL_IMG_URL')}}';
    var DEPENDENT_SCHOOL_IMG_URL = '{{Config::get('constants.DEPENDENT_SCHOOL_IMG_URL')}}';
    var PET_IMG_URL = '{{Config::get('constants.PET_IMG_URL')}}';
    var DEFAULT_AVATAR_IMAGE_URL = '{{Config::get('constants.DEFAULT_AVATAR_IMAGE_URL')}}';
    var PROJECT_IMAGE_URL = '{{Config::get('constants.PROJECT_IMAGE_URL')}}';
    var PROJECT_LOGO_IMAGE_URL = '{{Config::get('constants.PROJECT_LOGO_IMAGE_URL')}}';
    var SITE_IDLE_TIME_MINUTES = '{{Config::get('constants.SITE_IDLE_TIME_MINUTES')}}';

    var tab_id = '{{Route::currentRouteName()}}';


    var PET_IMG_FOLDER = '{{Config::get('constants.PET_IMG_FOLDER')}}';
    var ESTATE_IMG_FOLDER = '{{Config::get('constants.ESTATE_IMG_FOLDER')}}';
    var MEMBER_IMG_FOLDER = '{{Config::get('constants.MEMBER_IMG_FOLDER')}}';
    var PROFILE_IMG_FOLDER = '{{Config::get('constants.PROFILE_IMG_FOLDER')}}';

    var SITE_IMG_FOLDER = '{{Config::get('constants.SITE_IMG_FOLDER')}}';


    {{--  var TAB_URLS_ALL = {{json_encode($helper->get_tab_urls_all())}}--}}


</script>
<script>
    $("#modalYT").on('hidden.bs.modal', function (e) {
        $("#modalYT iframe").attr("src", $("#modalYT iframe").attr("src"));
    });

    $("#taskShowModal1").on('hidden.bs.modal', function (e) {
        $("#taskShowModal1 iframe").attr("src", $("#taskShowModal1 iframe").attr("src"));
    });

    $("#taskShowModal2").on('hidden.bs.modal', function (e) {
        $("#taskShowModal2 iframe").attr("src", $("#taskShowModal2 iframe").attr("src"));
    });

    $("#affiliate_eMoney").on('hidden.bs.modal', function (e) {
        $("#affiliate_eMoney iframe").attr("src", $("#affiliate_eMoney iframe").attr("src"));
    });
</script>
<script>

    // SideNav Initialization
    $(".button-collapse").sideNav();

</script>


<script>
    $('#aboutMe').on('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = $(event.relatedTarget);

        // the modal
        var modal = $(this);

        //show tab
        modal.find('[href="' + button.attr("href") + '"]').tab('show');
    });
</script>

<script>
    $('#scrollSignUpBtn').hide();
    $(window).scroll(function () { // when the page is scrolled run this
        if ($(this).scrollTop() != 0) { // if you're NOT at the top
            $('#scrollSignUpBtn').fadeIn("fast"); // fade in
        } else { // else
            $('#scrollSignUpBtn').fadeOut("fast"); // fade out
        }
    });

    $('#scrollSignUpBtn').click(function () { // when the button is clicked
        $('body,html').animate({scrollTop: 0}, 500); // return to the top with a nice animation
    });
</script>

<script>
    // Tooltips Initialization
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<!-- =========== O V E R V I E W OR ADDING NEW MEMBERS?=============== -->

<!-- ========== C A R D   B O R D E R S :  My Profile, My Estate ============= -->
<script>

    function aboutMe() {
        aboutMeLink.classList.add("mystyle");
        myFamilyLink.classList.remove("mystyle");
        WorkEducationLink.classList.remove("mystyle");
    }

    function myFamily() {
        myFamilyLink.classList.add("mystyle");
        aboutMeLink.classList.remove("mystyle");
        WorkEducationLink.classList.remove("mystyle");
    }

    function workEducation() {
        WorkEducationLink.classList.add("mystyle");
        aboutMeLink.classList.remove("mystyle");
        myFamilyLink.classList.remove("mystyle");
    }

    function financeRetire() {
        financeRetireLink.classList.add("mystyle");
        healthOngoingCareLink.classList.remove("mystyle");
        myWishesLink.classList.remove("mystyle");
    }

    function healthOngoingCare() {
        healthOngoingCareLink.classList.add("mystyle");
        financeRetireLink.classList.remove("mystyle");
        myWishesLink.classList.remove("mystyle");
    }

    function myWishes() {
        myWishesLink.classList.add("mystyle");
        financeRetireLink.classList.remove("mystyle");
        healthOngoingCareLink.classList.remove("mystyle");
    }

    $(document).ready(function () {
        // add a function to this
        var aboutMeLink = document.getElementById("aboutMeLink");
        var myFamilyLink = document.getElementById("myFamilyLink");
        var WorkEducationLink = document.getElementById("WorkEducationLink");
        if (tab_id == 'estate_messages') aboutMeLink.classList.add("mystyle");
        var financeRetireLink = document.getElementById("financeRetireLink");
        var healthOngoingCareLink = document.getElementById("healthOngoingCareLink");
        var myWishesLink = document.getElementById("myWishesLink");
        if (tab_id == 'estate_profile') financeRetireLink.classList.add("mystyle");


    });
</script>
<!-- ========== /.C A R D   B O R D E R S :  My Profile, My Estate ============= -->

<!-- ==== C L O S E    C A R D   F U N C T I O N ===== -->
<script>
    function hide(target) {
        document.getElementById(target).style.display = 'none';
    }

    function toggle(t) {
        if (t.childNodes[0].innerHTML == "Hide Dashboard") {
            t.childNodes[0].innerHTML = "Show Dashboard";
        } else {
            t.childNodes[0].innerHTML = "Hide Dashboard";
        }
    }

</script>
<!-- ==== C L O S E    C A R D   F U N C T I O N ===== -->


<script>


    $(document).ready(function () {

        //$('.myProfileForm').hide();
        $('.showMyFamily').show();

        $(".toggle").click(function () {

            $(".myProfileForm").not($(this).next()).hide();
            $("div[rel='profile_" + $(this).attr("profile") + "']").toggle();

        });

        //$('.myEstateForm').hide();
        $('.showMyFinance').show();

        $(".toggleTwo").click(function () {

            $(".myEstateForm").not($(this).next()).hide();

            $("div[rel='estate_" + $(this).attr("estate") + "']").toggle();
        });

    });

</script>
<!-- ============== T E S T   M Y   F A M I L Y ============ -->
<script>


    // My Profile
    function aboutMeActive() {
        document.getElementById('aboutMeCard').style.borderColor = 'yellowgreen';
        document.getElementById('myFamilyCard').style.borderColor = 'transparent';
        document.getElementById('workEducationCard').style.borderColor = 'transparent';
    }

    function myFamilyActive() {

        document.getElementById('myFamily').style.display = 'block';
        document.getElementById('myWorkEducation').style.display = 'none';
        document.getElementById('myFamilyCard').style.borderColor = 'yellowgreen';
        document.getElementById('aboutMeCard').style.borderColor = 'transparent';
        document.getElementById('workEducationCard').style.borderColor = 'transparent';
    }

    function workEducationActive() {
        document.getElementById('myWorkEducation').style.display = 'block';
        document.getElementById('myFamily').style.display = 'none';
        document.getElementById('workEducationCard').style.borderColor = 'yellowgreen';
        document.getElementById('aboutMeCard').style.borderColor = 'transparent';
        document.getElementById('myFamilyCard').style.borderColor = 'transparent';
    }


</script>


<!-- Next Btn on Main forms -- opens Nav tabs (panels/pills) when combined with correct href location -->
<script>
    $('.tab-link').on('click', function (event) {
        // Prevent url change
        event.preventDefault();

        // `this` is the clicked <a> tag
        var target = $('[data-toggle="tab"][href="' + this.hash + '"]');

        // opening tab
        target.trigger('click');
    });
</script>

<!-- ONCHANGE / KEYUP DETECTION -->


<!-- ============== Messaging System ====================-->
<script>

    /*$("#list-dashboard-list").click(function () {
        $("#my-card-background").css('background', 'rgb(58, 113, 183)');
    });
    $("#list-messages-list").click(function () {
        $("#my-card-background").css('background', 'rgb(182, 184, 189)');

        // this will need to be set up to run for every memId-? instance -- research - hire help
        if ($('#memID-1').html() == 0) {
            $('#memID-1').hide();
        }
        if ($('#memID-2').html() == 0) {
            $('#memID-2').hide();
        }
        if ($('#memID-3').html() == 0) {
            $('#memID-3').hide();
        }
        if ($('#memID-4').html() == 0) {
            $('#memID-4').hide();
        }
        if ($('#memID-5').html() == 0) {
            $('#memID-5').hide();
        }
        if ($('#memID-6').html() == 0) {
            $('#memID-6').hide();
        }
        if ($('#memID-7').html() == 0) {
            $('#memID-7').hide();
        }
        if ($('#memID-8').html() == 0) {
            $('#memID-8').hide();
        }
    });
    $("#list-profile-list").click(function () {
        $("#my-card-background").css('background', 'rgb(58, 113, 183)');
    });
    $("#list-myEstate-list").click(function () {
        $("#my-card-background").css('background', 'rgb(58, 113, 183)');
    });
    $("#list-members-list").click(function () {
        $("#my-card-background").css('background', 'rgb(58, 113, 183)');
    });
    $("#list-documents-list").click(function () {
        $("#my-card-background").css('background', 'rgb(58, 113, 183)');
    });
    $("#list-webspot-list").click(function () {
        $("#my-card-background").css('background', 'rgb(255,255,255)');
    });
    $("#list-otherEstates-list").click(function () {
        $("#my-card-background").css('background', 'rgb(58, 113, 183)');
    });
    $("#list-grow-list").click(function () {
        $("#my-card-background").css('background', 'rgb(58, 113, 183)');
    });*/

    if (tab_id == 'estate') {
        $("#my-card-background").css('background', 'rgb(182, 184, 189)');
    }

</script>


<!-- //END ...Dummy Search Test -->


<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $(".myTable .row").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<!-- ============== END Messaging System ====================-->

<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
//   toast-bottom-full-width, toast-top-right, toast-bottom-right, toast-bottom-left, Resource: https://codepen.io/nikolapro/pen/JGGQJQ
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 1000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>

<script>

</script>


<script>

    function ownerGender(gender) {
        if (document.getElementById("describeGender-owner").checked) {
            document.getElementById("gender-owner").value = "";
            document.getElementById("gender-owner").placeholder = "Preferred description";
        } else {
            document.getElementById("gender-owner").value = gender;
        }
    }

</script>

<script>
    $(function () {
        $(".married-details").hide();
        $("#maritalStatus-owner").change(function () {
            var val = $(this).val();
            if (val !== "married") {
                $(".married-details").hide();
            } else {
                $(".married-details").show();
            }
        })
    })
</script>

<script>
    $(document).ready(function () {
        var max_fields = 6; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="form-inline"><input type="email" class="form-control col-lg-8 mb-3 mr-2" name="mytext[]" placeholder="Alternate email"/><a href="#" class="remove_field pb-3"> Remove</a></div>'); //add input box
            }
        });

        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>

<script>
    $(document).ready(function () {
        var max_fields = 6; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap_phone"); //Fields wrapper
        var add_button = $(".add_field_button_phone"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="form-inline"><input type="text" class="form-control col-lg-8 mb-3 mr-2" name="mytext[]" placeholder="Alternate phone"/><a href="#" class="remove_field pb-3"> Remove</a></div>'); //add input box
            }
        });

        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>


<!-- =================================
    MEMBERS TAB VIEW & FUNCTIONALITY
====================================-->
<script>
    function switchVisible() {
        if (document.getElementById('Div1')) {

            if (document.getElementById('Div1').style.display == 'none') {
                document.getElementById('Div1').style.display = 'block';
                document.getElementById('Div2').style.display = 'none';
            } else {
                document.getElementById('Div1').style.display = 'none';
                document.getElementById('Div2').style.display = 'block';
            }
        }
    }
</script>
<!-- =================================
    / MEMBERS TAB VIEW & FUNCTIONALITY
====================================-->


<!-- login signin simulation -->
<script>


    $(document).ready(function () {
        $('.myLogout').on('click', function () {
            // window.location = "http://localhost/mdb/a-MDB4.4.5MEP/project/home/index.php";
            $(".navLoggedOut").show();
            $(".navLoggedIn").hide();

        });
        $('.myLogout').on('click', function () {
            // window.location = "../home/index.php";
            // $(".navLoggedOut").show();
            // $(".navLoggedIn").hide();

        });
    });


</script>
<!-- /login signin simulation -->

<!-- login/register/welcom -->
<script>
    $("#signIn").click(function () {
        $(".mpeRegisterForm").hide();
        $('.mpeLoginForm').show();
    });

    $("#signUp").click(function () {
        $(".mpeRegisterForm").show();
        $('.mpeLoginForm').hide();
    });

    $("#signUpNav").click(function () {
        $(".mpeRegisterForm").show();
        $('.mpeLoginForm').hide();
    });

    $("#signed-in").click(function () {
        $(".welcomeLoginMsg").show();
        $(".mpeRegisterForm").hide();
        $('.mpeLoginForm').hide();
        $('.loggedIn').css('visibility', 'visible');
        $('.loggedOut').css('display', 'none');
    });

    $("#registeredPg1").click(function () {
        $(".welcomeMsg").hide();
        $(".mpeRegisterForm").hide();
        $(".mpeRegisterFormPg2").show();
        $('.mpeLoginForm').hide();
        // $('.loggedIn').css('visibility','visible');
        // $('.loggedOut').css('display','none');
    });

    $("#registeredPg2").click(function () {
        $(".welcomeMsg").show();
        $(".mpeRegisterFormPg2").hide();
        $('.mpeLoginForm').hide();
        $('.loggedIn').css('visibility', 'visible');
        $('.loggedOut').css('display', 'none');
    });

    $("#profileDashboard").click(function () {
        $(".welcomeMsg").show();
        $(".welcomeLoginMsg").hide();
    });

    $("#hideProfileSetup").click(function () {
        $(".welcomeMsg").hide();
        $(".welcomeLoginMsg").show();
        // $( ".mpeRegisterForm" ).hide();
    });

    $(".signUpNav").click(function () {
        $(".mpeRegisterForm").show();
        $('.mpeLoginForm').hide();
    });


</script>
<!-- /END login/register/welcom -->

<!-- Data Picker Initialization -->
<script>
    $('.datepicker').pickadate({
        selectYears: 100,
        min: new Date(1902, 3, 20),
        max: new Date(2020, 7, 14),
        format: 'mm/dd/yyyy'
    });
</script>

<!-- Profile Stepper -->
<script>


    // Vertial Stepper
    $(document).ready(function () {
        var navListItems = $('div.setup-panel-3 div a'),
            allWells = $('.setup-content-3'),
            allNextBtn = $('.nextBtn-3'),
            allPrevBtn = $('.prevBtn-3');

        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-info').addClass('btn-pink');
                $item.addClass('btn-info');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allPrevBtn.click(function () {
            var curStep = $(this).closest(".setup-content-3"),
                curStepBtn = curStep.attr("id"),
                prevStepSteps = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

            prevStepSteps.removeAttr('disabled').trigger('click');
        });

        allNextBtn.click(function () {
            var curStep = $(this).closest(".setup-content-3"),
                curStepBtn = curStep.attr("id"),
                nextStepSteps = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid)
                nextStepSteps.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel-3 div a.btn-info').trigger('click');
    });
</script>
<!-- /Profile Stepper -->


<script>
    //     window.addEventListener("hashchange", function () {
    //     window.scrollTo(window.scrollX, window.scrollY - 100);
    // });
    // The function actually applying the offset
    function offsetAnchor() {
        if (location.hash.length !== 0) {
            window.scrollTo(window.scrollX, window.scrollY - 60);
        }
    }

    // Captures click events of all <a> elements with href starting with #
    $(document).on('click', 'a[href^="#"]', function (event) {
        // Click events are captured before hashchanges. Timeout
        // causes offsetAnchor to be called after the page jump.
        window.setTimeout(function () {
            offsetAnchor();
        }, 0);
    });

    // Set the offset when entering page with hash present in the url
    window.setTimeout(offsetAnchor, 0);
</script>

<script>
    $(function () {
        $(".sticky").sticky({
            topSpacing: 0,
            zIndex: 1,
            // stopper: ".dashboard"
            stopper: "#stopProfile"
        });
    });
</script>
<!-- <script>
$(document).foundation();
</script> -->
<script>
    $("#trash1").one("click", function () {
        $('#yourElement').addClass('animated bounceOutLeft');
    });
</script>

<!-- ======================================================================================================== -->

<!--                                 S H A R I N G    S E C T I O N                                                -->

<!-- ======================================================================================================== -->


<!-- script for btn-link-styles Located in mem/card/sharedInfoLink -->
<script>
    // TEST
    $(document).ready(function () {
        $(".showAll-test").click(function () {
            $('.showSubCat1-test').removeClass("show");
            $('.showSubCat1-test').toggleClass("show");
            $('#showBtn-test').hide();
            $('#hideBtn-test').show();
        });
        $(".hideAll-test").click(function () {
            $('.showSubCat1-test').removeClass("show");
            $('#hideBtn-test').hide();
            $('#showBtn-test').show();
        });

// PROFILE
        $(".showAll-profile").click(function () {
            $('.showSubCat1-profile').removeClass("show");
            $('.showSubCat1-profile').toggleClass("show");
            $('#showBtn-profile').hide();
            $('#hideBtn-profile').show();
        });
        $(".hideAll-profile").click(function () {
            $('.showSubCat1-profile').removeClass("show");
            $('#hideBtn-profile').hide();
            $('#showBtn-profile').show();
        });

// FAMILY
        $(".showAll-family").click(function () {
            $('.showSubCat1-family').removeClass("show");
            $('.showSubCat1-family').toggleClass("show");
            $('#showBtn-family').hide();
            $('#hideBtn-family').show();
        });
        $(".hideAll-family").click(function () {
            $('.showSubCat1-family').removeClass("show");
            $('#hideBtn-family').hide();
            $('#showBtn-family').show();
        });

// FINANCIAL
        $(".showAll-financial").click(function () {
            $('.showSubCat1-financial').removeClass("show");
            $('.showSubCat1-financial').toggleClass("show");
            $('#showBtn-financial').hide();
            $('#hideBtn-financial').show();
        });
        $(".hideAll-financial").click(function () {
            $('.showSubCat1-financial').removeClass("show");
            $('#hideBtn-financial').hide();
            $('#showBtn-financial').show();
        });

// HEALTH CARE
        $(".showAll-healthCare").click(function () {
            $('.showSubCat1-healthCare').removeClass("show");
            $('.showSubCat1-healthCare').toggleClass("show");
            $('#showBtn-healthCare').hide();
            $('#hideBtn-healthCare').show();
        });
        $(".hideAll-healthCare").click(function () {
            $('.showSubCat1-healthCare').removeClass("show");
            $('#hideBtn-healthCare').hide();
            $('#showBtn-healthCare').show();
        });


// ONGOING CARE
        $(".showAll-ongoingCare").click(function () {
            $('.showSubCat1-ongoingCare').removeClass("show");
            $('.showSubCat1-ongoingCare').toggleClass("show");
            $('#showBtn-ongoingCare').hide();
            $('#hideBtn-ongoingCare').show();
        });
        $(".hideAll-ongoingCare").click(function () {
            $('.showSubCat1-ongoingCare').removeClass("show");
            $('#hideBtn-ongoingCare').hide();
            $('#showBtn-ongoingCare').show();
        });

// PASTE NEXT SECTION directly  above this line
    });
</script>


<!-- counts how many items are being shared with a member -->
<!-- T E S T     S H A R E -->
<script>
    var countShare = function () {
        var p = (($("input:checked.shareOn-test").length / 3) * 100).toFixed(0);
//   $( "#mycount" ).text( n + (n === 1 ? " is" : " are") + " selected" );
        $("#displayShareCount-test").text(p + "% shared");
    };
    countShare();
    $("input[type=checkbox].shareOn-test").on("click", countShare);
</script>

<script>
    $("#shareAllSwitch-test").change(function () {
        $(".shareOn-test").prop('checked', $(this).prop("checked"));
        var allCount = (($("input:checked.shareOn-test").length / 3) * 100).toFixed(0);
        $("#displayShareCount-test").text(allCount + "% shared");
    });
</script>

<!-- P R O F I L E     S H A R E -->
<script>
    var countShare = function () {
        var p = (($("input:checked.shareOn-profile").length / 6) * 100).toFixed(0);
//   $( "#mycount" ).text( n + (n === 1 ? " is" : " are") + " selected" );
        $("#displayShareCount-profile").text(p + "% shared");
    };
    countShare();
    $("input[type=checkbox].shareOn-profile").on("click", countShare);

    $("#shareAllSwitch-profile").change(function () {
        $(".shareOn-profile").prop('checked', $(this).prop("checked"));
        var allCount = (($("input:checked.shareOn-profile").length / 6) * 100).toFixed(0);
        $("#displayShareCount-profile").text(allCount + "% shared");

        if ($('input[type=checkbox].shareOn-profile').prop('checked')) {
            $('#shareOneId1-profile, #shareTwoId1-profile, #shareThreeId1-profile, #shareFourId1-profile, #shareFiveId1-profile, #shareSixId1-profile').removeClass("custom-icon-share");
            $('#shareOneId1-profile, #shareTwoId1-profile, #shareThreeId1-profile, #shareFourId1-profile, #shareFiveId1-profile, #shareSixId1-profile').toggleClass("custom-icon-share");
        } else {
            $('#shareOneId1-profile, #shareTwoId1-profile, #shareThreeId1-profile, #shareFourId1-profile, #shareFiveId1-profile, #shareSixId1-profile').removeClass("custom-icon-share");
        }
    });

    $("#shareOne-profile").click(function () {
        $('#shareOneId1-profile').toggleClass("custom-icon-share");
    });
    $("#shareTwo-profile").click(function () {
        $('#shareTwoId1-profile').toggleClass("custom-icon-share");
    });
    $("#shareThree-profile").click(function () {
        $('#shareThreeId1-profile').toggleClass("custom-icon-share");
    });
    $("#shareFour-profile").click(function () {
        $('#shareFourId1-profile').toggleClass("custom-icon-share");
    });
    $("#shareFive-profile").click(function () {
        $('#shareFiveId1-profile').toggleClass("custom-icon-share");
    });
    $("#shareSix-profile").click(function () {
        $('#shareSixId1-profile').toggleClass("custom-icon-share");
    });
</script>


<!-- F A M I L Y     S H A R E -->
<script>
    var countShare = function () {
        var p = (($("input:checked.shareOn-family").length / 5) * 100).toFixed(0);
//   $( "#mycount" ).text( n + (n === 1 ? " is" : " are") + " selected" );
        $("#displayShareCount-family").text(p + "% shared");
    };
    countShare();
    $("input[type=checkbox].shareOn-family").on("click", countShare);

    $("#shareAllSwitch-family").change(function () {
        $(".shareOn-family").prop('checked', $(this).prop("checked"));
        var allCount = (($("input:checked.shareOn-family").length / 5) * 100).toFixed(0);
        $("#displayShareCount-family").text(allCount + "% shared");

        if ($('input[type=checkbox].shareOn-family').prop('checked')) {
            $('#shareOneId1-family, #shareTwoId1-family, #shareThreeId1-family, #shareFourId1-family, #shareFiveId1-family').removeClass("custom-icon-share");
            $('#shareOneId1-family, #shareTwoId1-family, #shareThreeId1-family, #shareFourId1-family, #shareFiveId1-family').toggleClass("custom-icon-share");
        } else {
            $('#shareOneId1-family, #shareTwoId1-family, #shareThreeId1-family, #shareFourId1-family, #shareFiveId1-family').removeClass("custom-icon-share");
        }
    });

    $("#shareOne-family").click(function () {
        $('#shareOneId1-family').toggleClass("custom-icon-share");
    });
    $("#shareTwo-family").click(function () {
        $('#shareTwoId1-family').toggleClass("custom-icon-share");
    });
    $("#shareThree-family").click(function () {
        $('#shareThreeId1-family').toggleClass("custom-icon-share");
    });
    $("#shareFour-family").click(function () {
        $('#shareFourId1-family').toggleClass("custom-icon-share");
    });
    $("#shareFive-family").click(function () {
        $('#shareFiveId1-family').toggleClass("custom-icon-share");
    });
</script>

<!-- F I N A N C I A L     S H A R E -->
<script>
    var countShare = function () {
        var p = (($("input:checked.shareOn-financial").length / 6) * 100).toFixed(0);
//   $( "#mycount" ).text( n + (n === 1 ? " is" : " are") + " selected" );
        $("#displayShareCount-financial").text(p + "% shared");
    };
    countShare();
    $("input[type=checkbox].shareOn-financial").on("click", countShare);

    $("#shareAllSwitch-financial").change(function () {
        $(".shareOn-financial").prop('checked', $(this).prop("checked"));
        var allCount = (($("input:checked.shareOn-financial").length / 6) * 100).toFixed(0);
        $("#displayShareCount-financial").text(allCount + "% shared");

        if ($('input[type=checkbox].shareOn-financial').prop('checked')) {
            $('#shareOneId1-financial, #shareTwoId1-financial, #shareThreeId1-financial, #shareFourId1-financial, #shareFiveId1-financial, #shareSixId1-financial').removeClass("custom-icon-share");
            $('#shareOneId1-financial, #shareTwoId1-financial, #shareThreeId1-financial, #shareFourId1-financial, #shareFiveId1-financial, #shareSixId1-financial').toggleClass("custom-icon-share");
        } else {
            $('#shareOneId1-financial, #shareTwoId1-financial, #shareThreeId1-financial, #shareFourId1-financial, #shareFiveId1-financial, #shareSixId1-financial').removeClass("custom-icon-share");
        }
    });

    $("#shareOne-financial").click(function () {
        $('#shareOneId1-financial').toggleClass("custom-icon-share");
    });
    $("#shareTwo-financial").click(function () {
        $('#shareTwoId1-financial').toggleClass("custom-icon-share");
    });
    $("#shareThree-financial").click(function () {
        $('#shareThreeId1-financial').toggleClass("custom-icon-share");
    });
    $("#shareFour-financial").click(function () {
        $('#shareFourId1-financial').toggleClass("custom-icon-share");
    });
    $("#shareFive-financial").click(function () {
        $('#shareFiveId1-financial').toggleClass("custom-icon-share");
    });
    $("#shareSix-financial").click(function () {
        $('#shareSixId1-financial').toggleClass("custom-icon-share");
    });
</script>

<!-- H E A L T H   C A R E     S H A R E -->
<script>
    var countShare = function () {
        var p = (($("input:checked.shareOn-healthCare").length / 5) * 100).toFixed(0);
//   $( "#mycount" ).text( n + (n === 1 ? " is" : " are") + " selected" );
        $("#displayShareCount-healthCare").text(p + "% shared");
    };
    countShare();
    $("input[type=checkbox].shareOn-healthCare").on("click", countShare);

    $("#shareAllSwitch-healthCare").change(function () {
        $(".shareOn-healthCare").prop('checked', $(this).prop("checked"));
        var allCount = (($("input:checked.shareOn-healthCare").length / 5) * 100).toFixed(0);
        $("#displayShareCount-healthCare").text(allCount + "% shared");

        if ($('input[type=checkbox].shareOn-healthCare').prop('checked')) {
            $('#shareOneId1-healthCare, #shareTwoId1-healthCare, #shareThreeId1-healthCare, #shareFourId1-healthCare, #shareFiveId1-healthCare').removeClass("custom-icon-share");
            $('#shareOneId1-healthCare, #shareTwoId1-healthCare, #shareThreeId1-healthCare, #shareFourId1-healthCare, #shareFiveId1-healthCare').toggleClass("custom-icon-share");
        } else {
            $('#shareOneId1-healthCare, #shareTwoId1-healthCare, #shareThreeId1-healthCare, #shareFourId1-healthCare, #shareFiveId1-healthCare').removeClass("custom-icon-share");
        }
    });

    $("#shareOne-healthCare").click(function () {
        $('#shareOneId1-healthCare').toggleClass("custom-icon-share");
    });
    $("#shareTwo-healthCare").click(function () {
        $('#shareTwoId1-healthCare').toggleClass("custom-icon-share");
    });
    $("#shareThree-healthCare").click(function () {
        $('#shareThreeId1-healthCare').toggleClass("custom-icon-share");
    });
    $("#shareFour-healthCare").click(function () {
        $('#shareFourId1-healthCare').toggleClass("custom-icon-share");
    });
    $("#shareFive-healthCare").click(function () {
        $('#shareFiveId1-healthCare').toggleClass("custom-icon-share");
    });
</script>

<!-- O N G O I N G  C A R E     S H A R E -->
<script>
    var countShare = function () {
        var p = (($("input:checked.shareOn-ongoingCare").length / 7) * 100).toFixed(0);
//   $( "#mycount" ).text( n + (n === 1 ? " is" : " are") + " selected" );
        $("#displayShareCount-ongoingCare").text(p + "% shared");
    };
    countShare();
    $("input[type=checkbox].shareOn-ongoingCare").on("click", countShare);

    $("#shareAllSwitch-ongoingCare").change(function () {
        $(".shareOn-ongoingCare").prop('checked', $(this).prop("checked"));
        var allCount = (($("input:checked.shareOn-ongoingCare").length / 7) * 100).toFixed(0);
        $("#displayShareCount-ongoingCare").text(allCount + "% shared");

        if ($('input[type=checkbox].shareOn-ongoingCare').prop('checked')) {
            $('#shareOneId1-ongoingCare, #shareTwoId1-ongoingCare, #shareThreeId1-ongoingCare, #shareFourId1-ongoingCare, #shareFiveId1-ongoingCare, #shareSixId1-ongoingCare, #shareSevenId1-ongoingCare').removeClass("custom-icon-share");
            $('#shareOneId1-ongoingCare, #shareTwoId1-ongoingCare, #shareThreeId1-ongoingCare, #shareFourId1-ongoingCare, #shareFiveId1-ongoingCare, #shareSixId1-ongoingCare, #shareSevenId1-ongoingCare').toggleClass("custom-icon-share");
        } else {
            $('#shareOneId1-ongoingCare, #shareTwoId1-ongoingCare, #shareThreeId1-ongoingCare, #shareFourId1-ongoingCare, #shareFiveId1-ongoingCare, #shareSixId1-ongoingCare, #shareSevenId1-ongoingCare').removeClass("custom-icon-share");
        }
    });

    $("#shareOne-ongoingCare").click(function () {
        $('#shareOneId1-ongoingCare').toggleClass("custom-icon-share");
    });
    $("#shareTwo-ongoingCare").click(function () {
        $('#shareTwoId1-ongoingCare').toggleClass("custom-icon-share");
    });
    $("#shareThree-ongoingCare").click(function () {
        $('#shareThreeId1-ongoingCare').toggleClass("custom-icon-share");
    });
    $("#shareFour-ongoingCare").click(function () {
        $('#shareFourId1-ongoingCare').toggleClass("custom-icon-share");
    });
    $("#shareFive-ongoingCare").click(function () {
        $('#shareFiveId1-ongoingCare').toggleClass("custom-icon-share");
    });
    $("#shareSix-ongoingCare").click(function () {
        $('#shareSixId1-ongoingCare').toggleClass("custom-icon-share");
    });
    $("#shareSeven-ongoingCare").click(function () {
        $('#shareSevenId1-ongoingCare').toggleClass("custom-icon-share");
    });
</script>


<!-- PLACE NEXT SCRIPT FOR Counting directly above this line -->

<!-- custom CSS Variable for card Member's name -->


<!-- ======================================================================================================== -->

<!--   END                              S H A R I N G    S E C T I O N                                                 -->

<!-- ======================================================================================================== -->


<script>
    $(document).ready(function () {

// remove sticky when screen width a certain size
        if ($(window).width() < 992) {
            $(".sticky").removeClass("sticky");
            //  if statement to toggle show/hide element when scroll at certain height
            $(window).scroll(function () {

                if ($(this).scrollTop() >= 600) {
                    $('#xtest').hide();
                    // $(".sticky").removeClass("sticky");
                } else if ($(this).scrollTop() < 10) {
                    $('#xtest').show();
                    // $(".sticky").addClass("sticky");
                }
            });

            // $("#xtest").hide();
        } else {
            // $("sticky").css("display", "hidden");
        }

    });
</script>


<script>
    $(document).ready(function () {
        $('.xbtn').popover({
            title: "<h3><strong>Co-Trustee</strong></h3>",
            content: "the individuals responsible for managing the trust and distributing the assets. The most basic duty of a <strong>co-trustee </strong> is the responsible management of assets. <br> <br> <h5>1. Both members of trust</h5><br> <strong>Successors Trustee</strong>- The person who assumes control of the trust after the initial trustee dies or becomes unable to continue with his or her responsibilities. Once the successor trustee has assumed control, he or she is responsible to ensure that your property is distributed to your beneficiaries according to the trust terms.",
            html: true,
            placement: "right"
        });
    });
    // $('.popover-dismiss').popover({
    //   trigger: 'focus'
    // })
</script>


<!-- </script> -->
<script> $('.xcode').css("color:", "red");</script>

<script>
    $('#meBtn').click(function () {
        $("#myId").hide();
        $("#my2Id").show();
    });
    $('#meBtn1').click(function () {
        $("#profile1").hide();
        $("#profile2").show();
    });
    $('#meBtn2').click(function () {
        $("#profile2").hide();
        $("#profile3").show();
    });
    $('#meBtn3').click(function () {
        $("#profile3").hide();
        // $("#profile4").show();
    });


</script>
<!--Controls the Dashboard Wizard Screens -->
<script>
    // Personal Information Windows
    $(document).ready(function () {
        $("#myeditProfile").click(function () {
            $("#displayProfile").hide();
            $('#myeditProfile').hide();
            $("#editProfile").show();
            $("#mydisplayProfile").show();

        });
        $("#mydisplayProfile").click(function () {
            $("#displayProfile").show();
            $('#myeditProfile').show();
            $("#editProfile").hide();
            $("#mydisplayProfile").hide();
        });
    });

    // Family Information Windows
    $(document).ready(function () {
        $("#myeditFamily").click(function () {
            $("#displayFamily").hide();
            $('#myeditFamily').hide();
            $("#editFamily").show();
            $("#mydisplayFamily").show();

        });
        $("#mydisplayFamily").click(function () {
            $("#displayFamily").show();
            $('#myeditFamily').show();
            $("#editFamily").hide();
            $("#mydisplayFamily").hide();
        });
    });

    // Work Information Windows
    $(document).ready(function () {
        $("#myeditWork").click(function () {
            $("#displayWork").hide();
            $('#myeditWork').hide();
            $("#editWork").show();
            $("#mydisplayWork").show();

        });
        $("#mydisplayWork").click(function () {
            $("#displayWork").show();
            $('#myeditWork').show();
            $("#editWork").hide();
            $("#mydisplayWork").hide();
        });
    });

    // Estate Information Windows
    $(document).ready(function () {
        $("#myeditEstateBio").click(function () {
            $("#displayEstateBio").hide();
            $('#myeditEstateBio').hide();
            $("#editEstateBio").show();
            $("#mydisplayEstateBio").show();

        });
        $("#mydisplayEstateBio").click(function () {
            $("#displayEstateBio").show();
            $('#myeditEstateBio').show();
            $("#editEstateBio").hide();
            $("#mydisplayEstateBio").hide();
        });
    });

    // Financial Information Windows
    $(document).ready(function () {
        $("#myeditFinancial").click(function () {
            $("#displayFinancial").hide();
            $('#myeditFinancial').hide();
            $("#editFinancial").show();
            $("#mydisplayFinancial").show();

        });
        $("#mydisplayFinancial").click(function () {
            $("#displayFinancial").show();
            $('#myeditFinancial').show();
            $("#editFinancial").hide();
            $("#mydisplayFinancial").hide();
        });
    });

    // Health Care Information Windows
    $(document).ready(function () {
        $("#myeditHealthCare").click(function () {
            $("#displayHealthCare").hide();
            $('#myeditHealthCare').hide();
            $("#editHealthCare").show();
            $("#mydisplayHealthCare").show();

        });
        $("#mydisplayHealthCare").click(function () {
            $("#displayHealthCare").show();
            $('#myeditHealthCare').show();
            $("#editHealthCare").hide();
            $("#mydisplayHealthCare").hide();
        });
    });

    // Health Care Information Windows
    $(document).ready(function () {
        $("#myeditEducation").click(function () {
            $("#displayEducation").hide();
            $('#myeditEducation').hide();
            $("#editEducation").show();
            $("#mydisplayEducation").show();

        });
        $("#mydisplayEducation").click(function () {
            $("#displayEducation").show();
            $('#myeditEducation').show();
            $("#editEducation").hide();
            $("#mydisplayEducation").hide();
        });
    });
</script>

<!--marital status radio buttons-->
<script>
    // $("input:radio").click(function(){
    //     $("div").hide();
    //     var div = "#radio-"+$(this).val();
    //     $(div).show();
    // });
    $('#radio1').click(function () {
        $('#spouseEdit').toggle(this.checked);
        $('#singeEdit').hide();
        $('#otherEdit').hide();
    });
    $('#radio2').click(function () {
        $('#singeEdit').toggle(this.checked);
        $('#spouseEdit').hide();
        $('#otherEdit').hide();
    });
    $('#radio3').click(function () {
        $('#otherEdit').toggle(this.checked);
        $('#spouseEdit').hide();
        $('#singeEdit').hide();
    });
</script>


<script>

    $('#Mebtn1a').click(function () {
        $("#tab1a").removeClass('active');
        $("#tab2a").addClass('mactive');
    });
</script>

<!--========!!!!!!!!!!!!!!======= Weird Tab Panel Bug Fix!!!!!-->
<!--Helps Profile Dashboard Properly Close all the tabs and only show tab panels which are actually clicked-->
<script>
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        var href = e.relatedTarget.getAttribute("href");
        if ($(href).hasClass('active')) {
            $(href).removeClass('active');
        }
    });
</script>

<!--Removes "STICKY" Class so it floats to the top on smaller screen sizes-->
<script>
    $(document).ready(function () {
        $('#stickIt').addClass('sticky');

    });


</script>
<script>
    $('document').ready(function () {
        $('.links a').click(function (e) {
            e.preventDefault();
            $('.links a').removeClass('myMain');
            $(this).addClass('myMain');
            $('.links a').removeClass('myActive1');

//         $(this).addClass('fa fa-chevron-right');
//         // $('.links a').removeClass('meIcon');
        });


    });
</script>

<script>
    // MDB Lightbox Init
    $(function () {
        $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
    });

</script>
<script>
    // Material Select Initialization
    $(document).ready(function () {
        // $('.mdb-select').materialSelect();
        $('.mdb-select').not(".do_not_initiate").materialSelect();
    });
</script>


<!-- counts how many msg center recipients -->
<script>
    var countChecked = function () {
        var n = $("input:checked.meChecked").length;

//   $( "#mycount" ).text( n + (n === 1 ? " is" : " are") + " selected" );
        $("#mycount").text(n + " selected");
    };
    countChecked();

    $("input[type=checkbox]").on("click", countChecked);
</script>


<!-- hide welcome screen -->
<script>
    $(document).ready(function () {
        $('#welcomeCheckbox').change(function () {
            if (this.checked)
                $('#welcomeCenter').show();
            else
                $('#welcomeCenter').hide();

        });
        $("#help").click(function () {
            $('#welcomeCenter').show();

        });

        $("#welcomeCenterDismiss").click(function () {
            $('#welcomeCenter').hide();
            // $('#welcomeCenterX').addClass();
            // $("p:first").addClass("intro");
        });
    });

</script>


<!--sticky testing-->
<script>
    /*  $(window).resize(function () {
          var viewportWidth = $(window).width();
          if (viewportWidth < 991) {
              $(".dashboard").removeClass("sticky");
          }
      });*/
</script>
<!-- Animations init-->
<script>
    new WOW().init();
</script>
<script>
    // $(".view .mask").removeClass("waves-effect waves-light");
    $(".noWaveEffect").removeClass("waves-effect waves-light");
</script>


<!-- ====================================================================================================

        S U B C A T E G O R I E S     S H A R E D     I N F O

====================================================================================================
-->


<script>


    $(function () {
        var selectedClass = "";
        $(".filter").click(function () {
            selectedClass = $(this).attr("data-rel");
            $("#gallery").fadeTo(100, 0.1);
            $("#gallery div").not("." + selectedClass).fadeOut().removeClass('animation');
            setTimeout(function () {
                $("." + selectedClass).fadeIn().addClass('animation');
                $("#gallery").fadeTo(300, 1);
            }, 300);
        });
    });

</script>


<!-- Table Editable -->
<script>
    var $TABLE = $('#table');
    var $BTN = $('#export-btn');
    var $EXPORT = $('#export');

    $('.table-add').click(function () {
        var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLE.find('table').append($clone);
    });

    $('.table-remove').click(function () {
        $(this).parents('tr').detach();
    });

    $('.table-up').click(function () {
        var $row = $(this).parents('tr');
        if ($row.index() === 1) return; // Don't go above the header
        $row.prev().before($row.get(0));
    });

    $('.table-down').click(function () {
        var $row = $(this).parents('tr');
        $row.next().after($row.get(0));
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTN.click(function () {
        var $rows = $TABLE.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORT.text(JSON.stringify(data));
    });

    $('.phone_us').mask('(000) 000-0000');
    // $("input, select, textarea").attr("autocomplete", "off");
</script>

<!-- ======================================================================================================== -->

<!--   END /    S U B C A T E G O R I E S     S H A R E D     I N F O                                                -->

<!-- ======================================================================================================== -->

@if (Auth::check())

    <script type="text/javascript"
            src="{{ asset('assets/js/main.js')}}{{Config::get('constants.LIB_VERSION')}}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/keyup.main.js')}}{{Config::get('constants.LIB_VERSION')}}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/dashboard.js')}}{{Config::get('constants.LIB_VERSION')}}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/profile.js')}}{{Config::get('constants.LIB_VERSION')}}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/members.js')}}{{Config::get('constants.LIB_VERSION')}}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/documents.js')}}{{Config::get('constants.LIB_VERSION')}}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/other_estates.js')}}{{Config::get('constants.LIB_VERSION')}}"></script>
    <script>
        $(document).ready(function () {
            $(document).ready(function () {
                @if(\Illuminate\Support\Facades\Input::get('message_user_id_trigger') !== null && Input::get('message_user_id_trigger'))
                $('#message_member_li_1_' +{{Input::get('message_user_id_trigger')}}).closest('.message_member_li').trigger('click');
                @endif
            });
        });
    </script>

    @endif
    </body>

    </html>

