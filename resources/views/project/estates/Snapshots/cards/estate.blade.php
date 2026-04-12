@php

    //$estate = new EstateModel();
    //$member = new MemberModel();
    $estate = auth()->user()->estate  ;//$estate->get_estate_by_estate_user_id($userId);
    $members_in_estate = auth()->user()->members ; // $member->get_members_by_owner_user_id($userId);

@endphp
<div class="card border-primary mb-3 member_content_box cancel_click" xstyle="max-width: 20rem;" style="display:none;"
     data-member-member-id="{{$estate->estate_id}}" data-member-id="{{$estate->estate_id}}"
     data-member-type="estate"
     data-member-name="{{$estate->get_estate_name($estate)}}"
>

    <div class="card-header">My Estate
        <a href="#" class="open_account_info_share_overview"><img class="float-right xmr-3" data-toggle="tooltip"
                                                                  title="Share"
                                                                  src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-share.png"
                                                                  alt=""></a>
        <a href="#"
           onclick="window.open('{{route('print_snapshot')}}?print=estate');"
        ><img class="float-right mr-3" data-toggle="tooltip" title="Print"
              src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-print.png" alt=""></a>
        <a href="#"
           class="document_tabs_open"
           data-document-category="1"
           data-document-category-sub="1"
           data-document-category-sub-sub="0"
        ><img class="float-right mr-3" data-toggle="tooltip" title="Documents"
              src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-documents.png"
              alt=""></a>
        <a href="#"
           class="member_content_box"
           data-member-member-id="{{$estate->estate_id}}" data-member-id="{{$estate->estate_id}}"
           data-member-type="estate"
        ><img class="float-right mr-3" data-toggle="tooltip" title="Edit"
              src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-edit.png"
              alt=""></a>
    </div>
    <div class="card-body text-primary">
        <h5 class="xcard-title bind_estate_name">{{$estate->get_estate_name($estate)}}</h5>
        <span class=" main_info bind_main_info">Co-Trustees & Estate Owner(s): {{$estate->estate_owner_name}}</span><br>

        <span class="secondary_info">
                <span class="info_emphasis">Location:</span>
                <span class="details bind_estate_address">{!! Helper::fill_empty_string($estate->get_estate_location($estate))!!}</span>
              </span>
        <span class="secondary_info">
                <span class="info_emphasis bind_estate_notes">Notes:</span>
                <span class="details">{!!Helper::fill_empty_string($estate->estate_notes)!!}</span>
              </span>
        <span class="secondary_info"></span>
        <!-- <span class="info_emphasis">Members</span> -->
        <span class="xdetails"></span>
        <!--Accordion wrapper-->
        <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

            <!-- Accordion card -->
            <div class="card m-0">

                <!-- Card header -->
                <div class="card-header pl-0 pt-1 pb-0" role="tab" id="headingOne1">
                    <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseMembers" aria-expanded="true"
                       aria-controls="collapseMembers" class="m-0 p-0">
                        <h6 class="text-primary xm-0 xp-0 ">
                            Members of My Estate
                            <!-- <i class="fas fa-angle-down rotate-icon float-left mr-3"></i> -->
                        </h6>
                    </a>
                </div>

                <!-- Card body -->
                <div id="collapseMembers" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
                     data-parent="#accordionEx">
                    <div class="card-body p-0">

                        <!-- Members List-->
                        <div class="card-body member-box text-primary xmt-0 pt-0">

                        {{--@php include 'estate_members.php' @endphp--}}
                        @include('project.estates.Snapshots.cards.estate_members')
                        <!-- /class="collapse" id="member7" -->

                        </div>
                        <!-- card-body -->
                        <!-- /Members -->
                    </div>
                </div>

            </div>
            <!-- Accordion card -->
        </div>
        <!-- Accordion wrapper -->

    </div>
</div>