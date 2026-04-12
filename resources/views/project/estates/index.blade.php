@extends('layouts.estate_app')
@section('content')
    @php

   // echo
        // print_r($spouse_found);
            /*include '../lib/includes/header_include.php';
            // check to see if user is logged in.  If not, redirect to admin page
            if (!$session_class->session_check() ) {
                header("Location: " . SITE_BASE_URL . "/project/registerLoginSystem/logout.php");
            }
            if($session_class->is_kid()){
                header("Location: " . KID_INDEX_URL);
            }*/
       // echo URL::current();
      //  echo route('estate_index');
    @endphp
    @php
        //include_once '../includes/header.php'; done
    @endphp
    @php
        //include_once '../includes/navLoggedIn.php'; done
    @endphp
    @include('project.layouts.navLoggedIn')
    <style>
        .helpIcon {
            color: red;
        }

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
                    $tab_active =   URL::current()== route('estate_index') ? 'active disabled' : '';
                    @endphp
                    <a class="list-group-item list-group-item-action {{ $tab_active }}" id="list-dashboard-list"
                       xdata-toggle="list"
                       href="{{route('estate_index')}}" role="tab" aria-controls="dashboard"><span
                                class="pl-5">Dashboard</span><span class="msg-shape active_task_count"
                        ></span></a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list"
                       xdata-toggle="list"
                       xhref="#" role="tab" data-toggle="modal"
                       data-target="#modalRelatedContent" aria-controls="messages"><span class="pl-5 xpl-4">
                           <img class="float-right xmsg-shape helpIcon" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-help_outline.png" alt="">
                           Help Center</span><span
                                id="messages_count_total"></span></a>
                    @php
                    $tab_active = URL::current()== route('estate_messages')  ? 'active disabled' : '';
                    @endphp
                    <a class="list-group-item list-group-item-action {{ $tab_active }}" id="list-messages-list"
                       xdata-toggle="list"
                       href="{{ route('estate_messages') }}" role="tab" aria-controls="messages"><span class="pl-5">Messages</span><span
                                id="messages_count_total"></span></a>
                    @php
                    $tab_active = URL::current()== route('estate_profile')  ? 'active disabled' : '';
                    @endphp
                    <a class="list-group-item list-group-item-action  {{ $tab_active }} switch_category_tab_1 switch_category_tab_2"
                       id="list-profile-list" xdata-toggle="list"
                       href="{{ route('estate_profile')  }}" role="tab" aria-controls="profile"><span class="pl-5">My Profile</span></a>
                    @php
                    $tab_active =  URL::current()== route('estate_estate') ? 'active disabled' : '';
                    @endphp
                    <a class="list-group-item list-group-item-action  {{ $tab_active }}" id="list-myEstate-list"
                       xdata-toggle="list"
                       href="{{ route('estate_estate') }}" role="tab" aria-controls="myEstate"><span class="pl-5">My Estate</span></a>
                    @php
                    $tab_active = URL::current()== route('estate_members') ? 'active disabled' : '';
                    @endphp
                    <a class="list-group-item list-group-item-action  {{ $tab_active }} switch_category_tab_7"
                       id="list-members-list"
                       xdata-toggle="list"
                       href="{{ route('estate_members') }}" role="tab" aria-controls="members"><span class="pl-5">Members</span></a>
                    @php
                    $tab_active = URL::current()== route('estate_documents') ? 'active disabled' : '';
                    @endphp
                    <a class="list-group-item list-group-item-action  {{ $tab_active }}" id="list-documents-list"
                       xdata-toggle="list"
                       href="{{ route('estate_documents') }}" role="tab" aria-controls="documents"><span
                                class="pl-5">Documents</span></a>
                    @php
                    $tab_active = URL::current()== route('estate_webspot') ? 'active disabled' : '';
                    @endphp
                    <a class="list-group-item list-group-item-action  {{ $tab_active }}" id="list-webspot-list"
                       xdata-toggle="list"
                       href="{{ route('estate_webspot') }}" role="tab" aria-controls="webspot"><span class="pl-5">Webspot</span></a>
                    @php
                    $tab_active = URL::current()== route('estate_other_estates') ? 'active disabled' : '';
                    @endphp
                    <a class="list-group-item list-group-item-action  {{ $tab_active }}" id="list-otherEstates-list"
                       xdata-toggle="list"
                       href="{{ route('estate_other_estates') }}" role="tab" aria-controls="otherEstates"><span class="pl-5">Other Estates</span></a>
                    @php
                    $tab_active = URL::current()== route('estate_grow_estate') ? 'active disabled' : '';
                    @endphp
                    <a class="list-group-item list-group-item-action  {{ $tab_active }}" id="list-grow-list"
                       xdata-toggle="list"
                       href="{{ route('estate_grow_estate') }}" role="tab" aria-controls="grow"><span class="pl-5">Grow My Estate</span></a>
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
                                         src="https://mdbootstrap.com/img/Photos/Slides/img%20(68).jpg"
                                         alt="First slide">

                                    <div class="mask rgba-black-light"></div>
                                </div>
                                <div class="carousel-caption">
                                    <h3 class="h3-responsive"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}sponsor_fidelity.png" alt=""></h3>

                                    <p>401k Strategies</p>
                                    <button type="button" class="btn_sponsor">Learn More</button>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="view">
                                    <img class="d-block w-100 sponsors"
                                         src="https://mdbootstrap.com/img/Photos/Slides/img%20(6).jpg"
                                         alt="Second slide">

                                    <div class="mask rgba-black-strong"></div>
                                </div>
                                <div class="carousel-caption">
                                    <h3 class="h3-responsive">KLE Financial LLC</h3>

                                    <p>Tax & Retirement Planning</p>
                                    <button type="button" class="btn_sponsor">Learn More</button>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="view">
                                    <img class="d-block w-100 sponsors"
                                         src="https://mdbootstrap.com/img/Photos/Slides/img%20(9).jpg"
                                         alt="Third slide">

                                    <div class="mask rgba-black-slight"></div>
                                </div>
                                <div class="carousel-caption">
                                    <h3 class="h3-responsive">Edward Jones</h3>

                                    <p>Estate Planning</p>
                                    <button type="button" class="btn_sponsor">Learn More</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--/.Carousel Wrapper-->


                    <!-- /sponsor Carousel -->

                </div>
                <!-- /col-lg-3 -->


                <!-- original col-lg-9 -->
                @php
                    // include 'index-nav-newV3HOLD.php';
                @endphp
                @include('project.estates.index-nav-newV3HOLD')
            </div>
        </div>
    </main>

    <!-- Help Center -->
    @php // include 'HelpCenter/help_index.php'; @endphp
    @include('project.estates.HelpCenter.help_index')
    <!-- /Help Center -->
    @php // include 'index-new-modals.php' @endphp
    @include('project.estates.index-new-modals')
    @php //include_once '../includes/footer.php'; @endphp
    @include('project.layouts.footer')
@endsection
