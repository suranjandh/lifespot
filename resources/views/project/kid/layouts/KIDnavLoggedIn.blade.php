<style>
    .estatePic {
        height: 75px;
        min-width: auto;
    }

    .cogColor {
        color: rgb(58, 113, 183);
    }

    .title-color {
        color: rgb(104, 99, 98);
    }

    .logOut {
        font-size: .9em;
    }

    .item1 {
        grid-area: myArea;
    }

    .item2 {
        grid-area: estateName;
    }

    .item3 {
        grid-area: jointAcct;
        align-items: start;
    }

    .item4 {
        grid-area: logOut;
        align-items: start;
    }

    .item9 {
        grid-area: estateImg;
        /* justify-content: center; */
        margin: 0 auto;
        /* float: right; */
    }

    .grid-container {
        display: grid;
        width: 100%;
        grid-template-areas: 'myArea estateName estateName estateName estateName   estateImg' 'myArea jointAcct jointAcct jointAcct   logOut estateImg';
        grid-auto-rows: 40px;
        /* grid-gap: 10px; */
        /* background-color: #2196F3; */
        /* padding: 10px; */
    }

    .grid-container > div {
        background-color: rgba(255, 255, 255, 0.8);
        text-align: center;
        /* padding: 20px 0; */
        font-size: 20px;
    }

    .pb-5{
        margin-top: -30px;
    }
</style>
<section class="signedIn mb-4">
    <nav class="navbar navbar-expand-lg navbar-light white fixed-top">

        <div class="grid-container mt-1">
            <div class="item1">
                @include('layouts.main.logo')
            </div>
            <div class="item2"><span
                        class="d-flex justify-content-end h3-responsive title-color bind_site_name"
                        style="text-transform:capitalize" xdata-target="estateName1"
                        data-added-estate-name="0">
                            {{ ' ' . auth()->user()->first_name . ' ' . auth()->user()->last_name . ' ' }}
                        </span></div>
            <div class="item3">                        <span>


                        </span></div>

            <div class="item4 d-flex justify-content-end">
                <a href="{{ Config::get('constants.SITE_LOGOUT_URL') }}"
                   class="d-flex justify-content-end p-responsive title-color logOut"><i
                            class="fas fa-sign-out-alt mt-1 mr-1"></i> Logout</a>
                <a data-toggle="modal" data-target="#settingsModal"><i
                            class="fas fa-cog xfa-xs cogColor xpull-right ml-3"></i></a>
            </div>

            <div class="item9"><span class="d-flex justify-content-end title-color">
                            <img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}generic_Defaultfamily.png"
                                 class="img-fluid estatePic estate_image_image"
                                 alt="Estate Picture">
                        </span></div>
        </div>
    </nav>
</section>