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
</style>
</head>
<body>
@php
    //$user_obj = new UserModel();
    //$user_id = $session_class->get_session_value('loggedInUser');
    //$estate_obj = new EstateModel();
    //$estate_found = $estate_obj->get_estate_by_estate_user_id($user_id);
    $estate_found_image = $estate_found && trim($estate_found->estate_image) != '' ? Config::get('constants.SITE_BASE_URL') .Config::get('constants.ESTATE_IMG_FOLDER') . '/' . $estate_found->estate_image . '?rand=' . rand(1, 1000) : Config::get('constants.PROJECT_IMAGE_URL').'generic_Defaultfamily.png';
@endphp
<section class="signedIn mb-4">
    <nav class="navbar navbar-expand-lg navbar-light white fixed-top">

        <div class="grid-container mt-1">
            <div class="item1">
                <a ><img src="{{Config::get('constants.PROJECT_IMAGE_URL')}}lifespotLogo/logo_vectorJ.png" height="60px;" alt=""></a>
                </div>
            <div class="item2"><span id="estate_name_added_by_estate"
                                     class="d-flex justify-content-end h3-responsive title-color"
                                     style="text-transform:capitalize" xdata-target="estateName1"
                                     data-added-estate-name="0">
                            {{$estate_found && $estate_found->estate_name !=''? $estate_found->estate_name : 'The ' . auth()->user()->first_name . ' ' . auth()->user()->last_name . ' Family Estate' }}
                        </span></div>
            <div class="item3">                        <span>

                            @php
                                $user_obj = new \App\User();
                                $husband_user_join_account = $user_obj->get_users_husband_user_join_account();
                            @endphp
                    @if ($husband_user_join_account || auth()->user()->spouse_logged > 0)


                    <a class="dashboard-spanText"
                       href="{{ auth()->user()->spouse_logged > 0 ?route('switch_from_husband_to_spouse') :route('log_spouse_to_husband') }}"><i
                                class="fas fa-arrow-left"></i> {{
                                    auth()->user()->spouse_logged > 0 ? 'You are in your spouse account. Switch to your account' : 'You can access your spouse account . Switch to Spouse account'
                                    }}</a>
                    <br><br><span
                            style="color: red"></span>
                    @endif
                        </span></div>
            <div class="item4 d-flex justify-content-end">
                <a href="{{ Config::get('constants.SITE_BASE_URL')  }}logout"
                   class="d-flex justify-content-end p-responsive title-color logOut"><i
                            class="fas fa-sign-out-alt mt-1 mr-1"></i> Logout</a>
                <a data-toggle="modal" data-target="#settingsModal"><i
                            class="fas fa-cog xfa-xs cogColor xpull-right ml-3"></i></a>
            </div>

            <div class="item9"><span class="d-flex justify-content-end title-color">

                            <img src="{{$estate_found_image}}" class="img-fluid estatePic estate_image_image"
                                 alt="Estate Picture">
                        </span></div>
        </div>
    </nav>
</section>