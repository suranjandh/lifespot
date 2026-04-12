<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name', 'LifeSpot') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <link rel="shortcut icon"  type="image/png" href="{{Config::get('constants.PROJECT_IMAGE_URL')}}favicon.ico">
    <!-- <link rel="icon" type="image/png" href="../img/favicondark.ico"> -->
    <!-- Montserrat Font from Googel Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="{{Config::get('constants.MDB.FONT_AWESOME_CSS_PATH')}}">
    <!-- Bootstrap core CSS -->
    <link href="{{Config::get('constants.MDB.SITE_MDB_URL')}}css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{Config::get('constants.MDB.SITE_MDB_URL')}}css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <!-- Your custom styles (optional) -->
    <link href="{{Config::get('constants.MDB.SITE_MDB_URL')}}css/style.css" rel="stylesheet">

    <!--site css-->
    <link href="{{ asset('assets/css/main.css') }}{{Config::get('constants.LIB_VERSION')}}" rel="stylesheet">
    <!-- MDBootstrap Datatables  -->
    <link href="{{Config::get('constants.MDB.SITE_MDB_URL')}}css/addons/datatables.css" rel="stylesheet">


    <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet">

    <!-- Google Fonts Merriweather -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">


    <script type="text/javascript" src="{{Config::get('constants.MDB.SITE_MDB_JQUERY_URL')}}"></script>


    <script type="text/javascript" src="{{ asset('assets/js/jquery.mask.js') }}"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{Config::get('constants.MDB.SITE_MDB_URL')}}js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{Config::get('constants.MDB.SITE_MDB_URL')}}js/bootstrap.min.js"></script>


    <script type="text/javascript" src="{{Config::get('constants.MDB.SITE_MDB_URL')}}js/addons/datatables.min.js"></script>

    <script type="text/javascript" src="{{ asset('assets/js/toastr.js') }}"></script>


</head>
<body class="hidden-sn xwhite-skin">

@yield('content')

</body>
</html>
