<div class="col-lg-9 pt-0" id="my-card-background">
    <!-- Content -->
    <div class="tab-content" id="nav-tabContent">

        @if (URL::current()== route('kid_index'))
            <div class="tab-pane fade show active" id="list-dashboard" role="tabpanel"
                 aria-labelledby="list-dashboard-list">

                {{--include 'indexKID-new-dashboard.php';--}}
                @include('project.kid.indexKID-new-dashboard')

            </div>
        @elseif(URL::current()== route('kid_messages'))
            <div class="tab-pane fade show active" id="list-messages" role="tabpanel"
                 aria-labelledby="list-messages-list">
{{--
                include SITE_BASE_PATH . '/project/estates/messageCenterA/messages.php';
--}}
                @include('project.estates.messageCenterA.messages')

            </div>
        @elseif(URL::current()== route('kid_profile'))
            <div class="tab-pane fade show active" id="list-profile" role="tabpanel"
                 aria-labelledby="list-profile-list">
{{--
                include 'indexKID-new-myProfile.php';
--}}
            @include('project.kid.indexKID-new-myProfile')
            </div>
        @elseif(URL::current()== route('kid_members'))
            <div class="tab-pane fade show active" id="list-members" role="tabpanel"
                 aria-labelledby="list-members-list">
                <div id="members-content">
                   {{-- include SITE_BASE_PATH . '/project/estates/forms/memberForms/member_box_processor.php';--}}
                    @include('project.estates.forms.memberForms.member_box_processor')
                </div>
            </div>
        @endif


    </div>
    <!-- Content -->
</div>
<!-- container-fluid -->