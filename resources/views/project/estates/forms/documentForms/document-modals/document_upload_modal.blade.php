@php
    $category_tree = \App\CategorySub::category_tree();
    $categories = \App\Category::all();
    $members_set =  \App\Member::where('member_owner_user_id',auth()->user()->id)->get();
    $document_category_auto = \Illuminate\Support\Facades\Input::get('document_category_auto');
    $document_category_auto = $document_category_auto && $document_category_auto > 0 ? $document_category_auto : false ;
@endphp
<!--Header-->
<div class="modal-header">
    <p class="heading lead">Document Upload Tool
    </p>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="white-text">×</span>
    </button>
</div>

<!--Body-->
<form class="text-center border border-light p-5" id="document_upload_form">

    <div class="modal-body">
        <div class="text-center">
            <i class="far fa-file-alt fa-4x mb-3 animated rotateIn"></i>
            <p>
                <strong>Easily Store and Share Your Documents</strong>
            </p>

            <p><span class="circle"><span class="myNum">1</span></span> Select "type of content" <span
                        class="circle"><span
                            class="myNum">2</span></span> date it! <span class="circle"><span
                            class="myNum">3</span></span>
                upload it!
                <span class="circle"><span class="myNum">4</span></span> name it!
            </p>
            <strong>Choose who sees it.</strong>
        </div>


        <!-- Form Layout -->
        <div class="row">

            <!-- Storing Col -->
            <div class="col mr-5">
                <span class="d-flex justify-content-center blue-text xmt-3 mb-2">Storing</span>

                <!-- Type of Content -->
                <label for="document_content_type" class="float-left">Content Type</label>
                <!-- <select class="browser-default custom-select mb-4"> -->
                <select id="document_content_type" class="mdb-select mb-4"
                        searchable="Search here..">
                    <option value="" xdisabled selected>Choose option</option>


                </select>


                <div class="md-form">
                    <label for="document_created">Date document created ...</label>
                    <br>
                    <input placeholder="Selected date" type="text" id="document_created"
                           class="white form-control">
                </div>


            </div>
            <!-- end Storing Col -->

            <!-- Sharing Col -->
            <div class="col">
                <!-- Sharing this Document -->
                <span class="d-flex justify-content-center blue-text xmt-3 mb-4">Sharing</span>
                <div class="row">
                    <div class="col">

                        <!-- Default unchecked disabled -->
                        <div class="d-flex custom-control custom-checkbox">
                            <input type="checkbox" id="document_share_role_1"
                                   class="custom-control-input document_share_role" value="100_150"
                                   xdisabled>
                            <label class="custom-control-label"
                                   for="document_share_role_1">Executor/Co-Executors</label>
                        </div>

                        <!-- Default checked disabled -->
                        <!-- <div class="d-flex custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="defaultCheckedDisabled2" xchecked xdisabled>
                          <label class="custom-control-label" for="defaultCheckedDisabled2">Trustee/Co-Trustee/Successor's Trustee</label>
                        </div> -->

                        <!-- Default checked disabled -->
                        <div class="d-flex custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="document_share_members_all" xchecked
                                   xdisabled>
                            <label class="custom-control-label" for="document_share_members_all">All Members</label>
                        </div>
                        <p class="d-flex xmb-0"></p>
                        <a class="d-flex" href="" data-toggle="collapse" data-target="#collapseMembers">Select by Member
                            to Share</a>
                        <!--                        <button data-toggle="collapse" data-target="#demo">Collapsible</button>
                        -->
                        <div id="collapseMembers" class="collapse">
                            @if ($members_set)
                                @foreach ($members_set as $member)
                                    <div class="d-flex custom-control custom-checkbox">

                                        <input type="checkbox" style="float: left"
                                               class="custom-control-input member_share"
                                               id="member_share_{{ $member->member_id }}"
                                               value="{{ $member->member_id }}" xchecked
                                               xdisabled>
                                        <label style="float: left" class="custom-control-label"
                                               for="member_share_{{ $member->member_id }}">{{ $member->get_member_full_name($member) }}</label><br>
                                    </div>
                                @endforeach
                            @else
                                No members yet in your lifespot.
                            @endif

                        </div>
                    </div>

                </div>
            </div>
            <!-- end Sharing Col -->

        </div>
        <!--  <div class="file-field">
              <div class="btn btn-primary btn-sm float-left">
                  <span>Choose file</span>
                  <input type="file" name="document_file" id="document_file">
              </div>
              <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" name="document_file_name" id="document_file_name"  placeholder="Edit name after uploading">
              </div>

          </div>-->
        <div class="file-field">
            <div class="btn btn-primary btn-sm float-left" style="width: 150px;">
                <span>Choose file</span>
                <input type="file" name="document_file" id="document_file" style="width:inherit">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" name="document_file_name" id="document_file_name" type="text"
                       placeholder="Upload your file">
            </div>
        </div>
        <!-- /Form Layout -->

        <hr>

        <!-- <small class="d-flex justify-content-center blue-text xpt-3">Details</small> -->
        <!--Accordion wrapper-->
        <div class="accordion md-accordion" id="DocDetails" role="tablist" aria-multiselectable="true">

            <!-- Accordion card -->
            <div class="card">

                <!-- Card header -->
                <div class="card-header" role="tab" id="headingDocDetatils1">
                    <a class="collapsed" id="collapseDocDetatilsSet" data-toggle="collapse" data-parent="#DocDetails"
                       href="#collapseDocDetatils1"
                       aria-expanded="false"
                       aria-controls="collapseDocDetatils1">
                        <h5 class="mb-0">
                            <small class="d-flex justify-content-center blue-text xpt-3">Details <i
                                        class="fas fa-angle-down rotate-icon blue-tex ml-3"></i></small>
                        </h5>
                    </a>
                </div>

                <!-- Card body -->
                <div id="collapseDocDetatils1" class="collapse xshow" role="tabpanel"
                     aria-labelledby="headingDocDetatils1" data-parent="#DocDetails">
                    <div class="card-body">
                        <!-- Category -->
                        <label class="d-flex" for="document_category">Category:</label>
                        <select id="document_category" class="browser-default custom-select mb-4">
                            @if (!($document_category_auto > 0))
                                <option value="0" selected="selected">Select</option>
                            @endif
                            @foreach ($categories as $v)
                                @if ($document_category_auto && $v->category_id != $document_category_auto)
                                    @php continue; @endphp
                                @endif
                                <option value="{{ $v->category_id }}">{{ html_entity_decode($v->category_name) }}</option>
                            @endforeach

                        </select>

                        <!-- Sub Category -->
                        <label class="d-flex" for="document_category_sub">What to associate with:</label>
                        <select id="document_category_sub" class="browser-default custom-select mb-4">
                        </select>
                        <!-- <select id="document_category_sub"  class="browser-default custom-select mb-4">
                             <option value="" disabled>Choose option</option>
                             <option value="1" selected>Estate</option>
                             <option value="2">Profile</option>
                             <option value="3">Emergency Contacts</option>
                         </select>-->

                        <!-- Sub Sub Category -->
                        <label for="document_category_sub_sub" class="d-flex">Associate document with:</label>
                        <select id="document_category_sub_sub" class="browser-default custom-select mb-4">
                        </select>
                        <!--<select id="document_category_sub_sub"  class="browser-default custom-select mb-4">
                            <option value="" disabled>Choose option</option>
                            <option value="1" selected>Name of LifeSpot Owner goes here</option>
                            <option value="2">Spouse Name</option>
                            <option value="3">Dependent Name</option>
                            <option value="4">Member Name</option>
                        </select>-->

                        <!-- Sub Sub Sub Category -->
                        <label for="document_category_sub_sub_sub" class="d-flex">Document is tied to:</label>
                        <select id="document_category_sub_sub_sub" class="browser-default custom-select mb-4">
                        </select>
                        <!--<select id="document_category_sub_sub_sub" class="browser-default custom-select mb-4">
                            <option value="" disabled>Choose option</option>
                            <option value="1" selected>N/A</option>
                            <option value="2">Specific Form-Profile</option>
                            <option value="3">Specific Form-Guardian</option>
                            <option value="4">Specific Form-Medical</option>
                            <option value="5">Specific Form-School</option>
                        </select>-->

                        <!-- Notes -->
                        <div class="form-group">
                            <textarea class="form-control rounded-0" id="document_notes" rows="3"
                                      placeholder="Notes about this document"></textarea>
                        </div>
                        <br>
                        <!-- <hr> -->
                    </div>
                </div>

            </div>
            <!-- Accordion card -->


        </div>
        <!-- Accordion wrapper -->


    </div>

    <!--Footer-->
    <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-primary waves-effect waves-light" id="add_documents" data-dismiss="modal">Add
            Document
            <i class="fas fa-upload ml-1"></i>
        </a>
        <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancel</a>
    </div>
</form>