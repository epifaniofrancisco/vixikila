<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('/images/insignia/logo.png')}}">

    <title>@yield('titulo')</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{asset('/dashboard/css/simplebar.css')}}">
    <!-- Fonts CSS -->

   {{--  <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

   <link rel="stylesheet" href="{{asset('/dashboard/css/feather.css')}}">
    <link rel="stylesheet" href="{{asset('/dashboard/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('/dashboard/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/dashboard/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('/dashboard/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('/dashboard/css/uppy.min.css')}}">
    <link rel="stylesheet" href="{{asset('/dashboard/css/jquery.steps.css')}}">
    <link rel="stylesheet" href="{{asset('/dashboard/css/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('/dashboard/css/quill.snow.css')}}">

    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset('css/site.css')}}">

    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{asset('/dashboard/css/daterangepicker.css')}}">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/dashboard/css/app-light.css')}}" id="lightTheme">
    <link rel="stylesheet" href="{{asset('/dashboard/css/app-dark.css" id="darkTheme')}}" disabled>
    {{-- sweet alert --}}
    <link rel="stylesheet" href="{{asset('/dashboard/css/sweetalert2.min.css')}}">
    <script src="{{asset('/dashboard/js/sweetalert2.all.min.js')}}"></script>

    <script src="{{ asset('/js/qrcode.js') }}"></script>
    <script src="{{ asset('/js/qrcode.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    {{-- <link rel="stylesheet" href="css/sweetalert.css"> --}}
    {{-- <script src="{{asset('https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js')}}"></script> --}}
    <script src="{{asset('/dashboard/js/qrcode.min.js')}}"></script>

  {{--   <link rel="stylesheet" href="{{asset('https://unpkg.com/swiper/swiper-bundle.css')}}" />
    <link rel="stylesheet" href="{{asset('https://unpkg.com/swiper/swiper-bundle.min.css')}}" /> --}}
    <link rel="stylesheet" href="{{asset('/dashboard/css/swiper-bundle.min.css')}}">


    {{-- <link href="{{asset('https://unpkg.com/aos@2.3.1/dist/aos.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('/dashboard/css/aos.css')}}" rel="stylesheet">


    {{-- <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}"> --}}
    <link href="{{asset('/dashboard/css/font-awesome1.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('https://use.fontawesome.com/releases/v5.5.0/css/all.css')}}" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{asset('/dashboard/css/fontawesome.all.css')}}" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> --}}

    <script type="text/javascript" src="{{ asset('/js/weglot.min.js') }}"></script>
   
</head>

<style type="text/css">
    <!--
    a.gflag {vertical-align:middle;font-size:16px;padding:1px 0;background-repeat:no-repeat;background-image:url(//gtranslate.net/flags/16.png);}
    a.gflag img {border:0;}
    a.gflag:hover {background-image:url(//gtranslate.net/flags/16a.png);}
    #goog-gt-tt {display:none !important;}
    .goog-te-banner-frame {display:none !important;}
    .goog-te-menu-value:hover {text-decoration:none !important;}
    body {top:0 !important;}
    #google_translate_element2 {display:none!important;}
    -->
    </style>

<body class="vertical light">
    <div class="wrapper">
