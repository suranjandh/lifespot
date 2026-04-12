<style>
    #addNewMemberID1 #btnChangeNext-maritalStatus,
    #addNewMemberID1 #btnChangeNext-estate,
    #addNewMemberID1 #btnChangeNext-profile {
        /* visibility: hidden; */
        display: none;
    }


</style>
<!-- Snapshot of LifeSpot Owner's Estate -->
@php // include 'Snapshots/snapshot.php'; @endphp
<!-- /Snapshot of LifeSpot Owner's Estate -->

<!-- Modal documentShowModal-->
<!-- Trigger the modal with a button -->
<div style="visibility: hidden">
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" id="documentShowModalOpen"
            data-target="#documentShowModal">Open Modal
    </button>
</div>
<div id="documentShowModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="width: 100%">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <embed src="##URL##"
                       frameborder="0" width="100%" height="400px">


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- Modal documentShowModal End-->
<!-- Modal messageAttachmentShowModal -->
<div id="messageAttachmentShowModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="width: 100%">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <embed src="##URL##"
                       frameborder="0" width="100%" height="400px">


            </div>

            <div class="modal-footer">
                <a class="download_link"  href="" download><button type="button" class="btn btn-default btn-sm" >Download</button></a>  <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- Modal messageAttachmentShowModal END -->


<!-- Modal taskShowModal-->
<!-- Trigger the modal with a button -->

<!--Modal: About LifeSpot-->
<div class="modal fade" id="taskShowModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <!--Content-->
        <div class="modal-content">

            <!--Body-->
            <div class="modal-body mb-0 p-0">

                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                    <!-- <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/A3PDXmYoF5U" allowfullscreen></iframe> -->
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/TSDIstPsJsw"
                            allowfullscreen></iframe>
                </div>

            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center flex-column flex-md-row">
                <h3 class="xtext-center my-3 ml-2 mr-4">Welcome to LifeSpot</h3>
                <span class="xtext-center">Learn your way around LifeSpot!</span>

                <!-- <span class="mr-4">Spread the word!</span> -->

                <button type="button" class="btn btn-outline-primary btn-rounded btn-md mx-auto text-center"
                        width="30px;" data-dismiss="modal">Close
                </button>


            </div>

        </div>
        <!--/.Content-->

    </div>
</div>
<!--Modal: About LifeSpot-->


<!--Modal: About Welcome Task-->
<div class="modal fade" id="taskShowModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <!--Content-->
        <div class="modal-content">

            <!--Body-->
            <div class="modal-body mb-0 p-0">

                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                    <!-- <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/115098447" allowfullscreen></iframe> -->
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/A3PDXmYoF5U"
                            allowfullscreen></iframe>
                </div>

            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center flex-column flex-md-row">
                <h3 class="xtext-center my-3 ml-2 mr-4">LifeSpot guides you</h3>
                <span class="xtext-center">Understanding your dashboard and tasks!</span>

                <!-- <span class="mr-4">Spread the word!</span> -->

                <button type="button" class="btn btn-outline-primary btn-rounded btn-md mx-auto text-center"
                        width="30px;" data-dismiss="modal">Close
                </button>


            </div>

        </div>
        <!--/.Content-->

    </div>
</div>
<!--Modal: About Welcome Task-->
<!-- Modal taskShowModal End-->
<!-- Modal -->
<div class="modal fade" id="addNewMemberID1" tabindex="-1" role="dialog" aria-labelledby="addNewMemberLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-position" role="document">
        <div class="modal-content modal-size">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewMemberLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="add_new_member_modal">

            </div>
            <!-- /Modal Body -->
        </div>
    </div>
</div>
<!-- /End MODAL -->


<!-- Modal -->
<div class="modal fade" id="addNewdependentID1" tabindex="-1" role="dialog" aria-labelledby="addNewdependentLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-position" role="document">
        <div class="modal-content modal-size">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewdependentLabel">Dependent</h5>
                <button type="button" class="close dependents-closeBtn" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="add_new_dependent_modal">

            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<!-- Modal  documentTabsModal-->
<div class="modal fade" id="documentTabsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="document_tabs_modal_container">
            <!-- this file will be added here by ajax 'forms/documentForms/document-modals/document-tabs-modal.php';-->
        </div>
    </div>
</div>
<!-- Modal END -->

<!-- Modal MemberShareModal End-->
<!-- Modal -->
<div class="modal fade" id="MemberShareModal" tabindex="-1" role="dialog" aria-labelledby="MemberShareModal"
     aria-hidden="true">
    <div class="modal-dialog modal-position" role="document">
        <div class="modal-content modal-size">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <!-- /Modal Body -->
        </div>
    </div>
</div>
<!-- /End MODAL -->
<!-- Modal Other Estate-->
<div class="modal fade " id="other-estateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-position" role="document">
        <div class="modal-content modal-size">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <!-- /Modal Body -->
        </div>
    </div>
</div>
<!-- /End MODAL -->
<!-- Modal Account Overview-->
<div class="modal fade " id="accountOverviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-position" role="document">
        <div class="modal-content modal-size">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <!-- /Modal Body -->
        </div>
    </div>
</div>
<!-- /End MODAL -->

<!-- Modal Account Overview-->
<div class="modal fade " id="invitationEmailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-position" role="document">
        <div class="modal-content modal-size">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="main_message"></div>
                <div class="custom_message" style="border-top: 1px solid #000000">
                    <label for="custom_message_invitation_email">Custom Message</label>
                    <textarea class="form-control" style="width: 100%" name="custom_message_invitation_email"
                              id="custom_message_invitation_email"
                    ></textarea>
                </div>
                <div class="buttons">
                    <button class="btn btn-default buttons_set" id="invitation_email_preview" style="display: none">
                        Next
                    </button>
                    <button class="btn btn-default buttons_set" id="invitation_email_previous" style="display: none">
                        Previous
                    </button>
                    <button class="btn btn-primary buttons_set" id="invitation_email_send" style="display: none">Send
                    </button>
                    <button class="btn btn-danger buttons_set" id="invitation_email_discard" style="display: none">
                        Discard
                    </button>
                </div>
            </div>
            <!-- /Modal Body -->
        </div>
    </div>
</div>
<!-- /End MODAL -->


<!-- Modal User Delete-->
<div class="modal fade " id="lifeSpotDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-position" role="document">
        <div class="modal-content modal-size">
            <div class="modal-header">
                <h5 class="modal-title">Delete LifeSpot Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 50px">
                <div class="row">
                    <label for="lifespot_password">Please Enter your password for security</label>
                    <input class="form-control" id="lifespot_password" name="lifespot_password" value="">
                </div>
                <div class="row">
                    <label>Are you sure you want to delete your lifespot account ?</label><br>
                    <button class="btn btn-default" id="cancel_lifespot_delete">Cancel</button>
                    <button class="btn btn-danger" id="confirm_lifespot_delete">Confirm</button>
                </div>
            </div>
        </div>
        <!-- /Modal Body -->
    </div>
</div>

<!-- /End MODAL -->

<!-- Modal Message-->
<div class="modal fade " id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-position" role="document">
        <div class="modal-content modal-size">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 50px">

            </div>
        </div>
        <!-- /Modal Body -->
    </div>
</div>



