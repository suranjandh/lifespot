@extends('layouts.estate_app')
@section('content')
    {{--@php
    include '../lib/includes/header_include.php';
    if($session_class->session_check()){
        header("location: ".SITE_INDEX_URL);
    }
    include_once '../includes/header.php'; @endphp--}}
    <style>
        .navAltTop {
            max-height: 70px;
        }

        .navLoggedOut {
            /* visibility: show; */
            /* visibility: hidden; */
            /* display: show; */
            display: show;
        }

        .navLoggedIn {
            /* visibility: hidden; */
            /* visibility: show; */
            /* display: none; */
            display: none;
        }
    </style>
    <div class="navLoggedIn">
        @php
            include_once '../includes/navLoggedIn.php';
        @endphp
    </div>
    <div class="navLoggedOut navAltTop">
        @php include_once '../includes/navLoggedOutV2.php'; @endphp
    </div>
    <!-- <main></main> -->
    <style>
        .logo-text2 {
            /* color:#0C64F5; */
            color: #7FADD1;
            color: #5599D8;
            font-weight: bold;
            margin-top: -70px;
            /* font-size: 1em; */
        }

        .valueStatement {
            font-weight: 500;
            font-size: 1.1em;
        }

        .text-position-img {
            padding-left: 50%;
            padding-bottom: 100px;
        }

        .xcustom-waves-ripple {
            visibility: hidden;
        }

        .mainView {
            margin-top: 75px;
            /* postion: relative */
        }

        .signUpBtn {
            /* position: fixed;
            top: 250px;
            right: 200px; */

            margin-top: 100px;
            margin-right: -110px;
            /* margin-left: 80px; */

        }

        .signUpTxt {
            margin-top: 10px;
            margin-left: 110px;
            font-size: 1.2em;
            font-weight: 400;
        }

        .valueProposition {
            /* margin: 0 auto; */
            /* text-align: center;
            font-size: 1em; */
        }

        .montserrat {
            /* font-family: 'Montserrat', sans-serif; */
            font-family: 'Raleway', sans-serif;
            font-weight: 500;
        }

        .keyWord {
            font-size: 1.1em;
            color: #6A6A6A;

        }

        /* .logoFull{
          height: 700px;
          width: 100%;
        }
        .logoPlacement {
          position: absolute;
          top: 0;
          left: 55%;

        } */
        .whatisit {
            /* background: rgba(124,194,243,0.1); */
            /* background: rgba(96,125,139,0.2); */
            /* background: rgba(170, 119, 80, 0.4); */
            /* background-image: url("../img/dataShareBackground.jpg");  */
            /* rgb(178, 175, 176)
            rgb(170, 119, 80) */
            /* padding: 5px; */
            border-radius: 35px;


        }

        .innerBorder {
            /* padding: 1px; */
            /* border: 1px outset #aa7750; */
            border-radius: 35px;
            border: 1px outset #4d99d1;
        }
    </style>

    <section class="z-depth-4" id="introPic">
        @php
            // include '../home/sections/aTopPic.php';
            include '../home/sections/AAAA1HomeTop.php';
        @endphp
        <div class="xpt-5" id="scrollToWhatIsIt"></div>
    </section>

    <div class="container mb-5" id="xscrollToWhatIsIt">

        <section class="my-5 pt-1">
            <div class="divider-new">
                <h2 class="h2-responsive wow fadeInDown">What is LifeSpot</h2>
            </div>
            @php include 'sections/whatIsLifeSpot.php';@endphp
        </section>

        <section class="my-5" id="why">
            <div class="divider-new">
                <h2 class="h2-responsive wow fadeInDown">Why You'll Love LifeSpot</h2>
            </div>
            @php include 'sections/why.php';@endphp
        </section>

        <section class="my-5" id="bestFeatures">
            <div class="divider-new">
                <h2 class="h2-responsive wow fadeInDown">Best Features</h2>
            </div>
            @php include 'sections/bestFeatures.php';@endphp
        </section>

        <section class="my-5" id="typeOfData">
            <div class="divider-new">
                <h2 class="h2-responsive wow fadeInDown">What Type of Data You Can Upload</h2>
            </div>
            @php include 'sections/typeOfData.php';@endphp
        </section>

        <section class="my-5 container" id="testimonials">
            <div class="divider-new">
                <h2 class="h2-responsive wow fadeInDown">Testimonials</h2>
            </div>
            @php include 'sections/testimonials.php';@endphp
        </section>

        <section class="my-5 container" id="pricing">
            <div class="divider-new">
                <h2 class="h2-responsive wow fadeInDown">Pricing</h2>
            </div>
            @php include 'sections/pricing.php';@endphp
        </section>

        <section class="my-5 container" id="contactUs">
            <div class="divider-new">
                <h2 class="h2-responsive wow fadeInDown">Contact us</h2>
            </div>
            @php include 'sections/contactUs.php';@endphp
        </section>

        <section class="my-5 container" id="contactUs">
            <div class="divider-new">
                <h2 class="h2-responsive wow fadeInDown">Impressive Security</h2>
            </div>
            @php include 'sections/impressiveSecurity.php';@endphp
        </section>

    </div>


    @php include_once '../includes/footer.php'; @endphp
@endsection