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
    {{-- @php
         include 'KIDfooter_flex_content.php';
     @endphp--}}
    @include('project.kid.layouts.KIDfooter_flex_content')

</footer>
<!--/.Footer-->
<!-- SCRIPTS -->
<!-- MDB core JavaScript -->
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
            {{--{{$helper->get_url_tab_id()}} ;--}}
            {{--@php             $roles_array_values = array_values($roles_obj->get_roles());        @endphp--}}
            {{--
                var roles_array_values_obj = '{{json_encode($roles_array_values)}}';
            --}}
            {{--
                var relationship_array_values_obj = $.parseJSON('{{json_encode($relationship_obj->get_relationships())}}');
            --}}
            {{--
                var get_role_guardian =  {{$roles_obj->get_role_guardian()}};
            --}}


    var PET_IMG_FOLDER = '{{Config::get('constants.PET_IMG_FOLDER')}}';
    var ESTATE_IMG_FOLDER = '{{Config::get('constants.ESTATE_IMG_FOLDER')}}';
    var MEMBER_IMG_FOLDER = '{{Config::get('constants.MEMBER_IMG_FOLDER')}}';
    var PROFILE_IMG_FOLDER = '{{Config::get('constants.PROFILE_IMG_FOLDER')}}';

    var SITE_IMG_FOLDER = '{{Config::get('constants.SITE_IMG_FOLDER')}}';


    {{--  var TAB_URLS_ALL = {{json_encode($helper->get_tab_urls_all())}}--}}


</script>

<script>



    var formSiteChanged = false;
    $("#form-site :input").change(function () {
        if (!$(this).hasClass('change_trigger_disabled')) {
            formSiteChanged = true;
            $("#btnChange-site").html('Save your changes');
            $("#btnChange-site").css('font-size', '.8rem');
            $("#btnChange-site").removeClass('disabled');
            $("#btnChange-site,#btnChangeNext-site").removeClass('btn-primary');
            $("#btnChange-site,#btnChangeNext-site").addClass('btn-warning');
        }
    });

    $("#btnChange-site,#btnChangeNext-site").click(function () {
        $("#btnChange-site").html('Update');
        $("#btnChange-site,#btnChangeNext-site").css('font-size', '.64rem');
        $("#btnChange-site").addClass('disabled');
        $("#btnChange-site,#btnChangeNext-site").removeClass('btn-warning');
        $("#btnChange-site,#btnChangeNext-site").addClass('btn-primary');
    });

    var formProfileKIDChanged = false;
    $(document).on('change', "#form-profileKID :input", function () {
        if (!$(this).hasClass('change_trigger_disabled')) {

            formProfileKIDChanged = true;
            $("#btnChange-KIDprofile").html('Save your changes');
            $("#btnChange-KIDprofile").css('font-size', '.8rem');
            $("#btnChange-KIDprofile").removeClass('disabled');
            $("#btnChange-KIDprofile,#btnChangeNext-KIDprofile").removeClass('btn-primary');
            $("#btnChange-KIDprofile,#btnChangeNext-KIDprofile").addClass('btn-warning');
        }
    });

    $(document).on('click', "#btnChange-KIDprofile,#btnChangeNext-KIDprofile", function () {
        $("#btnChange-KIDprofile").html('Update');
        $("#btnChange-KIDprofile,#btnChangeNext-KIDprofile").css('font-size', '.64rem');
        $("#btnChange-KIDprofile").addClass('disabled');
        $("#btnChange-KIDprofile,#btnChangeNext-KIDprofile").removeClass('btn-warning');
        $("#btnChange-KIDprofile,#btnChangeNext-KIDprofile").addClass('btn-primary');
    });

    var formFriendKIDChanged = false;
    $(document).on('change', "#form-friendsKID :input", function () {
        if (!$(this).hasClass('change_trigger_disabled')) {

            formFriendKIDChanged = true;
            $("#btnChange-friends").html('Save your changes');
            $("#btnChange-friends").css('font-size', '.8rem');
            $("#btnChange-friends").removeClass('disabled');
            $("#btnChange-friends").removeClass('btn-primary');
            $("#btnChange-friends").addClass('btn-warning');
        }
    });

    $(document).on('click', "#btnChange-friends", function () {
        $("#btnChange-friends").html('Update');
        $("#btnChange-friends").css('font-size', '.64rem');
        $("#btnChange-friends").addClass('disabled');
        $("#btnChange-friends").removeClass('btn-warning');
        $("#btnChange-friends").addClass('btn-primary');
    });

    $(document).on('change', '#addNewMemberID1 #form-memberNew :input', function () {
        if (!$(this).hasClass('change_trigger_disabled')) {

            $("#addNewMemberID1 #btnChange-ADDmemberNew").html('Save your changes');
            $("#addNewMemberID1 #btnChange-ADDmemberNew").removeClass('disabled');
            $("#addNewMemberID1 #btnChange-ADDmemberNew").css('font-size', '.8rem');
            $("#addNewMemberID1 #btnChange-ADDmemberNew").removeClass('btn-primary');
            $("#addNewMemberID1 #btnChange-ADDmemberNew").addClass('btn-warning');
        }
    });

    $(document).on('click', '#addNewMemberID1 #btnChange-ADDmemberNew', function () {
        $("#addNewMemberID1 #btnChange-ADDmemberNew").html('Update');
        $("#addNewMemberID1 #btnChange-ADDmemberNew").css('font-size', '.64rem');
        $("#addNewMemberID1 #btnChange-ADDmemberNew").addClass('disabled');
        $("#addNewMemberID1 #btnChange-ADDmemberNew").removeClass('btn-warning');
        $("#addNewMemberID1 #btnChange-ADDmemberNew").addClass('btn-primary');
    });


        if (tab_id == 'estate_messages') {
            $("#my-card-background").css('background', 'rgb(182, 184, 189)');
        }

    toastr.options = {
        timeOut: 80,
        positionClass: "toast-top-center"
    };
</script>
@if(Auth::check())

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

    <script type="text/javascript"
            src="{{ asset('assets/js/dashboard.kid.js')}}{{Config::get('constants.LIB_VERSION')}}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/profile.kid.js')}}{{Config::get('constants.LIB_VERSION')}}"></script>

    <script>
        $(document).ready(function () {

            @if(Illuminate\Support\Facades\Input::get('message_user_id_trigger') !== null && Input::get('message_user_id_trigger'))
            $('#message_member_li_1_' +{{Input::get('message_user_id_trigger')}}).closest('.message_member_li').trigger('click');
            @endif
        });
    </script>
@endif
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>

