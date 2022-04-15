<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
          <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
       
    
        <!-- Webpage Title -->
     <title> @yield('titulo')
    </title>
        <!-- Styles -->

        {{-- <link rel="stylesheet" href="{{asset('/dashboard/css/select2.css')}}">
        <link rel="stylesheet" href="{{asset('/dashboard/css/dropzone.css')}}">
        <link rel="stylesheet" href="{{asset('/dashboard/css/uppy.min.css')}}">
        <link rel="stylesheet" href="{{asset('/dashboard/css/jquery.steps.css')}}">
        <link rel="stylesheet" href="{{asset('/dashboard/css/jquery.timepicker.css')}}">
        <link rel="stylesheet" href="{{asset('/dashboard/css/quill.snow.css')}}"> --}}
        <script src="{{ asset('/js/jquery.min.js') }}"></script>


        <link rel="shortcut icon" href="{{asset('/assets/image/favicon.ico')}}" type="image/x-icon">
        <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/css/index.css')}}">
      
     
   {{-- sweet alert --}}
   <link rel="stylesheet" href="{{asset('/dashboard/css/sweetalert2.min.css')}}">
   <script src="{{asset('/dashboard/js/sweetalert2.all.min.js')}}"></script>

        <!--
#goog-gt-tt {display:none !important;}
.goog-te-banner-frame {display:none !important;}
.goog-te-menu-value:hover {text-decoration:none !important;}
.goog-te-gadget-icon {background-image:url(//gtranslate.net/flags/gt_logo_19x19.gif) !important;background-position:0 0 !important;}
body {top:0 !important;}
-->
    </head>

    
<!-- GTranslate: https://gtranslate.io/ -->


{{-- <style type="text/css">
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
    

    <style>
        .navbar .fa-stack-2x {
        color: #fa2e27;
        transition: all 0.2s ease;
}
    </style> --}}

<body >

    @include('layouts.includes_site.Menu')
    @yield('conteudo')
    @include('layouts.includes_site.Footer')












</body>

</html>
