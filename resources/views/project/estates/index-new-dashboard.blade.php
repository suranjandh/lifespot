<style>
    .dashboard-pic {
        height: 70px;
    }

    .scrollspy-example {
        height: 450px;
    }

    .btnLink-dashboard {
        float: right;
        margin-right: 0;
        color: white;
        background-color: rgb(58, 113, 183);
        height: auto;
        width: 150px;
        padding: 10px;
        text-transform: capitalize;
    }

    .btnLink-dashboard:hover {
        color: white;
        background-color: rgba(113, 58, 183, .7);
        background-color: rgb(1, 159, 222);
    }

    #cardId-42 {
        border: 5px solid grey;
    }

    .header-color {
        background-color: rgb(58, 113, 183);
        color: white;
        text-align: center;
        font-size: 1.1rem;
    }

    .dashboard-count {
        font-weight: 700;
        font-size: 3rem;
        text-align: center;
        color: rgb(58, 113, 183);
        margin: 0;
        padding: 0;
    }

    .task-count {
        font-weight: 500;
        font-size: 1rem;
        color: rgb(58, 113, 183);
        margin: 0;
        padding: 0;
    }

    .dashboard-sm-count {
        font-weight: 900;
        font-size: 1.8rem;
        color: rgb(58, 113, 183);
        margin: 0;
        padding: 0;
        width: 60px;
    }

    .dashboard-subtext {
        font-weight: 500;
        font-size: 1rem;
        text-align: center;
        color: grey;
        margin: 0;
        padding: 0;
    }

    .dashboard-text {
        font-weight: 500;
        font-size: 1rem;
        color: grey;
        margin: 0;
        padding: 0;
        margin-bottom: 10px;
    }

    .dashboard-spanText {
        font-size: .9rem;
        color: rgb(58, 113, 183);
        cursor: pointer;
        font-weight: 700;
    }

    .snapshot-text {
        font-size: 1.0rem;
        color: rgb(58, 113, 183);
        cursor: pointer;
        font-weight: 700;
        text-align: center;
    }

    .iconColor {
        color: rgb(58, 113, 183);
    }

    .upated-info {
        color: grey;
        margin-left: 35px;
        margin-top: 0;
        padding-top: 0;
    }

    .hideDashboard {
        position: absolute;
        top: 0;
        right: 5px;
    }

    .skip {
        font-size: .8rem;
    }

    .access-link {
        color: rgb(58, 113, 183);
        font-size: .9rem;
        font-weight: bold;
    }

    #skipped-tasks {
        /* display: none; */
    }

    .taskList {
        /* display: block; */
    }

    .nav-link .active {
        background: green;
    }

    .pills-secondary .nav-link.active, .pills-secondary .show > .nav-link, .tabs-secondary {
        background-color: rgb(58, 113, 183) !important;
    }

    .activity-heading {
        font-size: 1.2rem;
        font-weight: 700;
        color: rgb(58, 113, 183);
    }

    .snapShot_header {
        font-weight: 400;
        margin-left: 10px;
    }

    .main_info {
        margin-left: 15px;
        font-weight: 500;
        color: #444444;
        /* color: #000; */
    }

    /* .member-box{display: flex;} */
    .member-title {
        /* display: flex; */
        /* width: 100%; */
        /* margin-bottom: 20px; */
    }

    .memName {
        flex: 1;
        /* margin-right: 25px; */
    }

    .member_info {
        margin-left: 5px;
        font-weight: 300;
        color: rgb(58, 113, 183);
        flex: 1;
        margin-bottom: 10px;
        /* width: 80%; */
    }

    .memInfoStyle {
        font-weight: 400;
    }

    .secondary_info {
        margin-left: 20px;
        font-weight: 300;
        color: #000;
        display: flex;
    }

    .info_emphasis {
        font-weight: 400;
        color: #036;
        flex: 1;
    }

    .details {
        flex: 8;
    }

    .details-align {
        flex: 6;
    }

    .missing_info {
        color: red;
    }

    .expander {
        cursor: pointer;
        display: flex;
    }



    .md-accordion .card, .md-accordion .card:first-of-type, .md-accordion .card:not(:first-of-type):not(:last-of-type) {
        border-bottom: none;
    }
</style>

<div class="card" id="cardId-42">
    <div class="card-body">

        <div class="row mb-2">
            <div class="col-1"><img src="{{Config::get('constants.DEFAULT_AVATAR_IMAGE_URL')}}" class="dashboard-pic profile_image_img" alt="">
            </div>
            <div class="col-11 pl-5" xstyle="padding-left: 40px">
                <h5 class="col-10">Hey <span
                            class="bind_profile_first_name">{{auth()->user()->first_name}}</span>,
                    @php
                    $dateCurrent = date('Y-m-d H:i:s');
                    $dateEstateAdded = date(auth()->user()->created_at);
                    $date1 = date_create($dateEstateAdded);
                    $date2 = date_create($dateCurrent);
                    $diff = date_diff($date1, $date2);
                    $msg = $diff->format("%a");
                    @endphp
                    @if ($msg === '0')
                      @php   echo "welcome to your LifeSpot dashboard. Checkout your tasks to help you store important documents, invite key members to your estate & much more. Let’s get started!" @endphp;
                    @else
                      @php  echo "welcome back!  &nbsp;This is your dashboard. &nbsp;Look for important messages, news, and cool tips from LifeSpot, right here ... coming soon! Thanks for being a member for " . $msg @endphp @php echo $msg === '1' ? ' day.' : ' days.'; @endphp
                    @endif

                    <!-- Welcome back!  &nbsp;This is your dashboard. &nbsp;Look for important messages, news, and cool tips from LifeSpot, right here ... coming soon! -->
                </h5>

                <div class=" ISHide hideDashboard" onclick="toggle(this)" data-toggle="collapse"
                     data-target="#user-dashboard" aria-expanded="false" aria-controls="collapseExample"><a href="#"
                                                                                                            class="xred-text">Hide
                        Dashboard</a>
                </div>
            </div>
        </div>
        <div class="collapse show" id="user-dashboard">
            <div class="card-deck">
                <!--Panel-->
                <div class="card">
                    <div class="card-header header-color">MyLifeSpot</div>
                    <div class="card-body text-primary">
                        <!-- <p class="dashboard-count">42</p> -->

                        <p class="xdashboard-subtext dashboard-spanText xsnapshot-text xmt-3" data-toggle="modal"
                           data-target="#snapShotModal"><img class="mr-2" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-parse_resumes.png" alt="">
                            Snapshot</p>

                    </div>
                </div>
                <!--/.Panel-->

                <!-- LS Estate Plan Center -->
                {{--@php
                include 'EstatePlan/treeView.php';
                @endphp--}}
                <!-- /LS Estate Plan Center -->


                <!--Panel-->
                <div class="card">
                    <div class="card-header header-color">Overview</div>
                    <div class="card-body text-primary">
                        <a href="{{ route('estate_members') }}">
                            <p class="dashboard-spanText">
                                <!-- <i class="fas fa-users fa-lg iconColor mr-1"></i>  -->
                                <img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-groups.png" class="mr-2" alt="">
                                <span class="total_member_count dashboard-spanText">0</span>
                                <span class="dashboard-spanText">Members</span>
                            </p>
                        </a>
                        <a href="{{route('estate_documents') }}">
                            <p class="dashboard-spanText">
                                <img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-documents.png" class="mr-2" alt="">
                                <span class="total_document_count dashboard-spanText">0</span>
                                <span class="dashboard-spanText">Documents</span>
                            </p>
                        </a>
                        <a href="{{ route('estate_estate') }}">

                            <p class="dashboard-spanText">
                                <!-- <i class="fas fa-copy fa-lg iconColor mr-2"></i> &nbsp; -->
                                <img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-property.png" class="mr-2" alt="">
                                <span class="total_otherEstate_count dashboard-spanText bind_other_estate_count">0</span>
                                <span class="dashboard-spanText">Estates</span>
                            </p>
                        </a>
                    </div>
                </div>
                <!--/.Panel-->


                <!--Panel-->
                <div class="card">
                    <div class="card-header header-color">Tasks</div>
                    <!-- <div class="card-body text-primary">
                    <p class="dashboard-count">7</p>
                    <p class="dashboard-subtext">Tasks need attention</p>
                    <p class="access-link text-center mt-4"><a>Skipped Tasks: 22 </a></p>
                    </div> -->
                    <!-- ================= -->
                    <ul class="nav md-pills pills-secondary">
                        <li class="nav-item d-flex inline">
                            <span class="pl-3 dashboard-sm-count active_task_count">0</span>
                            <a class="my nav-link active ml-2 panel_task_trigger" data-toggle="tab" href="#panel_task"  role="tab">Current</a>
                        </li>
                        <li class="nav-item d-flex inline">
                            <span class="pl-3 dashboard-sm-count skipped_task_count">0</span>
                            <a class="nav-link ml-2 panel_task_skip_trigger" data-toggle="tab" href="#panel_task_skip" role="tab">Skipped</a>
                        </li>
                    </ul>
                    <!-- ================== -->

                    <!-- <p class="dashboard-subtext">Tasks need attention</p> -->
                </div>
                <!--/.Panel-->

                <!--Panel-->
                <div class="card">
                    <div class="card-header header-color">Activity</div>
                    <div class="card-body text-primary">
                        <a class="xdashboard-text  dashboard-spanText" id="open_activity_log_modal">
                            <!-- <i class="fas fa-user fa-lg iconColor"></i>  -->
                            <img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-activity_history.png" alt="">
                            <span class="dashboard-spanText">&nbsp;Recent Activity</span><br><br>
                            <!-- <small class="upated-info">Mischa Agster</small> -->
                        </a>
                        <a class="xdashboard-text  dashboard-spanText" id="open_calendar_events_modal"
                           data-toggle="modal"
                           data-target="#CalendarEvents">
                            <!-- <i class="fas fa-calendar-alt fa-lg iconColor mr-2"></i>  -->
                            <img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-reminder.png" alt="">
                            <span class="dashboard-spanText">&nbsp;Important Dates</span></a>
                    </div>
                </div>
                <!--/.Panel-->
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity  card area -->

<!-- Modal: modalRecentAcivity-->
<div class="modal fade right" id="ActivityLogModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading activity-heading">@php echo auth()->user()->first_name . "'s "; @endphp Activity Logs
                </p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">


            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <!-- <a type="button" class="btn btn-primary">Go to cart</a> -->
                <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancel</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- /Modal: modalRecentAcivity-->

<!-- /Recent Activity card area -->


<!-- Calendar Events card area -->
<!-- Button trigger modal-->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAbandonedCart">Launch
  modal</button> -->

<!-- Modal: modalCalendarEvents-->
<div class="modal fade right" id="CalendarEvents" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading activity-heading">@php echo auth()->user()->first_name . "'s "; @endphp Calendar Events
                </p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">

                <table id="dtEventCalendar" class="table table-striped table-bordered table-sm" cellspacing="0"
                       width="100%"
                       ordering="true">
                    <thead>
                    <tr>
                        <th class="th-sm">Event date
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>
                        <th class="th-sm">Description of Event
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody id="dtEventCalendarTbody">
                    </tbody>
                </table>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <!-- <a type="button" class="btn btn-primary">Go to cart</a> -->
                <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancel</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- /Modal: modalCalendarEvents-->

<!-- /Calendar Events card area -->


<!-- Tab panels -->

<!-- Task Panel -->
<div class="tab-content p-0" id="task_panel">
    {{--@include('project.estates.tasks.task_panel') by ajax --}}
</div>
<!-- Task panel end -->

<div class="text-center task_list_arrow"  style="display: none">
    <i  class="fas fa-arrow-down white-text fxa-2x"></i>
</div>
<!-- Tab panels -->
{{--@php
include './Dashboard-ToDos/guardian-form-modals.php';
@endphp--}}
<style>
    .dataTables_length select {
        display: inline-block !important;
    }


</style>




