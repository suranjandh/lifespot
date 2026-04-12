<style>
    .myEstate-height {
        min-height: 820px;
    }

    .pointer {
        cursor: pointer;
    }

    #healthOngoingCare {
        /* border: 5px solid yellowgreen; */
        /* height: 500px; */
        /* background-color: hotpink; */
    }

    .mySpace {
        padding-top: 300px;
    }

    /* .estateCardsActive:hover{
      border: 5px solid yellowgreen;
    } */

    .estateCardsActive {
        border: 4px solid transparent;
        /* border: 4px solid red; */
    }

    /* .border-forms {
      height:630px;
    } */
    .mystyle {
        border: 4px solid yellowgreen;
        /* border: 5px solid greenyellow; */
        /* border: 5px solid dodgerblue; */
    }

    .card-subject {
        /* padding-left: 25px; */
        padding: 2px 0 0 30px;
        color: grey-text;
    }

    .myEstateForm {
        display: none;
    }
</style>

<div class="myEstate-height">
    <!-- card deck -->
    <div class="card-deck mb-4">
        <!--Panel-->
        <div class="card pointer estateCardsActive toggleTwo text-center" id="financeRetireLink"
             onclick="financeRetire()" estate='4'>
            <div class="card-body">
                <h5 class="card-title">Financial & Retirement</h5>
                <!-- <p class="card-text card-subject">Estate</p>
                <p class="card-text  card-subject">estate</p>
                <p class="card-text  card-subject">Emergency Contacts</p> -->
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <!--/.Panel-->

        <!--Panel-->
        <div class="card pointer estateCardsActive toggleTwo text-center" id="healthOngoingCareLink"
             onclick="healthOngoingCare()" estate='5'>
            <div class="card-body">
                <h5 class="card-title">Health Care / Ongoing Care</h5>
                <!-- <p class="card-text  card-subject">Marital Status</p>
                <p class="card-text  card-subject">Dependents</p>
                <p class="card-text  card-subject">Beneficiaries</p>
                <p class="card-text card-subject">Pets</p> -->
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 1 month ago</small>
            </div>
        </div>
        <!--/.Panel-->

        <!--Panel-->
        <div class="card pointer estateCardsActive toggleTwo text-center" id="myWishesLink" onclick="myWishes()"
             estate='6'>
            <div class="card-body">
                <h5 class="card-title">My Wishes</h5>
                <!-- <p class="card-text  card-subject">Military</p>
                <p class="card-text  card-subject">Employment</p>
                <p class="card-text  card-subject">Education</p>
                <p class="card-text  card-subject">Volunteer</p> -->
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 7 days ago</small>
            </div>
        </div>
        <!--/.Panel-->
    </div>
    <!-- card deck -->

    <!-- <div class="mb-5"></div> -->

    <!--Panel-->


    <div class="cardForm2 myEstateForm showMyFinance" rel='estate_4'>
        <!--.Panel-->
        <div class="card xtext-center border-forms">
            <div class="card-header">


                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#financeRetire-banking-form">Banking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#financeRetire-realEstate-form">Real Estate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#financeRetire-assets-form">Assets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#financeRetire-retirement-form">Retirement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#financeRetire-tax-form">Tax</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#financeRetire-business-form">Business</a>
                    </li>

                </ul>

            </div>
            <div class="card-body tab-content pt-4">
                <div class="form-group tab-pane fade in show active" id="financeRetire-banking-form" role="tabpanel">


                    @include('project.estates.forms.Financial-Retirement.banking')
                </div>
                <div class="form-group tab-pane fade in" id="financeRetire-realEstate-form" role="tabpanel">


                    @include('project.estates.forms.Financial-Retirement.realEstate')

                </div>
                <div class="form-group tab-pane fade in" id="financeRetire-assets-form" role="tabpanel">


                    @include('project.estates.forms.Financial-Retirement.assets')


                </div>
                <div class="form-group tab-pane fade in" id="financeRetire-retirement-form" role="tabpanel">


                    @include('project.estates.forms.Financial-Retirement.retirement')


                </div>
                <div class="form-group tab-pane fade in" id="financeRetire-tax-form" role="tabpanel">

                    @include('project.estates.forms.Financial-Retirement.tax')

                </div>
                <div class="form-group tab-pane fade in" id="financeRetire-business-form" role="tabpanel">

                    @include('project.estates.forms.Financial-Retirement.business')

                </div>


            </div>
        </div>
        <!--/.Panel-->
    </div>
    <!-- // END// -->
    <div class="cardForm2 myEstateForm" rel='estate_5'>
        <!--.Panel-->
        <div class="card xtext-center border-forms">
            <div class="card-header">


                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#healthOngoingCare-health-form">Health
                            Insurance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#healthOngoingCare-dental-form">Dental Insurance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#healthOngoingCare-longTerm-form">Long Term Care</a>
                    </li>

                </ul>

            </div>
            <div class="card-body tab-content pt-4 xpx-0">

                <div class="form-group tab-pane fade in show active" id="healthOngoingCare-health-form" role="tabpanel">

                    @include('project.estates.forms.Health-OngoingCare.healthInsur')

                </div>

                <div class="form-group tab-pane fade in" id="healthOngoingCare-dental-form" role="tabpanel">

                    @include('project.estates.forms.Health-OngoingCare.dentalInsur')

                </div>

                <div class="form-group tab-pane fade in" id="healthOngoingCare-longTerm-form" role="tabpanel">

                    @include('project.estates.forms.Health-OngoingCare.longTerm-care')

                </div>

            </div>
        </div>
        <!--/.Panel-->
    </div>
    <!-- // END// -->
    <div class="cardForm2 myEstateForm" rel='estate_6'>
        <!--.Panel-->
        <div class="card xtext-center border-forms">
            <div class="card-header">


                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#financeRetire-wishes1-form">Wishes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#financeRetire-wishes2-form">Wishes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#financeRetire-wishes3-form">Wishes</a>
                    </li>

                </ul>

            </div>
            <div class="card-body tab-content">
                <div class="form-group tab-pane fade in show active" id="financeRetire-wishes1-form" role="tabpanel">
                    @include('project.estates.forms.Wishes.wishes')
                </div>
                <div class="form-group tab-pane fade in" id="financeRetire-wishes2-form" role="tabpanel">

                    @include('project.estates.forms.Wishes.wishes')

                </div>
                <div class="form-group tab-pane fade in" id="financeRetire-wishes3-form" role="tabpanel">

                    @include('project.estates.forms.Wishes.wishes')

                </div>
                <div class="form-group tab-pane fade in" id="sample-newMemberForm" role="tabpanel">

                    @include('project.estates.forms.Wishes.wishes')

                </div>
            </div>
        </div>
        <!--/.Panel-->
    </div>
    <!-- // END// -->

</div>
