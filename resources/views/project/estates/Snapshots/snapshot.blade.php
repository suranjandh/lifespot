<!-- Modal-Snapshot -->
<div class="modal fade" id="snapShotModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style=" overflow-y:auto;!important;"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-primary modal-lg" role="document">

        <!--Content-->
        <div class="modal-content">

            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">MyLifeSpot:
                    <span class="snapShot_header bind_estate_name">The Brandon Walker Family Estate</span>
                </p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="xtext-center">

                    <div class="bind_estate_card">

                    </div>

                    <div class="bind_profile_card">

                    </div>

                    <div class="bind_spouse_card">

                    </div>

                    <div class="bind_dependents_card">

                    </div>

                    <div class="bind_emergency_contact_card">

                    </div>


                    <div class="bind_beneficiary_card">

                    </div>

                    <div class="bind_pet_card">

                    </div>

                    {{--@php include 'incomplete_snapshot_static.php' @endphp--}}

                    @include('project.estates.Snapshots.incomplete_snapshot_static')

                </div>
                <!-- /xtext-center -->
            </div>
            <!--/Body-->

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <!-- <a type="button" class="btn btn-primary">Get it now <i class="far fa-gem ml-1 text-white"></i></a> -->
                <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Close</a>
            </div>
            <!--/Footer-->

        </div>
        <!--/.Content-->

    </div>
    <!-- /modal-dialog modal-notify modal-primary modal-lg -->
</div>
<!-- Modal-Snapshot-->