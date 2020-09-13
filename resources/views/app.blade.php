<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content="Desk | OTCSTOX" name="descriptison">
    <meta content="Desk | OTCSTOX" name="keywords">

    <title>OTC Capital</title>
    <!-- Favicons -->
    <link rel="icon" href="{{asset('assets/img/favicon.png')}}">
    <link rel="apple-touch-icon" href="{{asset('assets/img/favicon.png')}}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,500,600,700,800|Montserrat:400,500,600,700,800|Orbitron:400,500,600,700,800" rel="stylesheet">


    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="assets/css/userlogin.css"> -->

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/line-awesome/css/line-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/datatables/responsive.bootstrap4.min.css')}}">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/common.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/userlogin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/media.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

</head>

<body>
<div id="app"></div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
