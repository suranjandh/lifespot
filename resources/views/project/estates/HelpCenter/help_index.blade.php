<style>
    .helpCenter{
        color: rgb(193, 52, 46);
        font-weight: 400;
        font-size: 3.2rem;
    }
    .helpCenter_line {
        background-color: rgb(193, 52, 46);
        padding:0;
        margin: 0;
    }
    .helpCenterMsg {
        color: black;
        font-weight: 700;
        font-size: 1.9rem;
    }
    .learningCenter{
        list-style: none;
        /* margin-left: 0; */
        padding-left: 5px;
    }
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
        bottom: .5em;
    }
</style>

<!--Modal: modalRelatedContent-->
<div class="modal fade xright" id="modalRelatedContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog xmodal-side modal-bottom-left modal-notify modal-info modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading">LifeSpot Help Center</p>
                <!-- <img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}FAQs.jpg" alt=""> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">

                <div class="row">
                    <div class="col-7">
                        <span class="helpCenter">Help Center</span>
                        <hr class="helpCenter_line">
                        <span class="helpCenterMsg">What do you need help with?</span>
                        <p><i>Learn by watching videos or by reading documentation.</i></p>
                    </div>
                    <div class="col-2 xml-1 my-3"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}question.png" alt=""></div>
                    <div class="col-3"></div>
                </div>

                <br>
                <table id="dtHelpCenter" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm black-text">What do you want to learn?
                        </th>
                        <th class="th-sm black-text">Learn by watching
                        </th>
                        <th class="th-sm black-text">Learn by reading
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Why Use LifeSpot</td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <td>Getting Started</td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <td>About the Dashboard</td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>

                    <tr>
                        <td>Uploading Documents</td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <td>Inviting Members</td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <td>Sharing Information</td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <td>Exporting Information</td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <td>Grow My Estate</td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href=""><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <td>The Message Center</td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <td>Member Cards</td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <td>WebSpot</td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <td>Grow My Estate</td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <td>Message Center</td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>

                    <tr>
                        <td>Document Center</td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>

                    <tr>
                        <td>Deleting Your Account</td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>

                    <tr>
                        <td>Deleting a Member</td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>

                    <tr>
                        <td>Earn Free Upgrades</td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <td>*Case Studies</td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-video.png" alt=""></a></td>
                        <td><a href="#"><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-document.png" alt=""></a></td>
                    </tr>

                    </tbody>

                </table>

                <small class="text-muted">*Case studies are simulations of how to use LifeSpot</small>




            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalRelatedContent-->

<script>
    $(document).ready(function () {
        $('#dtHelpCenter').DataTable({
            "ordering": false // false to disable sorting (or any other option)
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>