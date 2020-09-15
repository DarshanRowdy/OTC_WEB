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
    <!-- include the Vue.js framework -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>

    <!-- include the VeeValidate library -->
    <script src="https://cdn.jsdelivr.net/npm/vee-validate@3.3.8/dist/vee-validate.min.js"></script>

    <!-- include Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<body>
<div id="app"></div>
<script src="{{asset('js/app.js')}}"></script>
{{--<script src="/node_modules/vue/dist/vue.js"></script>--}}
{{--<script src="/node_modules/vuex/dist/vuex.js"></script>--}}

<!-- sell confirmation popup end  -->

<!-- Template Main JS File -->
{{--<script src="{{asset('assets/js/main.js')}}"></script>--}}
<!-- Vendor JS Files -->
<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/responsive.bootstrap4.min.js')}}"></script>
</body>
</html>
