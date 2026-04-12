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

    .myProfileForm{
        display: none;
    }
</style>

<div class="myProfile-height">
    <!-- card deck -->
    <div class="card-deck mb-4">
        <!--Panel-->
        <div class="card pointer profileCardsActive toggle text-center switch_category_tab_1" id="aboutMeLink"
             profile='1' onclick="aboutMe()">
            <div class="card-body">
                <h5 class="card-title">About Me</h5>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <!--/.Panel-->
        <!--Panel-->
        <div class="card pointer profileCardsActive toggle text-center switch_category_tab_2" id="myFamilyLink"
             profile='2' onclick="myFamily()">
            <div class="card-body">
                <h5 class="card-title">My Family</h5>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 1 month ago</small>
            </div>
        </div>
        <!--/.Panel-->
        <!--Panel-->
        <div class="card pointer profileCardsActive toggle text-center switch_category_tab_3" id="WorkEducationLink"
             profile='3' onclick="workEducation()">
            <div class="card-body">
                <h5 class="card-title">Work & Education</h5>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 7 days ago</small>
            </div>
        </div>
        <!--/.Panel-->
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
                           href="#aboutMe-estate-form">Estate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link switch_sub_category_tab_2" data-toggle="tab" href="#aboutMe-profile-form">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link switch_sub_category_tab_4" data-toggle="tab"
                           href="#myFamily-family-form">Marital Status</a>
                    </li>

                </ul>
            </div>
            <div class="card-body tab-content pt-4">
                <div class="form-group tab-pane fade in show active" id="aboutMe-estate-form" role="tabpanel">
                    @php
                   // include './forms/About-Me/Estate/estates.php';
                    @endphp
                    @include('project.estates.forms.AboutMe.Estate.estates')
                </div>
                <div class="form-group tab-pane fade in" id="aboutMe-profile-form" role="tabpanel">
                    @php // include './forms/About-Me/Profile/profiles.php'; @endphp
                    @include('project.estates.forms.AboutMe.Profile.profiles')
                </div>
                <div class="form-group tab-pane fade in" id="myFamily-family-form" role="tabpanel">
                    @php
                  //  include './forms/My-Family/maritalStatus/maritalStatus.php';
                    @endphp
                    @include('project.estates.forms.MyFamily.maritalStatus.maritalStatus')
                </div>

                <div class="form-group tab-pane fade in" id="aboutMe-photos-form" role="tabpanel">
                    <p class="xcard-title float-left">Photos </p>

                    <p class="card-text mySpace">This view will contain the form for user input.</p>
                    <a href="#" class="btn btn-primary float-right">Update</a>
                </div>
            </div>
        </div>
        <!--/.Panel-->
    </div>
    <!-- // END// -->
    <div class="cardForm myProfileForm" rel='profile_2'>
        <!--.Panel-->
        <div class="card xtext-center border-forms" xid="myFamily">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">

                    <li class="nav-item dependent_nav">
                        <a class="nav-link active switch_sub_category_tab_5" data-toggle="tab"
                           href="#myFamily-dependents-form">Dependents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link switch_sub_category_tab_6" data-toggle="tab"
                           href="#myFamily-beneficiaries-form">Beneficiaries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link switch_sub_category_tab_3" data-toggle="tab"
                           href="#aboutMe-emergencyContacts-form">Emergency
                            Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link switch_sub_category_tab_7" data-toggle="tab"
                           href="#myFamily-pets-form">Pets</a>
                    </li>

                </ul>
            </div>
            <div class="card-body tab-content dependent_tab pt-4 xpx-0" style="height: 800px">

                <div class="form-group tab-pane fade in show active" id="myFamily-dependents-form" role="tabpanel">
                    @php
                    // include './forms/My-Family/dependents/dependents_initial_load.php';
                  //  include './forms/My-Family/dependents/dependents_cards.php';
                    @endphp
                    @include('project.estates.forms.MyFamily.dependents.dependents_cards')
                </div>
                <div class="form-group tab-pane fade in" id="myFamily-beneficiaries-form" role="tabpanel">
                    <!-- ajax loaded -->
                    @php
                   // include './forms/My-Family/beneficiaries/beneficiary_box_processor.php';
                    @endphp
                    @include('project.estates.forms.MyFamily.beneficiaries.beneficiary_box_processor')
                </div>
                <div class="form-group tab-pane fade in" id="aboutMe-emergencyContacts-form" role="tabpanel">
                    <!--ajax loaded-->
                    @php
                  //  include './forms/About-Me/emergency_contact/emergency_contact_box_processor.php';
                    @endphp
                    @include('project.estates.forms.AboutMe.emergency_contact.emergency_contact_box_processor')
                </div>
                <div class="form-group tab-pane fade in" id="myFamily-pets-form" role="tabpanel">
                    <!-- ajax loaded -->
                    @php
                   // include './forms/My-Family/pet/pet_box_processor.php';
                    @endphp
                    @include('project.estates.forms.MyFamily.pet.pet_box_processor')
                </div>


            </div>
        </div>
        <!--/.Panel-->
    </div>
    <!-- // END// -->
    <div class="cardForm myProfileForm" rel='profile_3'>
        <!--.Panel-->
        <div class="card xtext-center border-forms" xid="myFamily">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#aboutMe-employment-form">Employment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#aboutMe-education-form">Education</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#aboutMe-military-form">Military</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#aboutMe-volunteer-form">Volunteer</a>
                    </li>
                </ul>
            </div>
            <div class="card-body tab-content pt-4 xpx-0">
                <div class="form-group tab-pane fade in show active" id="aboutMe-employment-form" role="tabpanel">
                    @php
                   // include './forms/Work-Education/employment.php'
                    @endphp
                </div>
                <div class="form-group tab-pane fade in" id="aboutMe-education-form" role="tabpanel">
                    @php
                   // include './forms/Work-Education/education.php'
                    @endphp
                </div>
                <div class="form-group tab-pane fade in" id="aboutMe-military-form" role="tabpanel">
                    @php
                   // include './forms/Work-Education/military.php'
                    @endphp
                </div>
                <div class="form-group tab-pane fade in" id="aboutMe-volunteer-form" role="tabpanel">
                    @php
                   // include './forms/Work-Education/volunteer.php'
                    @endphp
                </div>
            </div>
        </div>
        <!--/.Panel-->
    </div>
    <!-- // END// -->
</div>


