@php
    //require '../../../../../lib/includes/header_include.php';

    $dependent = null;
    $dependent_medical = null;
    $dependent_school = null;
    $dependent_member_id = '';
    $guardian_member = null;
    //$member_obj = new MemberModel();
    //$dependent_medical_obj = new DependentMedicalModel();
    //$dependent_school_obj = new DependentSchoolModel();
    //$guardian_member_obj = new GuardianMemberModel();
    $guardian_member_dependent = 0;
    $guardian_member_guardian = 0;
    //$roles_obj = new RolesModel();
    //if (isset($_POST->dependent_member_id) && trim($_POST->dependent_member_id) != '') {
$dependent_member_id = \Illuminate\Support\Facades\Input::get('dependent_member_id');
@endphp
@if($dependent_member_id != '')
    @php
        //$dependent_member_id = Input::get('dependent_member_id') ;
            $dependent = \App\Member::find($dependent_member_id);//$member_obj->get_member_by_id($_POST->dependent_member_id);
    @endphp
    @if ($dependent)
        @php
            $dependent_medical = $dependent->dependent_medical ; // $dependent_medical_obj->get_dependent_medical_by_member_id($_POST->dependent_member_id);
            $dependent_school =  $dependent->dependent_school ;  // $dependent_school_obj->get_dependent_school_by_member_id($_POST->dependent_member_id);

                $dependent_member_id = $dependent->member_id;
                $guardian_member_dependent = $dependent->member_id;
                // guardian part un finished
                //$guardian_member_row = null ;//$guardian_member_obj->get_guardian_member_row_by_dependent_member_id($dependent->member_id);
                //$guardian_member_guardian = $guardian_member_row ? $guardian_member_row->guardian_member_guardian : 0;
                //$guardian_member = null ;//$member_obj->get_member_by_id($guardian_member_guardian);
                $guardian_member =  $dependent->guardian ;
                if($guardian_member)$guardian_member_guardian = $guardian_member->member_id;
        @endphp
    @endif
@endif
@php
    $dependents = \App\Dependent::where('member_owner_user_id',auth()->user()->id)->get(); // $member_obj->get_dependents_by_user_id($_SESSION->loggedInUser);
$user_has_spouse = auth()->user()->user_has_spouse();//$member_obj->user_has_spouse($_SESSION->loggedInUser);
@endphp
<style>
    .modal-body .md-pills .nav-link.active {
        -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important;
        color: #fff !important;
        background-color: #2bbbad !important;
    }
</style>


<div class="modal-body">
    <div class="container">
        <!-- Start your project here-->
        <div style="">
            <!-- Nav tabs -->
            <ul class="nav md-pills nav-justified pills-peach-gradient dependent_main_tabs">
                <li class="nav-item sblue">
                    <a class="nav-link active" id="panel_profile_dependent_click" data-toggle="tab"
                       href="#panel_profile_dependent" role="tab"><i
                                class="fa fa-user"></i>
                        Profile</a>
                </li>
                <li class="nav-item sblue">
                    <a class="nav-link sub_sub_sub_category_key_dependent_sub_3_{{ isset($dependent->member_id) ? $dependent->member_id : '' }}"
                       data-toggle="tab" id="panel_guardian_dependent_click" href="#panel_guardian_dependent"
                       role="tab"><i
                                class="fa fa-heart"></i>
                        Guardian</a>
                </li>
                <li class="nav-item sblue">
                    <a class="nav-link sub_sub_sub_category_key_dependent_sub_2_{{ isset($dependent->member_id) ? $dependent->member_id : '' }}"
                       data-toggle="tab" id="panel_medical_dependent_click" href="#panel_medical_dependent"
                       role="tab"><i
                                class="fas fa-notes-medical"></i>
                        Medical</a>
                </li>
                <li class="nav-item sblue">
                    <a class="nav-link sub_sub_sub_category_key_dependent_sub_4_{{ isset($dependent->member_id) ? $dependent->member_id : '' }}"
                       data-toggle="tab" id="panel_school_dependent_click" href="#panel_school_dependent" role="tab"><i
                                class="fas fa-graduation-cap"></i>
                        School Info</a>
                </li>
            </ul>

            <!-- Nav tabs -->

            <!-- Tab panels -->
            <div class="tab-content dependent_main_panels">
                <!--Panel 1-->
                <div class="tab-pane fade in show active" id="panel_profile_dependent" role="tabpanel">
                    <!-- <br> -->
                    {{-- @php include 'profile_dependent.php'; @endphp--}}
                    @include('project.estates.forms.MyFamily.dependents.popup_modal.profile_dependent');
                </div>
                <!--/.Panel 1-->
                <!--Panel 2-->
                <div class="tab-pane fade" id="panel_medical_dependent" role="tabpanel">
                    <!-- <br> -->
                    {{-- @php include 'medical_dependent.php'; @endphp--}}
                    @include('project.estates.forms.MyFamily.dependents.popup_modal.medical_dependent');
                </div>
                <!--/.Panel 2-->
                <!--Panel 3-->
                <div class="tab-pane fade" id="panel_guardian_dependent" role="tabpanel">
                    <!-- <br> -->
                    {{--@php include 'guardian_dependent.php'; @endphp--}}
                    @include('project.estates.forms.MyFamily.dependents.popup_modal.guardian_dependent');
                </div>
                <!--/.Panel 3-->
                <!--Panel 4-->
                <div class="tab-pane fade" id="panel_school_dependent" role="tabpanel">
                    <!-- <br> -->
                    {{--@php include 'school_dependent.php'; @endphp--}}
                    @include('project.estates.forms.MyFamily.dependents.popup_modal.school_dependent');
                </div>
                <!--/.Panel 4-->
            </div>
            <!-- Tab panels -->

        </div>
        <!-- /Start your project here-->
    </div>


</div>
<div class="modal-footer">

</div>
