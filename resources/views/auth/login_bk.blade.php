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
                        @include('layouts.main.logo');
                    </div>

                    <div style="color: #0d5bdd">
                        @include('layouts.messages.messages')
                    </div>

                    <h2>Log In</h2>

                    <p>Please fill this form to log into your account.</p>
                    @include('auth.layouts.login_form')
                    <p class="font-small dark-grey-text text-right d-flex justify-content-center mb-3 pt-2"> or Log In
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
                            <div class="col-6"><a href="{{Config::get('constants.SITE_BASE_URL')}}" class="font-small blue-text ml-1 float-left">Cancel</a>
                            </div>
                            <div class="col-6"><p class="font-small grey-text xd-flex xjustify-content-end float-right">Need
                                    an account?
                                    <a href="{{Config::get('constants.SITE_BASE_URL')}}register" class="blue-text ml-1">Sign up here</a></p></div>
                        </div>
                    </div>

                </div>
            </div>
            <!--/Form without header-->
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

    <!-- SCRIPTS -->

    <!-- Modal Account Overview-->
    <div class="modal fade " id="passwordResetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-position" role="document">
            <div class="modal-content modal-size">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <!-- /Modal Body -->
            </div>
        </div>
    </div>
    <!-- /End MODAL -->
@endsection
