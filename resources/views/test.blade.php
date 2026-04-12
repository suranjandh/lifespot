<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LifeSpot') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta http-equiv="x-ua-compatible" content="ie=edge">


    <link rel="shortcut icon"  type="image/png" href="{{Config::get('constants.PROJECT_IMAGE_URL')}}favicon.ico">
    <!-- Font Awesome -->
    <!--<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"
            integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+"
            crossorigin="anonymous"></script>-->

    <link rel="stylesheet" href="{{Config::get('constants.MDB.FONT_AWESOME_CSS_PATH')}}">
    <!-- Bootstrap core CSS -->
    <link href="{{Config::get('constants.MDB.SITE_MDB_URL')}}css/bootstrap.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{Config::get('constants.MDB.SITE_MDB_URL')}}css/mdb.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="{{ asset('assets/css/registerLoginSystem/style.css') }}" rel="stylesheet">
</head>
<body>





<!-- Material form login -->
<div class="card">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Sign in</strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5 pt-0">

        <!-- Form -->
        <form class="text-center" style="color: #757575;" action="#">

            <!-- Email -->
            <div class="md-form">
                <input type="email" id="materialLoginFormEmail" class="form-control">
                <label for="materialLoginFormEmail">E-mail</label>
            </div>

            <!-- Password -->
            <div class="md-form">
                <input type="password" id="materialLoginFormPassword" class="form-control">
                <label for="materialLoginFormPassword">Password</label>
            </div>

            <div class="d-flex justify-content-around">
                <div>
                    <!-- Remember me -->
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
                        <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
                    </div>
                </div>
                <div>
                    <!-- Forgot password -->
                    <a href="">Forgot password?</a>
                </div>
            </div>

            <!-- Sign in button -->
            <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>

            <!-- Register -->
            <p>Not a member?
                <a href="">Register</a>
            </p>

            <!-- Social login -->
            <p>or sign in with:</p>
            <a type="button" class="btn-floating btn-fb btn-sm">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a type="button" class="btn-floating btn-tw btn-sm">
                <i class="fab fa-twitter"></i>
            </a>
            <a type="button" class="btn-floating btn-li btn-sm">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a type="button" class="btn-floating btn-git btn-sm">
                <i class="fab fa-github"></i>
            </a>

        </form>
        <!-- Form -->

    </div>

</div>
<!-- Material form login -->


<script type="text/javascript" src="{{Config::get('constants.MDB.SITE_MDB_JQUERY_URL')}}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{Config::get('constants.MDB.SITE_MDB_URL')}}js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{Config::get('constants.MDB.SITE_MDB_URL')}}js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{Config::get('constants.MDB.SITE_MDB_URL')}}js/mdb.min.js"></script>
</body>
</html>