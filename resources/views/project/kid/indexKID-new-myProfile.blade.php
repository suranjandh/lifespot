<style>
    .myProfile-height {
        min-height: 820px;
    }

    .pointer {
        cursor: pointer;
    }

    #myFamily {
    }

    .mySpace {
        padding-top: 300px;
    }

    .estateCardsActive {
        border: 4px solid transparent;
    }

    .border-forms {
        height: 640px;
    }

    .mystyle {
        border: 4px solid yellowgreen;
    }

    .card-subject {
        padding: 2px 0 0 30px;
        color: grey-text;
    }

    .tab-content .tab-pane .border-forms {
        height: 650px;
    }
</style>

<div class="myProfile-height">
    <!-- card deck -->
    <div class="card-deck mb-4">
        <!--Panel-->
        <div class="card pointer profileCardsActive toggle text-center switch_category_tab_1" id="aboutMeLink"
             onclick="aboutMe()"
             profile='1'>
            <div class="card-body">
                <h5 class="card-title">About Me</h5>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>

    </div>
    <!-- card deck -->
    <!--Panel-->
    <div class="cardForm myProfileForm showMyFamily" rel='profile_1'>
        <!--.Panel-->
        <div class="card xtext-center border-forms" xid="myFamily">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link active switch_sub_category_tab_1" data-toggle="tab"
                           href="#aboutMe-site-form">Site</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link switch_sub_category_tab_2" data-toggle="tab" href="#aboutMe-profile-form" id="aboutMe-profile-form-trigger">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link switch_sub_category_tab_3" data-toggle="tab"
                           href="#friends_content-main" id="aboutMe-emergencyContacts-form-trigger">Friends</a>
                    </li>
                </ul>
            </div>
            <div class="card-body tab-content pt-4">
                <div class="form-group tab-pane fade in show active" id="aboutMe-site-form" role="tabpanel">
                    {{--@php
                    include 'MyProfile/AboutMe/Site/siteKID.php';
                    @endphp--}}
                    @include('project.kid.MyProfile.AboutMe.Site.siteKID')
                </div>
                <div class="form-group tab-pane fade in" id="aboutMe-profile-form" role="tabpanel">
                    {{--@php include 'MyProfile/AboutMe/Profile/profilesKID.php'; @endphp--}}

                    @include('project.kid.MyProfile.AboutMe.Profile.profilesKID')

                </div>
                <div class="form-group tab-pane fade in" id="friends_content-main" role="tabpanel">

{{--
                    @php include 'MyProfile/AboutMe/Friends/friend_box_processor.php'; @endphp
--}}
                    @include('project.kid.MyProfile.AboutMe.Friends.friend_box_processor')
                </div>

            </div>
        </div>
        <!--/.Panel-->
    </div>

    <!-- // END// -->
</div>


