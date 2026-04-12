@php
    // include dirname(dirname(dirname(dirname(__FILE__)))) . '/lib/includes/header_include.php';

    //$member_obj = new MemberModel();
    $members_set = \App\Member::where('member_owner_user_id',auth()->user()->id)->get();//$member_obj->get_members_by_owner_user_id($_SESSION->loggedInUser);
    ob_start();
@endphp
@foreach ($members_set as $k => $member)
    @php
        $name = $member->member_first_name . ' ' . $member->member_last_name;

        //$roles_set = explode('|', $member->member_role_in_estate);
        $member_roles = $member->roles ;
                    $main_role =  $member->main_role($member_roles) ;
                    $roles_set_first = $main_role != null  ?  $main_role->role_name : "";
                                    $roles_set_first_id = $main_role != null   ? $main_role->role_id : 0;
                    $roles_set_first = $roles_set_first ? $roles_set_first : 'No Role';
        //$roles_set_first = $roles_set[0];
    @endphp
    <!-- ========================================= -->
    <!-- Section: Magazine v.3 -->
    @if ($k % 3 == 0)
        <section class="magazine-section my-5">
            <!-- Grid row -->
            <div class="row">
            @endif

            <!-- Grid column -->
                <div class="col-lg-4 col-md-12 mb-lg-0 mb-5 member_overview_card"
                     data-member-id="{{$member->member_id}}">

                    <!-- Featured news -->
                    <div class="single-news mb-3">
                        <div class="view overlay rounded z-depth-2 mb-4">
                            <!-- <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/86.jpg" alt="Sample image"> -->

                            <!-- Image -->
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Grid row -->
                        <div class="row mb-3">

                            <!-- Grid column -->
                            <div class="col-12">

                                <!-- Badge -->
                                <a href="#!"><span class="badge"
                                                   style="background-color: {{\App\Role::role_colors($roles_set_first_id)}};">{{$roles_set_first}}</span></a>

                            </div>
                            <!-- Grid column -->

                        </div>
                        <!-- Grid row -->

                        <!-- Title -->
                        <div class="d-flex justify-content-between">
                            <div class="col-11 text-truncate pl-0 mb-3">
                                <a class="font-weight-bold">{{$name}}</a>
                            </div>
                        </div>

                    </div>
                    <!-- Featured news -->


                    <!-- Small news -->
                    <div class="single-news mb-3">

                        <!-- Title -->
                        <div class="d-flex justify-content-between">
                            <div class="col-11 text-truncate pl-0 mb-3">
                                <a>Shared Information</a>
                            </div>
                            <a class="get_shared_information_to_member"><i class="fa fa-angle-double-right"></i></a>
                        </div>
                        <div class="d-flex justify-content-between data_display"></div>
                    </div>
                    <!-- Small news -->

                    <!-- Small news -->
                    <div class="single-news">

                        <!-- Title -->
                        <!-- <div class="d-flex justify-content-between">
                          <div class="col-11 text-truncate pl-0">
                            <a></a>
                          </div>
                          <a><i class="fa fa-angle-double-right"></i></a>
                        </div> -->

                    </div>
                    <!-- Small news -->

                </div>
                <!-- Grid column -->


                @if ((($k - 2) % 3 == 0) || $k + 1 == count($members_set))
            </div>
            <!-- Grid row -->

        </section>
    @endif
    <!-- Section: Magazine v.3 -->
@endforeach
@php
    $out = ob_get_contents();
    ob_end_clean();
    echo $out;
    die();
@endphp