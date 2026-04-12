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
    <link href="{{ asset('assets/css/registerLoginSystem/style.css') }}{{Config::get('constants.LIB_VERSION')}}" rel="stylesheet">
</head>
<body>

@yield('content')

<script type="text/javascript" src="{{Config::get('constants.MDB.SITE_MDB_JQUERY_URL')}}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{Config::get('constants.MDB.SITE_MDB_URL')}}js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{Config::get('constants.MDB.SITE_MDB_URL')}}js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{Config::get('constants.MDB.SITE_MDB_URL')}}js/mdb.min.js"></script>
</body>
</html>
