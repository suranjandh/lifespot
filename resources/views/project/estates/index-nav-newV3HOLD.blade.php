<div class="col-lg-9 pt-0" id="my-card-background">
    <!-- Content -->
    <div class="tab-content" id="nav-tabContent">

        @if (URL::current()== route('estate_index'))
            <div class="tab-pane fade show active" id="list-dashboard" role="tabpanel"
                 aria-labelledby="list-dashboard-list">
                {{--@include('index-new-dashboard.php');--}}
                @include('project.estates.index-new-dashboard')

            </div>
        @elseif (URL::current()== route('estate_messages'))
            <div class="tab-pane fade show active" id="list-messages" role="tabpanel"
                 aria-labelledby="list-messages-list">
                {{-- @include('messageCenterA/messages.php');--}}
                @include('project.estates.messageCenterA.messages')
            </div>
        @elseif (URL::current()== route('estate_profile'))
            <div class="tab-pane fade show active" id="list-profile" role="tabpanel"
                 aria-labelledby="list-profile-list">
                @include('project.estates.index-new-myProfile')
            </div>

        @elseif (URL::current()== route('estate_estate'))
            <div class="tab-pane fade show active" id="list-myEstate" role="tabpanel"
                 aria-labelledby="list-myEstate-list">
                {{--@include('index-new-myEstate.php');--}}
                @include('project.estates.index-new-myEstate')
            </div>

        @elseif (URL::current()== route('estate_members'))
            <div class="tab-pane fade show active" id="list-members" role="tabpanel"
                 aria-labelledby="list-members-list">
               {{-- index-new-members.php--}}
                {{--                @include('index-new-members.php');--}}
                @include('project.estates.index-new-members')
            </div>
        @elseif (URL::current()== route('estate_documents'))
            <div class="tab-pane fade show active" id="list-documents" role="tabpanel"
                 aria-labelledby="list-documents-list">
                {{--                @include('index-new-documents.php');--}}
                @include('project.estates.index-new-documents')
            </div>
        @elseif (URL::current()== route('estate_webspot'))
            <div class="tab-pane fade show active" id="list-webspot" role="tabpanel"
                 aria-labelledby="list-webspot-list">
               {{--@include('index-new-webspot.php');--}}
                @include('project.estates.index-new-webspot')
            </div>

        @elseif (URL::current()== route('estate_other_estates'))
            <div class="tab-pane fade show active" id="list-otherEstates" role="tabpanel"
                 aria-labelledby="list-otherEstates-list">
{{--
                index-new-otherEstates.php
--}}
                @include('project.estates.index-new-otherEstates')
            </div>

        @elseif (URL::current()== route('estate_grow_estate'))
            <div class="tab-pane fade show active" id="list-grow" role="tabpanel" aria-labelledby="list-grow-list">
                {{--@include( 'index-new-growEstates.php');--}}
                @include('project.estates.index-new-growEstates')
            </div>
        @endif

    </div>
    <!-- Content -->
</div>
<!-- container-fluid -->