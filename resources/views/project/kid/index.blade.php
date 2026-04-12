@extends('layouts.kid_app')
@section('content')
    {{--@php
    include_once 'layouts/KIDheader.php';
    @endphp
    @php
    include_once 'layouts/KIDnavLoggedIn.php';
    @endphp--}}




    @include('project.kid.layouts.KIDnavLoggedIn')

    <style>
        .thisPageBackground {
            /* background-color: rgb(182, 184, 189); */
            background-color: red;
        }

        .nav-background {
            /* background-color: #818181; */
            background-color: white;
            /* background-color: rgb(58, 113, 183); */
            /* background-color: rgb(58, 113, 183); */
        }

        #my-card-background {
            background-color: rgb(58, 113, 183);
            min-height: 840px;
        }

        .card-background {
            /* background-color: rgb(182, 184, 189); */
            background-color: rgb(58, 113, 183);
        }

        .list-group-item {
            /* background-color: #818181; */
            background-color: white;
        }

        .heightMin {
            min-height: 700px;
        }

        .list-group-item.active {
            background-color: rgb(58, 113, 183);
        }

        .nav-collapse-space {
            /* padding-top: 100px; */
        }

        .btn_sponsor {
            cursor: pointer;
            margin-top: 15px;
            border-radius: 10px;
        }

        .sponsors {
            height: 200px;
        }

        .image-upload > input {
            display: none;
        }
    </style>
    <main class="xpt-5 pb-3 mx-3 xmb-3">
        <!-- <div class="mb-0"></div> -->
        <div class="container-fluid nav-collapse-space">


            <!-- /Banner: Photo and Estate Name -->

            <div class="row heightMin">
                <div class="col-lg-3 col-sm-12 mb-3 xpt-5 nav-background">
                    <!-- Navigation -->
                    <div class="list-group" id="list-tab" role="tablist">

                        @php
                            //$tab_active = $helper->is_in_tab_url_kid(0) ? 'active disabled' : '';
                            $tab_active =   URL::current()== route('kid_index') ? 'active disabled' : '';

                        @endphp
                        <a class="list-group-item list-group-item-action {{ $tab_active }}" id="list-dashboard-list"
                           xdata-toggle="list"
                           href="{{ route('kid_index') }}" role="tab" aria-controls="dashboard"><span
                                    class="pl-5">Dashboard</span><span class="msg-shape active_task_count"
                                                                       id="memID-msgCount">0</span></a>
                        @php
                            // $tab_active = $helper->is_in_tab_url_kid(100) ? 'active disabled' : '';
                            $tab_active =   URL::current()== route('kid_messages') ? 'active disabled' : '';

                        @endphp
                        <a class="list-group-item list-group-item-action {{ $tab_active }}" id="list-messages-list"
                           xdata-toggle="list"
                           href="{{ route('kid_messages') }}" role="tab" aria-controls="messages"><span
                                    class="pl-5">Messages</span><span
                                    id="messages_count_total"></span></a>
                        @php
                            // $tab_active = $helper->is_in_tab_url_kid(250) ? 'active disabled' : '';
                           $tab_active =   URL::current()== route('kid_profile') ? 'active disabled' : '';

                        @endphp
                        <a class="list-group-item list-group-item-action  {{ $tab_active }} switch_category_tab_1 switch_category_tab_2"
                           id="list-profile-list" xdata-toggle="list"
                           href="{{ route('kid_profile') }}" role="tab" aria-controls="profile"><span
                                    class="pl-5">My Profile</span></a>
                        @php
                            // $tab_active = $helper->is_in_tab_url_kid(400) ? 'active disabled' : '';
                           $tab_active =   URL::current()== route('kid_members') ? 'active disabled' : '';

                        @endphp
                        <a class="list-group-item list-group-item-action  {{ $tab_active }} switch_category_tab_7"
                           id="list-members-list"
                           xdata-toggle="list"
                           href="{{ route('kid_members') }}" role="tab" aria-controls="members"><span
                                    class="pl-5">Members</span></a>

                        @php
                            // $tab_active = $helper->is_in_tab_url_kid(600) ? 'active disabled' : '';
                            $tab_active =   URL::current()== route('estate_webspot') ? 'active disabled' : '';

                        @endphp
                        <a class="list-group-item list-group-item-action  {{ $tab_active }}" id="list-webspot-list"
                           xdata-toggle="list"
                           href="{{ route('estate_webspot')}}" role="tab" aria-controls="webspot"><span
                                    class="pl-5">Webspot</span></a>

                        @php
                            // $tab_active = $helper->is_in_tab_url_kid(625) ? 'active disabled' : '';
                           $tab_active =   URL::current()== route('kid_shared_info') ? 'active disabled' : '';

                        @endphp
                        <a class="list-group-item list-group-item-action {{ $tab_active }}" id="list-otherEstates-list"
                           xdata-toggle="list"
                           href="{{ route('kid_shared_info')}}" role="tab" aria-controls="otherEstates"><span
                                    class="pl-5">Shared Info</span></a>
                        @php
                            // $tab_active = $helper->is_in_tab_url_kid(650) ? 'active disabled' : '';
                          $tab_active =   URL::current()== route('kid_shared_info') ? 'active disabled' : '';

                        @endphp
                        <a class="list-group-item list-group-item-action {{ $tab_active }}" id="list-grow-list"
                           xdata-toggle="list"
                           href="{{ route('kid_game_center') }}" role="tab" aria-controls="grow"><span
                                    class="pl-5">Game Center</span></a>

                    </div>
                    <!-- Navigation -->

                    <!-- sponsor Carousel -->
                    <!--Carousel Wrapper-->
                    <div id="carousel-example-2" class="carousel slide carousel-fade mt-3" data-ride="carousel">

                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <div class="view">
                                    <img class="d-block w-100 sponsors"
                                         src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}kidArt.jpg"
                                         alt="First slide">

                                    <div class="mask rgba-black-light"></div>
                                </div>
                                <div class="carousel-caption">
                                    <h3 class="h3-responsive">
                                        <!-- <img src="../img/sponsor_fidelity.png" alt=""> -->
                                    </h3>

                                    <p>Young Artists</p>
                                    <button type="button" class="btn_sponsor">Learn More</button>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <!--Mask color-->
                                <div class="view">
                                    <img class="d-block w-100 sponsors"
                                         src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}kidPodcaster.jpg"
                                         alt="Second slide">

                                    <div class="mask rgba-black-light"></div>
                                </div>
                                <div class="carousel-caption">
                                    <h3 class="h3-responsive">WebSpot</h3>

                                    <p>Podcast with Friends</p>
                                    <button type="button" class="btn_sponsor">Learn More</button>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <!--Mask color-->
                                <div class="view">
                                    <img class="d-block w-100 sponsors"
                                         src="{{ Config::get('constants.PROJECT_IMAGE_URL') }}kidComputer.jpg"
                                         alt="Third slide">

                                    <div class="mask rgba-black-slight"></div>
                                </div>
                                <div class="carousel-caption">
                                    <h3 class="h3-responsive">Start the Fun</h3>

                                    <p>Game Planning</p>
                                    <button type="button" class="btn_sponsor">Learn More</button>
                                </div>
                            </div>
                        </div>

                        <!--/.Controls-->
                    </div>
                    <!--/.Carousel Wrapper-->


                    <!-- /sponsor Carousel -->

                </div>
                <!-- /col-lg-3 -->


                <!-- original col-lg-9 -->
                {{-- @php
                     include 'indexKID-nav-newV3HOLD.php';
                 @endphp--}}
                @include('project.kid.indexKID-nav-newV3HOLD')
            </div>
        </div>
    </main>

    {{--
        @php include 'indexKID-new-modals.php' @endphp
    --}}
    @include('project.kid.indexKID-new-modals')

    @include('project.kid.layouts.KIDfooter')
@endsection
