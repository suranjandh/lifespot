@extends('layouts.login_app')
@section('content')
    <div class="waterBackground">
        <p class="pt-5"></p>
        <section class="form-elegant container signIn">
            <!--Form without header-->
            <div class="card">
                <div class="card-body mx-4">
                    <!--Header-->
                    <div class="text-center">
                        @include('layouts.main.logo')
                    </div>

                    <div style="color: #0d5bdd">
                        @include('layouts.messages.messages')
                    </div>
                    <h2>Sign Up</h2>
                    <p>Please fill this form to create an account.</p>
                    @include('auth.layouts.register_form')
                    <p class="font-small dark-grey-text text-right d-flex justify-content-center mb-3 pt-2"> or Sign Up
                        with:</p>
                    <div class="row my-3 d-flex justify-content-center">
                        <!--Facebook-->
                        <button type="button" class="btn btn-white btn-rounded btn-sm z-depth-1a"><i
                                    class="fab fa-facebook-f fa-2x blue-text"></i></button>
                        <!--Twitter-->
                        <!--Windows-->
                        <!-- <button type="button" class="btn btn-white btn-rounded btn-sm z-depth-1a"><img src="../icons/windowsWhite.png" class="socialMedia" alt=""></button> -->
                        <button type="button" class="btn btn-white btn-rounded btn-sm z-depth-1a"><i
                                    class="fab fa-twitter fa-2x blue-text"></i></button>
                        <!--Google +-->
                        <button type="button" class="btn btn-white btn-rounded btn-sm z-depth-1a"><i
                                    class="fab fa-google-plus-g fa-2x blue-text"></i></button>
                    </div>
                </div>
                <!--Footer-->
                <div class="modal-footer pt-2" style="padding: 0px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-6"><a href="{{Config::get('constants.SITE_BASE_URL')}}" class="font-small blue-text ml-1 float-left">Cancel</a></div>
                            <div class="col-6"><p class="font-small grey-text xd-flex xjustify-content-end float-right">Have an account?
                                    <a href="{{Config::get('constants.SITE_BASE_URL')}}login" class="blue-text ml-1">Login here</a></p></div>
                        </div>
                    </div>
                    <!-- <div class="modal-footer xmx-5 pt-3 mb-1 xflex-column">
                        <p class="font-small grey-text d-flex justify-content-end">Already have an account? <a
                                href="signIn.php" class="blue-text ml-1"> Login here</a></p>
                        <p><a href="#" class="font-small text-primary"> ~ &nbsp;<em>I forgot my password</em></a></p>
                    </div> -->
                </div>
                <!--/Form without header-->
            </div>
        </section>

        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-12 text-center disclaimer-text">
                    <small><a href="#" class="disclaimer-text">Terms & Conditions &nbsp; &nbsp;</a> <a href="#"
                                                                                                       class="disclaimer-text">Privacy
                            &nbsp; &nbsp;</a> <a href="#" class="disclaimer-text"> Security</a><br><span
                                class="disclaimer-text">© 2018 Copyright, All rights reserved, Xpirix Software, LifeSpot are registered tradmarks of Xpirix Software. <br>Terms can conditions, features, support, pricing and service options subject to change without notice.</span>
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection


